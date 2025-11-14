<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PreapprovedUser;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;
use App\Helpers\Sha256;

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
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'dob' => ['required', 'date'],
            'address' => ['required', 'string', 'max:255'],
            'phonenumber' => ['required', 'digits_between:10,10'],
            'voteridnumber' => ['required', 'string', 'max:255'],
            'voterid' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->mixedCase()       // must contain uppercase and lowercase
                    ->letters()         // must contain letters
                    ->numbers()         // must contain numbers
                    ->symbols(),        // must contain at least one symbol
            ],
        ]);


        // Generate HMAC-hashed key
        $secret = config('app.preaaproved_key');
        $key = Sha256::hash($request->voteridnumber . $request->email . $request->phonenumber . $request->dob . $request->name . $secret);

        // Check pre-approved users
        $preUser = PreapprovedUser::where('key_hash', $key)->first();

        if (!$preUser) {
            return back()->withErrors([
                'error' => 'You are not allowed to register. Please check your details.'
            ])->withInput();
        }



        $voteridPath = $request->file('voterid')->store('voterids', 'public');

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'voterid' => $voteridPath,
            'voteridnumber' => $request->voteridnumber,
            'role' => 0,
            'dob' => $request->dob,
            'address' => $request->address,
            'phonenumber' => $request->phonenumber,
            'status' => 0,
        ]);

        event(new Registered($user));

        return redirect()->route('login')->with('status', 'Registration successful. Please login.');
    }
}
