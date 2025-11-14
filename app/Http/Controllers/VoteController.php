<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use App\Models\VoteRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Helpers\Sha256;

class VoteController extends Controller
{
    public function submitVote(Request $request)
    {
        $request->validate([
            'candidate_id' => 'required|exists:candidates,id',
            'election_id' => 'required|exists:elections,id',
        ]);

        $user = Auth::user();

        // Prevent double voting (app + DB constraint)
        if (VoteRecord::where('user_id', $user->id)
            ->where('election_id', $request->election_id)
            ->exists()) {
            return back()->with('error', 'You have already voted in this election.');
        }

        $nonce = bin2hex(random_bytes(32));
        $timestamp = now()->toDateTimeString();

        // Generate commitment using custom SHA-256
        $stringToHash = $request->election_id . '|' . $request->candidate_id . '|' . $timestamp . '|' . $nonce;
        $commitment = Sha256::hash($stringToHash);

        // Encrypt vote payload
        $voteData = [
            'election_id' => $request->election_id,
            'candidate_id' => $request->candidate_id,
            'timestamp' => $timestamp,
            'nonce' => $nonce,
        ];
        $encryptedVote = Crypt::encryptString(json_encode($voteData));

        // Store vote (append-only)
        Vote::create([
            'candidate_id' => $request->candidate_id,
            'election_id' => $request->election_id,
            'commitment' => $commitment,
            'encrypted_vote' => $encryptedVote,
        ]);

        // Track that user has voted
        VoteRecord::create([
            'user_id' => $user->id,
            'election_id' => $request->election_id,
            'has_voted' => true,
        ]);

        return redirect()->route('vote.select')->with('success', 'Vote submitted securely and anonymously.');
    }
}
