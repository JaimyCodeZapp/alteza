<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    /**
     * Display all roles
     */
    public function index(Request $request): Response
    {
        $products = Product::all();
        return Inertia::render('Home', [
            'products' => $products,
            'status' => session('status'),
        ]);
    }
}
