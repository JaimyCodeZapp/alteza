<?php
namespace App\Services;

use Illuminate\Support\Facades\Storage;

class ProductService
{
    public function handleImageUpload($image)
    {
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->storeAs('public/images', $imageName);

        return $imageName;
    }
}