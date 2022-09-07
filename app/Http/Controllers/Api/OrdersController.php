<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Orders\CreateNewOrder;
use App\Http\Resources\Api\Orders\NewOrderResource;
use App\Contracts\Services\Api\OrderServiceContract;
use App\Http\Requests\Api\Orders\ApproveOrderRequest;

class OrdersController extends Controller
{
    public function __construct(private OrderServiceContract $orderService)
    {
    }

    public function store(CreateNewOrder $request)
    {
        $newOrder = $this->orderService->addOrder($request->input('buyer_id'), $request->input('products'));

        return new JsonResponse(new NewOrderResource($newOrder));
    }

    public function approveOrder(ApproveOrderRequest $request)
    {
        $approveOrder = $this->orderService->approveOrder($request->input('order_number'));

        return new JsonResponse(['success' => $approveOrder]);
    }
}
