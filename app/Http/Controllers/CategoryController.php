<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\CreateUpdate;
use App\Http\Resources\Category\Category as CategoryResource;
use App\Http\Resources\Category\CategoryCollection;
use App\Models\Category as CategoryModel;
use App\Services\Category;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * @var Category
     */
    protected $categoryService;

    public function __construct(Category $category)
    {
        $this->categoryService = $category;
    }

    public function index()
    {
        $response = $this->categoryService->getAll();

        return new CategoryCollection($response);
    }

    public function show(CategoryModel $category)
    {
        $response = $this->categoryService->showProduct($category);

        return new CategoryResource($response);
    }

    /**
     * @param CreateUpdate $request
     * @return CategoryResource
     */
    public function store(CreateUpdate $request)
    {
        $response = $this->categoryService->storeProduct($request);

        return new CategoryResource($response);
    }

    /**
     * @param CreateUpdate $request
     * @param CategoryModel $category
     * @return CategoryResource
     */
    public function update(CreateUpdate $request, CategoryModel $category)
    {
        $response = $this->categoryService->updateProduct($request, $category);

        return new CategoryResource($response);
    }

    /**
     * @param CategoryModel $category
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response
     * @throws \Exception
     */
    public function destroy(CategoryModel $category)
    {
        $category->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
