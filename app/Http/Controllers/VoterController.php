<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\VoterApprovedMail;
use App\Mail\VoterRejectedMail;

class VoterController extends Controller
{
    // Show all registered voters
    public function index()
    {
        $voters = User::where('role', 0)->get();
        return view('admin.voters', compact('voters'));
    }

    // Approve a voter
    public function approve(User $user): RedirectResponse
    {
        $user->update(['status' => 1]);

        // Send approval email
        Mail::to($user->email)->send(new VoterApprovedMail($user));

        return back()->with('success', 'Voter approved and email sent.');
    }

    // Reject a voter
    public function reject(User $user): RedirectResponse
    {
        $user->update(['status' => 2]);

        // Send rejection email
        Mail::to($user->email)->send(new VoterRejectedMail($user));

        return back()->with('success', 'Voter rejected and email sent.');
    }
}
