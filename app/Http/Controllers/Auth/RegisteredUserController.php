<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Show the registration form.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle the registration request.
     */
    public function store(Request $request): RedirectResponse
    {
        // 1) Validate the input, mapping username → pages.username
        $validated = $request->validate([
            'username' => [
                'required',
                'alpha_dash',
                // still unique on the `username` column
                'unique:pages,username',
            ],
            'email' => [
                'required',
                'email',
                'unique:users,email',
            ],
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->mixedCase()
                    ->numbers(),
            ],
        ]);

        // 2) Create the user
        $user = User::create([
            // use the directory name as the "name" for your User model
            'name'     => $validated['username'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // 3) Create the associated page, writing username into `username`
        $user->page()->create([
            'username'    => $validated['username'],
            // ...other defaults (bio, background)...
        ]);

        // 4) Fire registration event, log them in, flash & redirect
        event(new Registered($user));
        Auth::login($user);

        session()->flash('status', 'Welcome aboard! Your directory has been created.');
        return redirect()->route('dashboard');
        
    }
}
