<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password as PasswordValidation;

class AuthController extends Controller
{
    public function create()
    {
        return view('auth.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        $credentials = $request->only(['email', 'password']);
        $remember = $request->filled('remember');

        if (Auth::attempt($credentials, $remember)){
            return redirect()->intended('/');
        }
        else{
            return redirect()->back()->with('error', 'Invalid credentials');
        }
    }

    public function destroy()
    {
        Auth::logout();
        
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/');
    }

    public function requestPasswordReset(){
        return view('auth.forgot-password');
    }

    public function sendPasswordReset(Request $request){
        $request->validate(['email' => 'required|email|exists:users']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::ResetLinkSent
            ? back()->with('success', "Password reset email has been sent")
            : back()->with('error', "Error sending password reset email");

    }

    public function showResetPassword(string $token){
        return view('auth.reset-password', ['token' => $token]);
    }

    public function resetPassword(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => ['required', 'confirmed', PasswordValidation::defaults()],
            'token' => 'required'
        ]);

        $status = Password::reset(
            $request->only(['email', 'password', 'password_confirmation', 'token']),
            function (User $user, string $password){
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PasswordReset
            ? redirect()->route('auth.create')->with('success', 'Password reset successfully')
            : back()->with('error', 'Error resetting password');
    }
}
