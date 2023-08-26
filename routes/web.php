<?php

use App\Livewire\Admin\Statistics;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Home;
use App\Livewire\Profile;
use App\Livewire\Tag\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
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

Route::get('/', Home::class)->name('home');

Route::middleware(['notAuth'])->prefix('auth')->as('auth.')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
});

Route::middleware(['userOrAdmin'])->prefix('user')->as('user.')->group(function () {
    Route::get('/profile', Profile::class)->name('profile');
    Route::post('/logout', function (Request $request) {
        if (Auth::check()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('home')->with('success', 'You have logged out successfully!');
        }
    })->name('logout');
});

Route::middleware(['adminOnly'])->prefix('admin/dashboard')->as('admin.')->group(function () {
    Route::get('/', Statistics::class)->name('statistics');

    // tags
    Route::get('/tags', Tag::class)->name('tags');
});
