<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Link extends Model
{
    protected $fillable = [
        'page_id',
        'title',
        'icon',
        'type',
        'url',
    ];

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }
}