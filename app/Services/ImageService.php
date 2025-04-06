<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ImageService
{
    public static function storeBatch(Product $product, array $images): void
    {
        foreach ($images as $image) {
            $product->images()->create([
                'path' => Storage::disk('public')->put('/images', $image)
            ]);
        }
    }

    public static function destroyBatch($images): void
    {
        foreach ($images as $image) {
            Storage::disk('public')->delete($image->path);
            $image->delete();
        }
    }
}
