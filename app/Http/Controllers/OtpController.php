<?php

namespace App\Http\Controllers;

use App\Mail\OtpMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OtpController extends Controller
{
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $otp = rand(100000, 999999);

        // Store OTP in session (expires in 5 minutes)
        session(['otp' => $otp, 'otp_expiry' => now()->addMinutes(2)]);

        Mail::to($request->email)->send(new OtpMail($otp));

        return response()->json(['message' => 'OTP sent to your email.']);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate(['otp' => 'required|numeric']);

        $storedOtp = session('otp');
        $expires = session('otp_expiry');

        if (!$storedOtp || now()->gt($expires)) {
            return response()->json(['error' => 'OTP expired.'], 400);
        }

        if ($request->otp != $storedOtp) {
            return response()->json(['error' => 'Invalid OTP.'], 400);
        }

        // OTP verified — remove it
        session()->forget(['otp', 'otp_expiry']);

        // Issue temporary token (as earlier)
        $token = bin2hex(random_bytes(32));
        session(['voting_token' => hash('sha256', $token)]);

        return response()->json(['message' => 'OTP verified successfully', 'token' => $token]);
    }
}
