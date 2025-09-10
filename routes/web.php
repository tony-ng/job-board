<?php

use App\Http\Controllers\MyJobApplicationController;
use App\Http\Requests\TaskRequest;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\MyJobController;
use App\Http\Controllers\UserController;
use App\Models\JobApplication;
use App\Models\Task;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    return to_route('jobs.index');
});

Route::resource('register', UserController::class)
    ->only(['create', 'store']);

Route::get('fetch-captcha', [UserController::class, 'fetchCaptcha'])
    ->name('fetch.captcha');

Route::middleware('auth')->get('/email/verify', [UserController::class, 'EmailVerificationNotice'])
    ->name('verification.notice');

Route::middleware(['auth', 'throttle:6,1'])->post('/email/verification-notification', [UserController::class, 'sendEmailVerification'])
    ->name('verification.send');

Route::middleware(['auth', 'signed'])->get('/email/verify/{id}/{hash}', [UserController::class, 'verifyEmail'])
    ->name('verification.verify');

Route::get('login', function(){
    return to_route('auth.create');
})->name('login');

Route::resource('jobs', JobController::class)
    ->only(['index', 'show']);

Route::resource('auth', AuthController::class)
    ->only(['create', 'store']);

Route::delete('logout', function(){
    return to_route('auth.destroy');
})->name('logout');

Route::delete('auth', [AuthController::class, 'destroy'])
    ->name('auth.destroy');

Route::middleware(['auth', 'verified'])->group(function(){
    Route::resource('jobs.applications', JobApplicationController::class)
        ->only(['create', 'store']);

    Route::resource('my-job-applications', MyJobApplicationController::class)
        ->only(['index', 'destroy']);

    Route::resource('employer', EmployerController::class)
        ->only(['create', 'store']);

    Route::middleware('employer')->resource('my-jobs', MyJobController::class)
        ->except('show');

    Route::middleware('employer')->get('download-cv/{application}', [MyJobController::class, 'downloadCV'])
        ->name('my-jobs.download');
});