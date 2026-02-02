<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $men = Category::create([
            'name' => 'Men',
            'slug' => 'men'
        ]);

        $women = Category::create([
            'name' => 'Women',
            'slug' => 'women'
        ]);

        Product::create([
            'category_id' => $men->id,
            'name' => 'Men Black T-Shirt',
            'slug' => 'men-black-tshirt',
            'description' => 'Premium cotton black t-shirt',
            'price' => 799,
            'stock' => 50
        ]);

        Product::create([
            'category_id' => $women->id,
            'name' => 'Women Summer Dress',
            'slug' => 'women-summer-dress',
            'description' => 'Lightweight summer dress',
            'price' => 1299,
            'stock' => 30
        ]);
    }
}
