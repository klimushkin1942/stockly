<?php

namespace App\Http\Resources\Product;

use App\Http\Resources\Image\ImageResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'content' => $this->content,
            'product_group_id' => $this->product_group_id,
            'category_id' => $this->category_id,
            'count' => $this->count,
            'price' => $this->price,
            'discount_price' => $this->discount_price,
            'images' => ImageResource::collection($this->images)->resolve()
        ];
    }
}
