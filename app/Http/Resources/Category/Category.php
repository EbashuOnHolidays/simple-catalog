<?php

namespace App\Http\Resources\Category;

use App\Http\Resources\Product\ProductCollection;
use App\Http\Resources\Traits\ResourceTrait;
use App\Models\Category as CategoryModel;
use Illuminate\Http\Resources\Json\JsonResource;

class Category extends JsonResource
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
        /** @var CategoryModel $category */
        $category = $this->resource;

        $response = [
            'id'   => $category->id,
            'name' => $category->name,
        ];

        if ($category->relationLoaded('products')) {
            $response = array_merge($response, [
                'products' => new ProductCollection($category->products),
            ]);
        }

        return $response;
    }
}
