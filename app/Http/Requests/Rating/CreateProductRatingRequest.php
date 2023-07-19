<?php
namespace App\Http\Requests\Rating;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\RatingRange;
use App\Rules\StripTags;

class CreateProductRatingRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product_id' => 'required|integer|exists:products,id',
            'rating' => ['required', 'integer', new RatingRange],
            'description' => ['nullable', 'string', new StripTags],
        ];
    }
}