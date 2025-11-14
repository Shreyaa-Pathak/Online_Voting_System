<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use Illuminate\Http\Request;
use App\Models\Election;
use App\Models\Candidate;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Helpers\Sha256;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    //election
    public function allelection()
    {
        $elections = Election::all();
        return view('admin.allelection', compact('elections'));
    }

    public function storeelection(Request $request)
    {
        $request->validate([
            'electionname' => 'required|string|max:255',
            'date' => 'required|date',
        ]);

        Election::create([
            'name' => $request->electionname,
            'end_date' => $request->date,
        ]);

        return redirect()->back()->with('success', 'Election added successfully.');
    }

    public function deleteelection($id)
    {
        try {
            $election = Election::findOrFail($id);
            $electionName = $election->name;

            // Delete the election
            $election->delete();

            return redirect()->route('admin.election')
                ->with('success', "Election '{$electionName}' has been deleted successfully!");

        } catch (\Exception $e) {
            return redirect()->route('admin.election')
                ->with('error', 'Failed to delete election. Please try again.');
        }
    }

    
    //candidate
    public function allcandidate()
    {
        $candidates = Candidate::all();
        $elections = Election::where('end_date', '>=', now())->get();
        return view('admin.allcandidate', compact('candidates', 'elections'));
    }

    public function storecandidate(Request $request)
    {
        $data = $request->validate([
            'election_id' => 'required|exists:elections,id',
            'candidatename' => 'required|string|max:255',
            'partyname' => 'required|string|max:255',
            'address' => 'required|string',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $exists = Candidate::where('election_id', $request->election_id)
            ->where('candidatename', $request->candidatename)
            ->where('partyname', $request->partyname)
            ->exists();

        if ($exists) {
            return redirect()->back()
                ->withErrors(['candidatename' => 'This candidate already exists in the selected election.'])
                ->withInput();
        }

        // Generate a unique 4-digit candidate number
        do {
            $candidateNumber = random_int(100, 99999);
        } while (Candidate::where('candidatenumber', $candidateNumber)->exists());

        $data['photo'] = $request->file('photo')->store('candidates', 'public');
        $data['candidatenumber'] = $candidateNumber;

        Candidate::create($data);
        return redirect()->back()->with('success', "Candidate added successfully!");
    }


    public function deletecandidate($id)
    {
        $candidate = Candidate::findOrFail($id);

        if ($candidate->photo && Storage::disk('public')->exists($candidate->photo)) {
            Storage::disk('public')->delete($candidate->photo);
        }

        $candidate->delete();
        return redirect()->back()->with('success', 'Candidate deleted successfully.');
    }

    public function result()
    {
        $elections = Election::all();
        return view('admin.result', compact('elections'));

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

        return view('admin.showresult', compact('candidates', 'election', 'winner', 'tamperedCount'));
    }
}
