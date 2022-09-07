<?php

namespace App\Http\Resources\Api\Products;

use Illuminate\Http\Resources\Json\JsonResource;

class AllProductsResource extends JsonResource
{
    public function toArray($request = null)
    {
        return [
            'products' => $this->resource->map(function ($product) {
                return [
                    'title'         => $product->title,
                    'description'   => $product->description,
//                    'price'         => number_format($product->price, thousands_separator: ' ') . ' р.',
                    'price'         => $product->price,
                    'count'         => $product->count,
                ];
            }),
        ];
    }
}
