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
        ProductService::syncBatchParams($product, $data);
        ImageService::storeBatch($product, $data['images']);

        return $product->fresh();
    }

    public static function attachBatchParams(Product $product, array $data): void
    {
        if (empty($data['images'])) {
            return;
        }

        foreach ($data['params'] as $param) {
            $product->params()->attach($param['id'], ['value' => $param['value']]);
        }
    }

    public static function syncBatchParams(Product $product, array $data): void
    {
        $product->params()->detach();
        ProductService::attachBatchParams($product, $data);
    }
}
