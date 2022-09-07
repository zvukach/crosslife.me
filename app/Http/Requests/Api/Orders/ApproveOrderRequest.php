<?php

namespace App\Http\Requests\Api\Orders;

use Illuminate\Foundation\Http\FormRequest;

class ApproveOrderRequest  extends FormRequest
{
    public function rules()
    {
        return [
            'order_number' => 'required|exists:orders,order_number'
        ];
    }
}
