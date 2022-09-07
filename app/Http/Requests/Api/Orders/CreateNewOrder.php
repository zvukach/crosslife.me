<?php

namespace App\Http\Requests\Api\Orders;

use Illuminate\Foundation\Http\FormRequest;

class CreateNewOrder extends FormRequest
{
    public function rules()
    {
        return [
            'buyer_id'          => 'required|exists:users,id',
            'products'          => 'required|array',
            'products.*.id'     => 'required|exists:products,id',
            'products.*.count'  => 'required|integer',
        ];
    }
}
