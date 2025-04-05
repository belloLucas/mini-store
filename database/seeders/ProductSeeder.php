<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductCategory;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::factory(2)->create([
            'product_category_id' => 1,
            'name' => 'Smartphone',
            'description' => 'Um smartphone de última geração com recursos avançados.',
            'price' => 999.99,
            'image_url' => 'https://placehold.co/600x400',
        ]);
        
        Product::factory(2)->create([
            'product_category_id' => 2,
            'name' => 'Camiseta',
            'description' => 'Uma camiseta confortável e estilosa.',
            'price' => 29.99,
            'image_url' => 'https://placehold.co/600x400',
        ]);
        
        Product::factory(2)->create([
            'product_category_id' => 3,
            'name' => 'Panela',
            'description' => 'Uma panela antiaderente de alta qualidade.',
            'price' => 49.99,
            'image_url' => 'https://placehold.co/600x400',
        ]);
        
        Product::factory(2)->create([
            'product_category_id' => 4,
            'name' => 'Livro de receitas',
            'description' => 'Um livro de receitas com pratos deliciosos.',
            'price' => 19.99,
            'image_url' => 'https://placehold.co/600x400',
        ]);
    }
}
