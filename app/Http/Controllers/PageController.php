<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PageController extends Controller
{
    /**
     * List all of the current user’s pages.
     */
    public function index()
    {
        $pages = auth()->user()->pages; 
        return view('pages.index', compact('pages'));
    }

    /**
     * Show the “create page” form (max 3).
     */
    public function create()
    {
        if (auth()->user()->pages()->count() >= 3) {
            return redirect()
                ->route('dashboard')
                ->with('error', 'You can only create up to 3 directories.');
        }

        return view('pages.create');
    }

    /**
     * Persist a new Page (max 3).
     */
    public function store(Request $request)
    {
        if (auth()->user()->pages()->count() >= 3) {
            return redirect()
                ->route('dashboard')
                ->with('error', 'You can only create up to 3 directories.');
        }

        $data = $request->validate([
            'username'    => ['required','alpha_dash','unique:pages,username'],
            'profile_pic' => ['nullable','image','max:2048'],
            'background'  => ['nullable','image','max:4096'],
            'bio'         => ['nullable','string'],
        ]);

        if ($request->hasFile('profile_pic')) {
            $data['profile_pic'] = $request
                ->file('profile_pic')
                ->store('pages/profile_pics', 'public');
        }

        if ($request->hasFile('background')) {
            $data['background'] = $request
                ->file('background')
                ->store('pages/backgrounds', 'public');
        }

        $page = auth()->user()->pages()->create($data);

        return redirect()
            ->route('pages.edit', $page)
            ->with('status', 'Page created successfully!');
    }

    /**
     * Show a page by its ID (admin/internal use).
     */
    public function show(Page $page)
    {
        $page->load(['links' => fn($q) => $q->orderBy('sort_order')]);
        return view('pages.show', compact('page'));
    }

    /**
     * Catch-all public username route (e.g. /johnny).
     */
    public function showPublic($username)
    {
        $page = Page::where('directory', $username)->first();

        if (! $page) {
            abort(404);
        }

        $page->load('links');
        return view('pages.show', compact('page'));
    }

    /**
     * Show the “edit page” form.
     */
    public function edit(Page $page)
    {
        $page->load('links');
        return view('pages.edit', compact('page'));
    }

    /**
     * Update an existing Page.
     */
    public function update(Request $request, Page $page)
    {
        $data = $request->validate([
            'username'    => [
                'required','alpha_dash',
                Rule::unique('pages','username')->ignore($page->id),
            ],
            'profile_pic' => ['nullable','image','max:2048'],
            'background'  => ['nullable','image','max:4096'],
            'bio'         => ['nullable','string'],
        ]);

        if ($request->hasFile('profile_pic')) {
            $data['profile_pic'] = $request
                ->file('profile_pic')
                ->store('pages/profile_pics', 'public');
        }

        if ($request->hasFile('background')) {
            $data['background'] = $request
                ->file('background')
                ->store('pages/backgrounds', 'public');
        }

        $page->update($data);

        return redirect()
            ->route('pages.edit', $page)
            ->with('status', 'Page updated successfully!');
    }

    /**
     * Delete a page.
     */
    public function destroy(Page $page)
    {
        $page->delete();

        return redirect()
            ->route('dashboard')
            ->with('status', 'Page deleted.');
    }
}
