<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\hasRatings;
use App\Rules\Slug;
use NumberFormatter;

class Product extends Model
{
    use HasFactory, hasRatings;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'sale_price',
        'image',
    ];

    protected $appends = ['image_url', 'url', 'formatted_price', 'formatted_sale_price'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            $validator = \Validator::make(['slug' => $product->slug], ['slug' => [new Slug()]]);

            if ($validator->fails()) {
                throw new \InvalidArgumentException($validator->errors()->first('slug'));
            }
        });
    }

    public function getImageURLAttribute() 
    {
        return asset('storage/images/' . $this->image);
    }

    public function getURLAttribute() 
    {
        return route('products.show', ['slug' => $this->slug]);
    }

    public function getFormattedPriceAttribute() 
    {
        $formatter = new NumberFormatter('nl_NL', NumberFormatter::CURRENCY);
        return $formatter->formatCurrency($this->price, 'EUR');
    }

    public function getFormattedSalePriceAttribute() 
    {
        if(!$this->sale_price) return null;
        $formatter = new NumberFormatter('nl_NL', NumberFormatter::CURRENCY);
        return $formatter->formatCurrency($this->sale_price, 'EUR');
    }
}