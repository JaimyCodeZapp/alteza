<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Rating;
use App\Models\User;

class RatingSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $product = Product::find(1);
        $user = User::where('name', 'John Doe')->first();

        $rating = Rating::create([
            'user_id' => $user->id,
            'rating' => 8,
            'description' => 'Lorem ipsum dolor sit amet'
        ]);

        $product->ratings()->sync($rating->id);
    }
}