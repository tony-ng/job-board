<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('register.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {       
        $validatedData = $request->validate([
            'name' => 'required|string|min:2|max:255',
            'email' => 'required|email|unique:users',
            'password' => ['required', 'confirmed', Password::defaults()],
            'captcha' => 'required|captcha'
        ], [
            'captcha.required' => 'Captcha is required',
            'captcha.captcha' => 'Captcha is invalid',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        Auth::login($user);

        event(new Registered($user));

        return redirect()->route('verification.notice');
    }

    public function fetchCaptcha(){
        return response()->json(['captcha'=> captcha_img()]);
    }

    public function EmailVerificationNotice(){
        return view('register.verify-email');
    }

    public function sendEmailVerification(Request $request){
        if ($request->user()->hasVerifiedEmail()){
            return redirect('/');
        }
        
        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }

    public function verifyEmail(EmailVerificationRequest $request){
        $request->fulfill();

        return redirect('/');
    }
}
