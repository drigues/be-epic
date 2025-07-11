<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\SocialAuthController;

// ─── PUBLIC PAGES ───────────────────────────────────────────────────────────────
Route::view('/', 'landing')    ->name('landing');
Route::view('/terms',   'static.terms')->name('terms');
Route::view('/privacy', 'static.privacy')->name('privacy');
Route::view('/cookies', 'static.cookies')->name('cookies');
Route::view('/privacy/delete', 'privacy.delete')->name('privacy.delete');

// ─── SOCIAL LOGIN (SSO) ─────────────────────────────────────────────────────────
Route::get('/auth/{provider}',          [SocialAuthController::class, 'redirectToProvider']);
Route::get('/auth/{provider}/callback', [SocialAuthController::class, 'handleProviderCallback']);

// Bulk‐reorder links on a given page
Route::post('pages/{page}/links/reorder', function (Request $req, \App\Models\Page $page) {
    // $req->order is e.g. [5, 3, 7, 2]
    foreach ($req->order as $i => $linkId) {
        \App\Models\Link::where('id', $linkId)
            ->update(['sort_order' => $i + 1]);
    }
    return response()->json(['status'=>'ok']);
})->name('pages.links.reorder');

// ─── AUTHENTICATED AREA ─────────────────────────────────────────────────────────
Route::middleware(['auth','verified'])->group(function () {
    // Dashboard
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    // Profile
    Route::get   ('/profile', [ProfileController::class, 'edit'])   ->name('profile.edit');
    Route::patch ('/profile', [ProfileController::class, 'update']) ->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Pages
    Route::resource('pages', PageController::class)
        ->only(['index','create','store','edit','update','destroy'])
        ->scoped(['page' => 'username']);

    // Nested Links
    Route::resource('pages.links', LinkController::class)
        ->only(['index','create','store','edit','update','destroy'])
        ->scoped(['page' => 'username'])
        ->shallow();

    // Reordering
    Route::post('links/{link}/move-up',   [LinkController::class, 'moveUp'])->name('links.moveUp');
    Route::post('links/{link}/move-down', [LinkController::class, 'moveDown'])->name('links.moveDown');
});

// ─── BREEZE AUTH ROUTES ─────────────────────────────────────────────────────────
require __DIR__.'/auth.php';

// ─── CATCH-ALL PUBLIC PROFILE (EXCLUDING SYSTEM PATHS) ─────────────────────────
Route::get('/{page:username}', [PageController::class, 'show'])
    ->name('pages.show')
    ->where('username', '^(?!login$|register$|dashboard$|auth|api|profile|pages|links|password).*$');