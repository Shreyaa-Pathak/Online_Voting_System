<?php

namespace App\Http\Controllers;

use App\Models\VoteRecord;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Election;
use App\Models\Candidate;
use App\Models\Vote;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use App\Helpers\Sha256;

class UserController extends Controller
{
    public function showElectionForm()
    {
        $elections = Election::where('end_date', '>=', now())->get();
        return view('user.voteSelect', compact('elections'));
    }

    public function showCandidates(Request $request)
    {
        $electionId = $request->input('election_id');
        $user = Auth::user();

        // Check if user already voted in this election
        $alreadyVoted = VoteRecord::where('user_id', $user->id)
            ->where('election_id', $electionId)
            ->exists();

        if ($alreadyVoted) {
            return redirect()->route('vote.select')->with('error', 'You have already voted in this election.');
        }

        $election = Election::find($electionId);
        $candidates = Candidate::where('election_id', $electionId)->get();
        return view('user.voteCandidates', compact('candidates', 'electionId', 'election'));
    }

    public function result()
    {
        $elections = Election::all();
        return view('user.result', compact('elections'));

    }

    public function showResult(Request $request)
    {
        $electionId = $request->input('election_id');
        $election = Election::findOrFail($electionId);

        $votes = Vote::where('election_id', $electionId)->get();

        foreach ($votes as $vote) {
            try {
                $data = json_decode(Crypt::decryptString($vote->encrypted_vote), true);

                // Recompute hash using custom SHA-256
                $stringToHash = $data['election_id'] . '|' . $data['candidate_id'] . '|' . $data['timestamp'] . '|' . $data['nonce'];
                $recomputed = Sha256::hash($stringToHash);

                // Flag tampered votes
                if ($recomputed !== $vote->commitment) {
                    $vote->tampered = true;
                    $vote->save();

                    // Optionally log for audit
                    DB::table('tampered_votes_log')->insert([
                        'vote_id' => $vote->id,
                        'detected_at' => now(),
                        'details' => json_encode($data),
                    ]);
                }
            } catch (\Exception $e) {
                $vote->tampered = true;
                $vote->save();

                DB::table('tampered_votes_log')->insert([
                    'vote_id' => $vote->id,
                    'detected_at' => now(),
                    'details' => 'Decryption failed',
                ]);
            }
        }

        // Count only valid (untampered) votes
        $results = Vote::where('election_id', $electionId)
            ->where('tampered', false)
            ->select('candidate_id', DB::raw('COUNT(*) as total'))
            ->groupBy('candidate_id')
            ->get();

        // Merge with candidate info
        $candidates = Candidate::where('election_id', $electionId)->get()->map(function ($candidate) use ($results) {
            $result = $results->firstWhere('candidate_id', $candidate->id);
            $candidate->votes_count = $result ? $result->total : 0;
            return $candidate;
        });

        // Determine winner
        $winner = $candidates->sortByDesc('votes_count')->first();

        $tamperedCount = Vote::where('election_id', $electionId)
            ->where('tampered', true)
            ->count();

        return view('user.showresult', compact('candidates', 'election', 'winner', 'tamperedCount'));
    }
}
