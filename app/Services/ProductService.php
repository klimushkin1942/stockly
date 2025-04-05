<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
    public static function store(array $data): Product
    {
        $product = Product::create($data['product']);
        ProductService::attachBatchParams($product, $data);
        ImageService::storeBatch($product, $data['images']);

        return $product;
    }

    public static function update(Product $product, array $data): Product
    {
        $product->update($data['product']);
        ImageService::storeBatch($product, $data['images']);

        return $product->fresh();
    }

    public static function attachBatchParams(Product $product, array $data): void
    {
        foreach ($data['params'] as $param) {
            $product->params()->attach($param['id'], ['value' => $param['value']]);
        }
    }
}
