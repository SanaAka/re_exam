<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuctionController;
use App\Http\Controllers\BidController;

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
// Admin create auction (form)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/auctions/create', [AuctionController::class, 'create'])->name('admin.auctions.create');
    Route::post('/admin/auctions', [AuctionController::class, 'store'])->name('admin.auctions.store');
});
Route::get('/auctions', [AuctionController::class, 'index'])->name('auctions.index');
Route::get('/auctions/{auction}', [AuctionController::class, 'show'])->name('auctions.show');

Route::middleware('auth')->group(function () {
    Route::post('/bids', [BidController::class, 'store'])->name('bids.store');
});
Route::post('/admin/auctions/{auction}/close', [AuctionController::class, 'close'])->name('admin.auctions.close');
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/auctions', [AuctionController::class, 'adminIndex'])->name('admin.auctions.index');
});

require __DIR__.'/auth.php';
