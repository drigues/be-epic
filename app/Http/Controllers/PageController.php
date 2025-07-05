<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * List the current user’s page (or show none).
     */
    public function index()
    {
        $pages = auth()->user()->page
            ? [auth()->user()->page]
            : [];

        return view('pages.index', compact('pages'));
    }

    /**
     * Show the “create page” form.
     */
    public function create()
    {
        return view('pages.create');
    }

    /**
     * Persist a new Page.
     */
    public function store(Request $request)
    {
        // 1) Validate inputs
        $data = $request->validate([
            'username'    => ['required','alpha_dash','unique:pages,username'],
            'profile_pic' => ['nullable','image','max:2048'],
            'background'  => ['nullable','image','max:4096'],
            'bio'         => ['nullable','string'],
        ]);

        // 2) Handle file uploads
        if ($request->hasFile('profile_pic')) {
            $data['profile_pic'] = $request
                ->file('profile_pic')
                ->store('pages/profile_pics','public');
        }
        if ($request->hasFile('background')) {
            $data['background'] = $request
                ->file('background')
                ->store('pages/backgrounds','public');
        }

        // 3) Create the page via the user‐page relation
        $page = auth()->user()->page()->create($data);

        // 4) Flash & redirect to the edit form
        return redirect()
            ->route('pages.edit', $page)
            ->with('status', 'Page created successfully!');
    }

    /**
     * Show a single page (with its links).
     */
    public function show(Page $page)
    {
        $page->load('links');
        return view('pages.show', compact('page'));
    }
    
    /**
     * Show the “edit page” form.
     */
    public function edit(Page $page)
    {
        return view('pages.edit', compact('page'));
    }

    /**
     * Update an existing Page.
     */
    public function update(Request $request, Page $page)
    {
        $data = $request->validate([
            'profile_pic' => ['nullable','image','max:2048'],
            'background'  => ['nullable','image','max:4096'],
            'bio'         => ['nullable','string'],
        ]);

        if ($request->hasFile('profile_pic')) {
            $data['profile_pic'] = $request
                ->file('profile_pic')
                ->store('pages/profile_pics','public');
        }
        if ($request->hasFile('background')) {
            $data['background'] = $request
                ->file('background')
                ->store('pages/backgrounds','public');
        }

        $page->update($data);

        return redirect()
            ->route('pages.edit', $page)
            ->with('status', 'Page updated successfully!');
    }

    /**
     * Delete a page (and cascade‐delete its links).
     */
    public function destroy(Page $page)
    {
        $page->delete();

        return redirect()
            ->route('pages.index')
            ->with('status', 'Page deleted.');
    }
    
}
