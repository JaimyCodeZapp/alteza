<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Product;
use Inertia\Inertia;
use Inertia\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Http\Requests\Product\ProductCreateRequest;
use Illuminate\Http\RedirectResponse;
use App\Services\ProductService;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display all products
     */
    public function view(Request $request): Response
    {
        $products = Product::all(); 
        return Inertia::render('Admin/Products/List', [
            'products' => $products,
            'status' => session('status'),
        ]);
    }

    /**
     * Display from for adding a product 
     */
    public function create(Request $request): Response
    {
        return Inertia::render('Admin/Products/Create', [
            'status' => session('status'),
        ]);
    }

    /**
     * Insert new product
     */
    public function insert(ProductCreateRequest $request): RedirectResponse
    {
        $formData = $request->all();
        if ($formData['image']) {
            $formData['image'] = $this->productService->handleImageUpload($formData['image']);
        }
        $product = Product::create($formData);
        return Redirect::route('products.edit', ['id' => $product->id]);
    }
    
    /**
     * Display from for editing a role and deleting the role
     */
    public function edit(Request $request, string $id): Response
    {
        $product = Product::find($id); 
        return Inertia::render('Admin/Products/Edit', [
            'product' => $product,
            'status' => session('status'),
        ]);
    }

    /**
     * Update a role
     */
    public function update(ProductUpdateRequest $request) : RedirectResponse
    {
        $formData = $request->all();
        if ($formData['image']) {
            $formData['image'] = $this->productService->handleImageUpload($formData['image']);
        }
        $product = Product::find($formData['id']); 
        $product->update($formData);

        return Redirect::route('products.edit', ['id' => $product->id]);
    }

    /**
     * Delete a role
     */
    public function destroy(Request $request, string $id): RedirectResponse
    {
        $product = Product::find($id);
        $product->delete();

        return Redirect::route('products');
    }
}
