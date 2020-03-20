<?php

namespace App\services;

class CartService
{
    public function getCartTotalSum(Request $request)
    {
        $sum = 0;
        return array_reduce($request->session('cart'), function ($sum, $item) {
            $sum += $item['count'] * $item['price'];
            return $sum;
        }, $sum);
    }
}
