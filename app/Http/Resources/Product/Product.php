<?php

namespace App\Http\Resources\Product;

use App\Http\Resources\Category\Category;
use App\Http\Resources\Traits\ResourceTrait;
use App\Models\Product as ProductModel;
use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
{
    use ResourceTrait;

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        /** @var ProductModel $product */
        $product = $this->resource;

        $response = [
            'id'          => $product->id,
            'category_id' => $product->category_id,
            'name'        => $product->name,
            'desc'        => $product->desc,
            'price'       => $product->price,
        ];

        if ($product->relationLoaded('category')) {
            $response = array_merge($response, [
                'category' => new Category($product->category)
            ]);
        }

        return $response;
    }
}
