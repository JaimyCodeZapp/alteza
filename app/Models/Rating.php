<?php

namespace App\Models;

use App\Rules\StripTags;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rating extends Model
{
    protected $fillable = ['user_id', 'rating', 'description'];
    protected $appends = ['user'];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($rating) {
            $validator = \Validator::make(['description' => $rating->description], ['description' => [new StripTags()]]);

            if ($validator->fails()) {
                throw new \InvalidArgumentException($validator->errors()->first('description'));
            }
        });
    }

    /**
     * Get the user that placed the rating
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getUserAttribute()
    {
        return $this->user()->first();
    }
}