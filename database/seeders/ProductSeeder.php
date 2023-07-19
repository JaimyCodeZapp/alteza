<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productsData = [
            [
                'name' => 'Product 1',
                'slug' => 'product-1',
                'description' => 'Description for Product 1.',
                'price' => 50.00,
                'sale_price' => 45.00,
                'image' => 'sample-image-1.png', 
            ],
            [
                'name' => 'Product 2',
                'slug' => 'product-2',
                'description' => 'Description for Product 2.',
                'price' => 60.00,
                'sale_price' => null,
                'image' => 'sample-image-2.png', 
            ],
        ];



        Product::insert($productsData);
    }
}