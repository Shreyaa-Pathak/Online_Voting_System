<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ProfileController,
    VoteController,
    AdminController,
    VoterController,
    UserController,
    OtpController
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

require __DIR__ . '/auth.php';

/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('user.dashboard');
    })->name('dashboard');

    // Voting
    Route::prefix('vote')->group(function () {
        Route::get('/select', [UserController::class, 'showElectionForm'])->name('vote.select');
        Route::post('/candidates', [UserController::class, 'showCandidates'])->name('vote.candidates');
        Route::post('/submit', [VoteController::class, 'submitVote'])->name('vote.submit');
    });

    // Results
    Route::get('/result', [UserController::class, 'result'])->name('result');
    Route::post('/result/show', [UserController::class, 'showResult'])->name('result.show');

    // OTP Verification
    Route::post('/send-otp', [OtpController::class, 'sendOtp'])->name('otp.send');
    Route::post('/verify-otp', [OtpController::class, 'verifyOtp'])->name('otp.verify');
});

// /*
// |--------------------------------------------------------------------------
// | Profile Routes
// |--------------------------------------------------------------------------
// */
// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Election Management
    Route::prefix('election')->group(function () {
        Route::get('/', [AdminController::class, 'allelection'])->name('admin.election');
        Route::post('/store', [AdminController::class, 'storeelection'])->name('admin.storeelection');
        Route::delete('/{id}', [AdminController::class, 'deleteelection'])->name('admin.deleteElection');
    });

    // Candidate Management
    Route::prefix('candidate')->group(function () {
        Route::get('/', [AdminController::class, 'allcandidate'])->name('admin.candidate');
        Route::post('/store', [AdminController::class, 'storecandidate'])->name('admin.storecandidate');
        Route::delete('/{id}', [AdminController::class, 'deletecandidate'])->name('admin.deleteCandidate');
    });

    // Voter Management
    Route::prefix('voters')->group(function () {
        Route::get('/', [VoterController::class, 'index'])->name('admin.voters');
        Route::post('/{user}/approve', [VoterController::class, 'approve'])->name('admin.voters.approve');
        Route::post('/{user}/reject', [VoterController::class, 'reject'])->name('admin.voters.reject');
    });

    // Result Management
    Route::prefix('result')->group(function () {
        Route::get('/', [AdminController::class, 'result'])->name('admin.result');
        Route::post('/show', [AdminController::class, 'showresult'])->name('admin.result.show');
    });
});
