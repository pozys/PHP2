<?php

namespace App\repositories;

use App\entities\Cart;
use App\main\App;

class CartRepository extends Repository
{

    protected function getEntityName(): string
    {
        return Cart::class;
    }

    protected function getTableName(): string
    {
        return 'goods';
    }

    public function updateCart(App $app)
    {
        if ($app->request->isEmptyGET()) {
            return null;
        }

        $cart = $app->request->session('cart');
        $item = $cart[$app->request->get('id')];
        if (!empty($item)) {
            $item['count'] += (int) $app->request->get('count');
        } else {
            $item['count'] = 1;
            $item['good_name'] = $app->request->get('good_name');
            $item['price'] = empty((int) $app->request->get('price')) ? 0 : (int) $app->request->get('price');
        }

        if ($item['count'] === 0) {
            unset($cart[$app->request->get('id')]);
        } else {
            $cart[$app->request->get('id')] = $item;
        }

        $app->request->setSession('cart', $cart);
    }

    public function getItemsId(App $app)
    {
        $cart = $app->request->session('cart');

        if (empty($cart)) {
            return [];
        }

        $itemsId = array_keys($cart);
        $itemsId = $this->modifyItemsId($itemsId);

        return $itemsId;
    }

    protected function modifyItemsId($itemsId)
    {
        $arr = [];
        foreach ($itemsId as $key => $value) {
            $arr[":{$key}"] = $value;
        }

        return $arr;
    }
}
