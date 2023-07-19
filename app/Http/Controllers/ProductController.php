<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Inertia\Inertia;
use Inertia\Response;

class ProductController extends Controller
{
    /**
     * Show product detail page
     */
    public function show(Request $request, String $slug): Response
    {
        $product = Product::where('slug', $slug)->with('ratings')->first();

        return Inertia::render('Product', [
            'product' => $product,
            'status' => session('status'),
        ]);
    }
}
