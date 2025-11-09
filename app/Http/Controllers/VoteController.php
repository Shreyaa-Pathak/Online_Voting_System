<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use App\Models\VoteRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class VoteController extends Controller
{
    public function submitVote(Request $request)
    {
        $request->validate([
            'candidate_id' => 'required|exists:candidates,id',
            'election_id' => 'required|exists:elections,id',
        ]);

        $user = Auth::user();

        if (VoteRecord::where('user_id', $user->id)->where('election_id', $request->election_id)->exists()) {
            return back()->with('error', 'You have already voted in this election.');
        }

        $nonce = bin2hex(random_bytes(32));
        $timestamp = now()->toDateTimeString(); 

        // Create hash using the exact same data structure
        $stringToHash = $request->election_id . '|' . $request->candidate_id . '|' . $timestamp . '|' . $nonce;
        $commitment = hash('sha256', $stringToHash);

        // Encrypt using the same timestamp
        $encryptedVote = Crypt::encryptString(json_encode([
            'election_id' => $request->election_id,
            'candidate_id' => $request->candidate_id,
            'timestamp' => $timestamp,
            'nonce' => $nonce,
        ]));

        Vote::create([
            'candidate_id' => $request->candidate_id,
            'election_id' => $request->election_id,
            'commitment' => $commitment,
            'encrypted_vote' => $encryptedVote,
        ]);

        VoteRecord::create([
            'user_id' => $user->id,
            'election_id' => $request->election_id,
            'has_voted' => true,
        ]);

        return redirect()->route('vote.select')->with('success', 'Vote submitted securely and anonymously.');
    }
}
