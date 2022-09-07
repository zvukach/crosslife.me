<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Contracts\Services\Api\ProductServiceContract;
use App\Http\Resources\Api\Products\AllProductsResource;

class ProductsController extends Controller
{
    public function __construct(private ProductServiceContract $productService)
    {
    }

    public function index()
    {
        $products = $this->productService->getCatalog();

        return new JsonResponse(new AllProductsResource($products));
    }
}
