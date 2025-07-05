<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LinkController extends Controller
{
    // still nested: list links under a page
    public function index(Page $page)
    {
        $links = $page->links()->get();
        return view('links.index', compact('page','links'));
    }

    // still nested: show the “add new” form under a page
    public function create(Page $page)
    {
        return view('links.create', compact('page'));
    }

    // still nested: handle the POST /pages/{page}/links
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
            ->route('pages.links.index', $page)
            ->with('status','Link added!');
    }

    //
    // SHALLOW routes from here on—only {link} is passed in
    //

    // GET  /links/{link}/edit
    public function edit(Link $link)
    {
        // grab its page so we can re-nest for the form
        $page = $link->page;
        return view('links.edit', compact('page','link'));
    }

    // PUT /links/{link}
    public function update(Request $request, Link $link)
    {
        // validate just as before
        $data = $request->validate([
            'title'      => ['required','string','max:100'],
            'icon'       => ['nullable','string','max:50'],
            'type'       => ['required',Rule::in(['social','portfolio','blog','youtube','custom'])],
            'url'        => ['required','url','max:255'],
            'sort_order' => ['nullable','integer'],
        ]);

        $link->update($data);

        // redirect to nested index (needs the parent page)
        return redirect()
            ->route('pages.links.index', $link->page)
            ->with('status','Link updated!');
    }

    // DELETE /links/{link}
    public function destroy(Link $link)
    {
        $page = $link->page;
        $link->delete();

        return redirect()
            ->route('pages.links.index', $page)
            ->with('status','Link deleted.');
    }
}
