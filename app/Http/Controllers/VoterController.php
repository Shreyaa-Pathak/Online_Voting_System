<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use App\Models\Election;
use App\Models\Candidate;
use App\Models\Vote;
use Illuminate\Support\Facades\Auth;

class VoterController extends Controller
{
    // 1. Show all registered voters
    public function index()
    {
        // Assuming all users except admins are voters
        $voters = User::where('role', 0)->get(); 
        return view('admin.voters', compact('voters'));
    }

    // 2. Approve a voter
    public function approve(User $user): RedirectResponse
    {
        $user->update(['status' => 1]);
        return back()->with('success', 'Voter approved.');
    }

    // 3. Reject a voter
    public function reject(User $user): RedirectResponse
    {
        $user->update(['status' => 2]);
        return back()->with('success', 'Voter rejected.');
    }




}
