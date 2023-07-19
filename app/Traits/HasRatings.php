<?php
namespace App\Traits;

use App\Models\Rating;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasRatings
{
    /**
     * The roles that belong to the user.
     */
    public function ratings(): BelongsToMany
    {
        return $this->belongsToMany(Rating::class, 'product_rating')->withTimestamps();
    }
}