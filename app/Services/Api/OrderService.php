<?php

namespace App\Services\Api;

use Exception;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\NotEnoughPointsException;
use App\Exceptions\OrderNotApproveException;
use App\Exceptions\OrderNotCreatedException;
use App\Contracts\Services\Api\OrderServiceContract;
use App\Contracts\Repositories\Api\UserRepositoryContract;
use App\Contracts\Repositories\Api\OrderRepositoryContract;
use App\Contracts\Repositories\Api\ProductRepositoryContract;

class OrderService implements OrderServiceContract
{
    const NEW_ORDER_STATUS = 'created';
    const COMPLETED_ORDER_STATUS = 'payed';

    public function __construct(
        private UserRepositoryContract $userRepository,
        private OrderRepositoryContract $orderRepository,
        private ProductRepositoryContract $productRepository,
    ) {
    }

    /**
     * @throws Exception
     */
    public function addOrder(string $userId, array $data): Model
    {
        $productIds = Arr::pluck($data, 'id');
        $products = $this->productRepository->findByIds($productIds);

        $data = Arr::keyBy($data, 'id');
        $products = $products->map(function ($product) use ($data) {
            $product['count'] = (int) $data[$product->id]['count'];
            return $product;
        });

        $fields = [
            'products'      => json_encode($products),
            'user_id'       => $userId,
            'order_number'  => md5(Carbon::now()->unix() . $userId),
            'status_code'   => self::NEW_ORDER_STATUS,
        ];

        DB::beginTransaction();
        try {
            $newOrder = $this->orderRepository->createNewOrder($fields);
            DB::commit();

            return $newOrder;
        } catch (Exception $exception) {
            DB::rollBack();

            throw new OrderNotCreatedException();
        }
    }

    /**
     * @throws Exception
     */
    public function approveOrder(string $orderNumber)
    {
        $order = $this->orderRepository->findOrderByNumber($orderNumber);
        $price = array_sum(Arr::pluck(json_decode($order->products), 'price'));

        $user = $this->userRepository->getById($order->user_id);

        if ($user->points < $price) {
            throw new NotEnoughPointsException();
        }

        DB::beginTransaction();

        try {
            if ($this->userRepository->update($user, ['points' => $user->points - $price])) {
                if ($this->orderRepository->update($order, ['status_code' => self::COMPLETED_ORDER_STATUS])) {
                    DB::commit();

                    return true;
                }
            }

            DB::rollBack();
            return false;
        } catch (Exception $exception) {
            DB::rollBack();

            throw new OrderNotApproveException();
        }
    }
}
