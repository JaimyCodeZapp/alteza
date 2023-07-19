<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Rating;
use Inertia\Inertia;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;
use App\Http\Requests\Rating\CreateProductRatingRequest;

class RatingController extends Controller
{
    /**
     * Show product detail page
     */
    public function create(CreateProductRatingRequest $request): RedirectResponse
    {
        $formData = $request->validated();
        $product = Product::find($formData['product_id']);
        if($product){
            $formData['user_id'] = auth()->user()->id;
            $rating = Rating::create($formData);
            $product->ratings()->attach($rating->id);
        }
        return redirect()->back();
    }
}
