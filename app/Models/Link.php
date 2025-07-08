<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $fillable = [
        'page_id',
        'title',
        'icon',
        'type',
        'url',
        'sort_order',   // ← add this
    ];

    // optional: ensure default sort_order if you ever do $link = new Link;
    protected $attributes = [
        'sort_order' => 0,
    ];

    /**
     * Belongs to a Page.
     */
    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
