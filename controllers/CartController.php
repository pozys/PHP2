<?php

namespace App\controllers;

use App\entities\Cart;
use App\main\App;
use App\repositories\CartRepository;

class CartController extends Controller
{
    public function __construct($renderer, $request, App $app)
    {
        parent::__construct($renderer, $request, $app);
        $this->repository = new CartRepository($request);
    }

    protected function getAllAction()
    {
        $goodController = new GoodController($this->app->renderer, $this->app->request, $this->app);
        $itemsId = $this->repository->getItemsId($this->app);
        $cart = new Cart($goodController->repository->getSelected($itemsId));

        return $this->render('cart', [
            'goods' => $cart->getGoods(),
            'cart' => $this->request->session('cart'),
            'totalSum' => $this->app->CartService->getCartTotalSum($this->request)
        ]);
    }

    protected function updateCartAction()
    {
        $this->repository->updateCart($this->app);
        $this->request->redir();
    }
}
