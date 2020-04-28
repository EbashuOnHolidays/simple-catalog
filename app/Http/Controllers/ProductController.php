<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\CreateUpdate;
use App\Http\Resources\Product\Product as ProductResource;
use App\Http\Resources\Product\ProductCollection;
use App\Models\Product as ProductModel;
use App\Services\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * @var Product
     */
    public $productService;

    /**
     * ProductController constructor.
     *
     * @param Product $productService
     */
    public function __construct(Product $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $response = $this->productService->getAll();

        return new ProductCollection($response);
    }

    public function show(ProductModel $product)
    {
        $response = $this->productService->showProduct($product);

        return new ProductResource($response);
    }

    /**
     * @param CreateUpdate $request
     * @return ProductResource
     */
    public function store(CreateUpdate $request)
    {
        $response = $this->productService->storeProduct($request);

        return new ProductResource($response);
    }

    /**
     * @param CreateUpdate $request
     * @param ProductModel $product
     * @return ProductResource
     */
    public function update(CreateUpdate $request, ProductModel $product)
    {
        $response = $this->productService->updateProduct($request, $product);

        return new ProductResource($response);
    }

    /**
     * @param ProductModel $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response
     * @throws \Exception
     */
    public function destroy(ProductModel $product)
    {
        $product->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
