<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LinkController extends Controller
{
    /**
     * List links under a given page.
     */
    public function index(Page $page)
    {
        $links = $page->links()->get();
        return view('links.index', compact('page','links'));
    }

    /**
     * Show the “add new” form under a given page.
     */
    public function create(Page $page)
    {
        return view('links.create', compact('page'));
    }

    /**
     * Persist a new link, then go back to Edit Page.
     */
    public function store(Request $request, Page $page)
    {
        $data = $request->validate([
            'title' => ['required','string','max:100'],
            'icon'  => ['nullable','string','max:50'],
            'type'  => ['required', Rule::in(['social','portfolio','blog','youtube','custom'])],
            'url'   => ['required','url','max:255'],
        ]);

        $page->links()->create($data);

        return redirect()
            ->route('pages.edit', $page)
            ->with('status', 'Link added!');
    }

    //
    // Shallow routes from here on—only {link} is passed in
    //

    /**
     * Show the edit form for an existing link.
     */
    public function edit(Link $link)
    {
        $page = $link->page;
        return view('links.edit', compact('page','link'));
    }

    /**
     * Update a link, then go back to Edit Page.
     */
    public function update(Request $request, Link $link)
    {
        $data = $request->validate([
            'title'      => ['required','string','max:100'],
            'icon'       => ['nullable','string','max:50'],
            'type'       => ['required', Rule::in(['social','portfolio','blog','youtube','custom'])],
            'url'        => ['required','url','max:255'],
            'sort_order' => ['nullable','integer'],
        ]);

        $link->update($data);

        return redirect()
            ->route('pages.edit', $link->page)
            ->with('status', 'Link updated!');
    }

    /**
     * Delete a link, then go back to Edit Page.
     */
    public function destroy(Link $link)
    {
        $page = $link->page;
        $link->delete();

        return redirect()
            ->route('pages.edit', $page)
            ->with('status', 'Link deleted.');
    }
}