<?php

namespace App\Http\Services;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductService
{
    /**
     * Get all products with pagination
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getAllProducts(int $perPage = 10): LengthAwarePaginator
    {
        return Product::with('productCategory')->paginate($perPage);
    }

    /**
     * Get product by ID
     *
     * @param int $id
     * @return Product|null
     */
    public function getProductById(int $id): ?Product
    {
        return Product::with('productCategory')->find($id);
    }

    /**
     * Create a new product
     *
     * @param array $data
     * @return Product
     */
    public function createProduct(array $data): Product
    {
        return Product::create($data);
    }

    /**
     * Update existing product
     *
     * @param int $id
     * @param array $data
     * @return Product|null
     */
    public function updateProduct(int $id, array $data): ?Product
    {
        $product = Product::find($id);
        
        if (!$product) {
            return null;
        }
        
        $product->update($data);
        return $product;
    }

    /**
     * Delete product
     *
     * @param int $id
     * @return bool
     */
    public function deleteProduct(int $id): bool
    {
        $product = Product::find($id);
        
        if (!$product) {
            return false;
        }
        
        return $product->delete();
    }

    /**
     * Search products by name or description
     *
     * @param string $query
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function searchProducts(string $query, int $perPage = 10): LengthAwarePaginator
    {
        return Product::with('productCategory')
            ->where('name', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->paginate($perPage);
    }
}