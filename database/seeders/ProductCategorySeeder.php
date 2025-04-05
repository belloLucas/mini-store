<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductCategory;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductCategory::create([
            'name' => 'Eletrônicos',
            'description' => 'Produtos eletrônicos como smartphones, laptops e acessórios.',
        ]);
        ProductCategory::create([
            'name' => 'Roupas',
            'description' => 'Vestuário para todas as idades e estilos.',
        ]);
        ProductCategory::create([
            'name' => 'Casa & Cozinha',
            'description' => 'Produtos para o lar, incluindo utensílios de cozinha e decoração.',
        ]);
        ProductCategory::create([
            'name' => 'Livros',
            'description' => 'Uma variedade de livros de diferentes gêneros e autores.',
        ]);
    }
}
