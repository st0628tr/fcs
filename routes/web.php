<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoreController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = Auth::user();

    if (!$user) {
        abort(403);
    }

    return match ($user->role) {
        'force_admin' => view('dashboards.force_admin'),
        'partner_admin' => view('dashboards.partner_admin'),
        'staff' => view('dashboards.staff'),
        'client_viewer' => view('dashboards.client_viewer'),
        default => view('dashboard'),
    };
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    Route::get('/stores', [StoreController::class, 'index'])
        ->name('stores.index');

    Route::get('/stores/create', [StoreController::class, 'create'])
        ->name('stores.create');

    Route::post('/stores', [StoreController::class, 'store'])
        ->name('stores.store');

    Route::get('/stores/{store}/edit', [StoreController::class, 'edit'])
        ->name('stores.edit');

    Route::put('/stores/{store}', [StoreController::class, 'update'])
        ->name('stores.update');

    Route::patch('/stores/{store}/deactivate', [StoreController::class, 'deactivate'])
        ->name('stores.deactivate');
});

require __DIR__.'/auth.php';
