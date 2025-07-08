<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\LinkController;

//base64:uGDqREIvLNXZLuVG4fwh/DvW3xsArSAOG2kc47E1wKM=
//base64:uGDqREIvLNXZLuVG4fwh/DvW3xsArSAOG2kc47E1wKM=

// ─── PUBLIC PAGES ───────────────────────────────────────────────────────────────
Route::view('/',        'coming-soon')->name('coming-soon');
//Route::view('/', 'landing')->name('landing');
Route::view('/landing', 'landing')->name('landing');
Route::view('/terms',   'static.terms')->name('terms');
Route::view('/privacy', 'static.privacy')->name('privacy');
Route::view('/cookies', 'static.cookies')->name('cookies');

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

    // Links nested under pages, but “shallow” so edit/update/destroy drop {page}
    Route::resource('pages.links', LinkController::class)
         ->only(['index','create','store','edit','update','destroy'])
         ->scoped(['page'=>'username'])
         ->shallow();
});

// ─── BREEZE / JETSTREAM AUTH ROUTES ─────────────────────────────────────────────
require __DIR__.'/auth.php';

// ─── CATCH‐ALL PUBLIC PROFILE ───────────────────────────────────────────────────
Route::get('/{page}', [PageController::class,'show'])
     ->name('public.page')
     ->where('page','[A-Za-z0-9_-]+');
