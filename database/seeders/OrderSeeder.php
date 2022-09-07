<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::get();
        $statuses = OrderStatus::get();
        $products = Product::get();

        for ($i = 0; $i < 5; $i++) {
            Order::factory()->create([
                'user_id'       => $this->prepareUser($users),
                'status_code'   => $this->prepareStatus($statuses),
                'products'      => $this->prepareProducts($products),
            ]);
        }
    }

    private function prepareProducts(Collection $products)
    {
        $count = rand(1, 3);
        $counter = 0;

        $result = [];
        $existIds = [];

        while ($counter <= $count) {
            $product = $products->random();

            if (in_array($product->id, $existIds)) {
                continue;
            }

            $existIds[] = $product->id;
            $result[] = [
                'id'    => $product->id,
                'title' => $product->title,
                'price' => $product->price,
                'count' => rand(1, ($product->count * 0.2)),
            ];

            $counter++;
        }

        return json_encode($result);
    }

    private function prepareStatus(Collection $statuses)
    {
        return $statuses->random()->code;
    }

    private function prepareUser(Collection $users)
    {
        return $users->random()->id;
    }
}
