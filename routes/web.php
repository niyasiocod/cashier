<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\BillingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/pricing', function () {
    return view('pricing');
})->middleware(['auth', 'verified'])->name('pricing');


Route::get('/success', function () {
    return view('success');
})->middleware(['auth', 'verified'])->name('success');


Route::middleware('auth')->group(function () {
    Route::post('/checkout/{price_id}', [CheckoutController::class, '__invoke'])->name('checkout');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/billing/upgrade', [BillingController::class, 'showUpgradeForm'])->name('billing.upgrade');

Route::post('/billing/cancel', [BillingController::class, 'cancel'])->name('billing.cancel');


require __DIR__.'/auth.php';
