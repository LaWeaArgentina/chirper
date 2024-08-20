<?php

use App\Http\Controllers\BlockController;
use App\Http\Controllers\ChirpController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FollowController;
use PhpParser\Node\Stmt\Block;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('chirps', ChirpController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'verified']
);

Route::get('/following', [FollowController::class, 'following'])->name('following');
Route::get('/followers', [FollowController::class, 'followers'])->name('followers');
Route::post('/follow/{user}', [FollowController::class, 'follow'])->name('follow');
Route::post('/unfollow/{user}', [FollowController::class, 'unfollow'])->name('unfollow');

Route::post('/block/{user}', [BlockController::class, 'block'])->name('block');
Route::post('/unblock/{user}', [BlockController::class, 'unblock'])->name('unblock');
Route::get('/blocked', [BlockController::class, 'blocked'])->name('blocked');

require __DIR__.'/auth.php';
