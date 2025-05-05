<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Election;
use App\Models\Candidate;
use App\Models\Vote;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function showElectionForm()
    {
        $elections = Election::all();
        return view('user.voteSelect', compact('elections'));
    }
    
    public function showCandidates(Request $request)
    {
        $electionId = $request->input('election_id');
        $user = Auth::user();
    
        // Check if user already voted in this election
        $alreadyVoted = Vote::where('user_id', $user->id)
                                        ->where('election_id', $electionId)
                                        ->exists();
    
        if ($alreadyVoted) {
            return redirect()->route('vote.select')->with('error', 'You have already voted in this election.');
        }
    
        $election = Election::find($electionId); 
        $candidates = Candidate::where('election_id', $electionId)->get();
        return view('user.voteCandidates', compact('candidates', 'electionId','election'));
    }
    
    public function submitVote(Request $request)
    {
        $request->validate([
            'candidate_id' => 'required|exists:candidates,id',
            'election_id' => 'required|exists:elections,id',
        ]);
    
        $user = Auth::user();
    
        // Prevent voting more than once in the same election
        if (Vote::where('user_id', $user->id)->where('election_id', $request->election_id)->exists()) {
            return back()->with('error', 'You have already voted in this election.');
        }
    
        Vote::create([
            'user_id' => $user->id,
            'candidate_id' => $request->candidate_id,
            'election_id' => $request->election_id,
        ]);
    
        return redirect()->route('vote.select')->with('success', 'Vote submitted successfully.');
    }


    public function result()
    {
        $elections = Election::all();
        return view('user.result', compact('elections'));

    }
    public function showResult(Request $request)
    {
        $electionId = $request->input('election_id');

    $candidates = Candidate::withCount('votes')
                    ->where('election_id', $electionId)
                    ->get();

    $election = Election::find($electionId);

    $winner = $candidates->sortByDesc('votes_count')->first();
    return view('user.showresult', compact('candidates', 'election','winner'));
    }
}
