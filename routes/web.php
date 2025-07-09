<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\LinkController;

// ─── PUBLIC PAGES ───────────────────────────────────────────────────────────────
Route::view('/',        'coming-soon')->name('coming-soon');
Route::view('/landing', 'landing')    ->name('landing');
Route::view('/terms',   'static.terms')->name('terms');
Route::view('/privacy', 'static.privacy')->name('privacy');
Route::view('/cookies', 'static.cookies')->name('cookies');

Route::get('/auth/{provider}', [SocialAuthController::class, 'redirectToProvider']);
Route::get('/auth/{provider}/callback', [SocialAuthController::class, 'handleProviderCallback']);

Route::get('/{username}', [PageController::class, 'show'])->name('pages.show');

Route::view('/privacy/delete', 'privacy.delete');


// ─── AUTHENTICATED AREA ────────────────────────────────────────────────────────
Route::middleware(['auth','verified'])->group(function(){
    // Dashboard
    Route::view('/dashboard','dashboard')->name('dashboard');

    // Profile
    Route::get   ('/profile',   [ProfileController::class,'edit'])   ->name('profile.edit');
    Route::patch ('/profile',   [ProfileController::class,'update']) ->name('profile.update');
    Route::delete('/profile',   [ProfileController::class,'destroy'])->name('profile.destroy');

    // Pages (use :username slug)
    Route::resource('pages', PageController::class)
         ->only(['index','create','store','edit','update','destroy'])
         ->scoped(['page'=>'username']);

    // Links nested under pages (shallow)
    Route::resource('pages.links', LinkController::class)
         ->only(['index','create','store','edit','update','destroy'])
         ->scoped(['page'=>'username'])
         ->shallow();

    // Custom reorder routes (must be inside auth so route() picks them up)
    Route::post('links/{link}/move-up',   [LinkController::class,'moveUp'])->name('links.moveUp');
    Route::post('links/{link}/move-down', [LinkController::class,'moveDown'])->name('links.moveDown');
});

// ─── BREEZE / JETSTREAM AUTH ROUTES ─────────────────────────────────────────────
require __DIR__.'/auth.php';

// ─── CATCH‐ALL PUBLIC PROFILE ───────────────────────────────────────────────────
Route::get('/{page}', [PageController::class,'show'])
     ->name('public.page')
     ->where('page','[A-Za-z0-9_-]+');
