<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\VoterController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        return view('user.dashboard');
    })->name('dashboard');

    Route::get('vote/select', [UserController::class, 'showElectionForm'])->name('vote.select');
    Route::post('vote/candidates', [UserController::class, 'showCandidates'])->name('vote.candidates');
    Route::post('/vote/submit', [UserController::class, 'submitVote'])->name('vote.submit');

    Route::get('/result', [UserController::class, 'result'])->name('result');
    Route::post('/result/show',[UserController::class,'showResult'])->name('result.show');

});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth','admin'])->group(function(){
    Route::get('admin/dashboard',[HomeController::class,'index'])->name('admin.dashboard');

    Route::get('/admin/election', [HomeController::class, 'addelection'])->name('admin.election');
    Route::post('/admin/election', [HomeController::class, 'storeelection'])->name('admin.storeelection');

    Route::get('/admin/candidate',[HomeController::class,'addcandidate'])->name('admin.candidate');
    Route::post('/admin/candidate',[HomeController::class,'storecandidate'])->name('admin.storecandidate');
    
    Route::get('/admin/voters', [VoterController::class, 'index'])->name('admin.voters');
     Route::post('/admin/voters/{user}/approve', [VoterController::class, 'approve'])->name('admin.voters.approve');
     Route::post('/admin/voters/{user}/reject',  [VoterController::class, 'reject'])->name('admin.voters.reject');


    Route::get('admin/result',[HomeController::class,'result'])->name('admin.result');
    Route::post('admin/result/show',[HomeController::class,'showresult'])->name('admin.result.show');

});

