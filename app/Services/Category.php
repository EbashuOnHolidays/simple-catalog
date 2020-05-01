<?php

namespace App\Services;

use App\Models\Category as CategoryModel;
use Illuminate\Http\Request;

class Category
{
    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return CategoryModel::query()
            ->orderBy('name', 'asc')
            ->get();
    }

    /**
     * @param CategoryModel $category
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function showProduct(CategoryModel $category)
    {
        return CategoryModel::query()
            ->where('id', $category->id)
            ->first();
    }

    /**
     * @param Request $request
     * @return CategoryModel
     */
    public function storeProduct(Request $request)
    {
        /** @var CategoryModel $category */
        $category = app(CategoryModel::class);
        $category->fill($request->only($category->getFillable()));
        $category->save();

        return $category;
    }

    /**
     * @param Request       $request
     * @param CategoryModel $category
     * @return CategoryModel
     */
    public function updateProduct(Request $request, CategoryModel $category)
    {
        /** @var CategoryModel $category */
        $category->fill($request->only($category->getFillable()));
        $category->save();

        return $category;
    }
}
