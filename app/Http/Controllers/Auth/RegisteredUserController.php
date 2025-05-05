<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\VoterController;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'voterid' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

         $voteridPath = $request->file('voterid')->store('voterids', 'public');
      

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
           'voterid'=> $voteridPath,
           'voteridnumber'=> $request->voteridnumber,
           'role'=> 0,
           'dob'=> $request->dob,
           'address'=> $request->address,
           'phonenumber'=> $request->phonenumber,
           'status'=> 0,
        ]);

        event(new Registered($user));

        // Auth::login($user);

        // return redirect(route('dashboard', absolute: false));
        return redirect()->route('login')->with('status', 'Registration successful. Please login.');
    }
}
