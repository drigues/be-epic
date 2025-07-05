<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Page extends Model
{
    /**
     * Allow mass assignment on these columns:
     */
    protected $fillable = [
        'username',      // ← add this!
        'profile_pic',
        'background',
        'bio',
    ];

    /**
     * A Page belongs to a User.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * A Page has many Links.
     */
    public function links(): HasMany
    {
        return $this->hasMany(Link::class);
    }

    /**
     * Use the `username` column for implicit route binding.
     */
    public function getRouteKeyName()
    {
        return 'username';
    }
}
