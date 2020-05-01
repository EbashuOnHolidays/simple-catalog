<?php

namespace App\Services;

use App\Models\Product as ProductModel;
use Illuminate\Http\Request;

class Product
{
    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return ProductModel::query()
            ->with('category')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * @param ProductModel $product
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function showProduct(ProductModel $product)
    {
        return ProductModel::query()
            ->with([
                'category',
            ])
            ->where('id', $product->id)
            ->first();
    }

    /**
     * @param Request $request
     * @return ProductModel
     */
    public function storeProduct(Request $request)
    {
        /** @var ProductModel $product */
        $product = app(ProductModel::class);
        $product->fill($request->only($product->getFillable()));
        $product->save();

        return $product;
    }

    /**
     * @param Request      $request
     * @param ProductModel $product
     * @return ProductModel
     */
    public function updateProduct(Request $request, ProductModel $product)
    {
        /** @var ProductModel $product */
        $product->fill($request->only($product->getFillable()));
        $product->save();

        return $product;
    }
}
