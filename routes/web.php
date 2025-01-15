<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth','admin'])->group(function(){
    Route::get('admin/dashboard',[HomeController::class,'index'])->name('admin.dashboard');
    Route::get('admin/election',[HomeController::class,'addelection'])->name('admin.election');
});
// route::get('admin/dashboard',[HomeController::class,'index'])->
//     middleware(['auth','admin'])->name('admin.dashboard');
