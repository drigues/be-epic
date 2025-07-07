<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| PUBLIC STATIC PAGES
|--------------------------------------------------------------------------
|
| Simple “terms”, “privacy” & “cookies” pages, and a Mailchimp “coming
| soon” landing page.
*/

Route::view('/cookies', 'static.cookies')->name('cookies');
Route::view('/privacy', 'static.privacy')->name('privacy');
Route::view('/terms',   'static.terms')->name('terms');

// your existing coming-soon:
Route::view('/coming-soon', 'coming-soon')->name('coming.soon');

/*
|--------------------------------------------------------------------------
| Feature flags from .env
|--------------------------------------------------------------------------
*/
$launched   = config('app.launched', false);
$devEnabled = config('app.dev_mode', true);

/*
|--------------------------------------------------------------------------
| OPTIONAL: a “landing” route if you want route('landing')
|--------------------------------------------------------------------------
*/
Route::view('/landing', 'landing')->name('landing');

/*
|--------------------------------------------------------------------------
| COMING SOON
|--------------------------------------------------------------------------
*/
Route::view('/coming-soon', 'coming-soon')
     ->name('coming.soon');

/*
|--------------------------------------------------------------------------
| HOME REDIRECT
|--------------------------------------------------------------------------
*/
Route::get('/', function () use ($launched) {
    return $launched
         ? redirect()->route('dashboard')
         : redirect()->route('coming.soon');
})->name('home');

/*
|--------------------------------------------------------------------------
| AUTHENTICATION (Breeze / Jetstream)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| DEV PREVIEW
|--------------------------------------------------------------------------
*/
if ($devEnabled) {
    Route::prefix('dev')
         ->name('dev.')
         ->middleware(['auth','verified'])
         ->group(function () {
             // GET /dev → /dev/dashboard
             Route::get('/', fn() => redirect()->route('dev.dashboard'))
                  ->name('home');

             // /dev/dashboard
             Route::get('/dashboard', [HomeController::class,'dashboard'])
                  ->name('dashboard');

             // /dev/pages/*
             Route::resource('pages', PageController::class)
                  ->except('show')
                  ->scoped(['page' => 'username']);

             // /dev/pages/{page}/links/*
             Route::resource('pages.links', LinkController::class)
                  ->except('show')
                  ->scoped(['page' => 'username'])
                  ->shallow();
         });
}

/*
|--------------------------------------------------------------------------
| REAL APP
|--------------------------------------------------------------------------
*/
if ($launched) {
    Route::middleware(['auth','verified'])->group(function(){
        Route::view('/dashboard','dashboard')->name('dashboard');

        Route::get('/profile',   [ProfileController::class,'edit'])
             ->name('profile.edit');
        Route::patch('/profile', [ProfileController::class,'update'])
             ->name('profile.update');
        Route::delete('/profile',[ProfileController::class,'destroy'])
             ->name('profile.destroy');

        Route::resource('pages', PageController::class)
             ->only(['index','create','store','edit','update','destroy'])
             ->scoped(['page' => 'username'])
             ->except('show');

        Route::resource('pages.links', LinkController::class)
             ->only(['index','create','store','edit','update','destroy'])
             ->scoped(['page' => 'username'])
             ->shallow()
             ->except('show');
    });
}

/*
|--------------------------------------------------------------------------
| PUBLIC PROFILE (catch-all)
|--------------------------------------------------------------------------
*/
Route::get('/{page}', [PageController::class,'show'])
     ->name('public.page')
     ->where('page','[A-Za-z0-9_-]+');
