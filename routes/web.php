<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Dashboard route: redirect berdasarkan role (tetap pake middleware verified jika perlu)
Route::get('dashboard', function () {
    $user = auth()->user();

    // jika belum login, biarkan middleware menangani
    if (! $user) {
        return redirect()->route('login');
    }

    return $user->role === 'admin'
        ? redirect()->route('admin.dashboard')
        : redirect()->route('user.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
| Routes untuk user umum (semua authenticated)
*/
Route::middleware(['auth'])->group(function () {
    // redirect settings default
    Route::redirect('settings', 'settings/profile');

    // settings tetap bisa diakses semua user yang login
    // Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    // Volt::route('settings/password', 'settings.password')->name('settings.password');
    // Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
    Volt::route('settings', 'settings.index')->name('settings.index');

    // contoh: batasi appearance hanya untuk admin/editor
    Route::middleware(['role:admin,editor'])->group(function () {
        
    });
});

/*
| Routes role-spesifik
*/
Route::middleware(['auth', 'role:admin'])->group(function () {
    // contoh admin dashboard (Volt)
    Volt::route('admin/dashboard', 'admin.dashboard')->name('admin.dashboard');

    // route admin lain:
    // Volt::route('admin/users', 'admin.users')->name('admin.users');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    // dashboard untuk user biasa
    Volt::route('user/dashboard', 'user.dashboard')->name('user.dashboard');
    Volt::route('user/orders', 'user.order.index')->name('user.order.index');
    Volt::route('user/balance', 'user.balance.index')->name('user.balance.index');
    Volt::route('user/services', 'user.services.index')->name('user.services.index');
    Volt::route('user/support', 'user.support.index')->name('user.support.index');
    Volt::route('user/topup', 'user.topup.index')->name('user.topup.index');
    Volt::route('user/topup/history', 'user.topup.history')->name('user.topup.history');

    // route user lain:
    // Volt::route('orders', 'user.orders')->name('user.orders');
});

require __DIR__.'/auth.php';
