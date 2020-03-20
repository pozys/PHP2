<?php

namespace App\controllers;

use App\entities\Order;
use App\main\App;
use App\repositories\OrderRepository;

class OrderController extends Controller
{

    public function __construct($renderer, $request, App $app)
    {
        parent::__construct($renderer, $request, $app);
        $this->repository = new OrderRepository($request);
    }
    public function indexAction()
    {
        if (empty($this->request->session('cart')) or count($this->request->session('cart')) === 0) {
            $this->request->redir();
        }

        return $this->render('ordercreation', ['session' => $this->request->session('auth')]);
    }

    public function put_orderAction()
    {
        if (!$this->request->isPost()) {
            $this->request->redir('/');
        }

        $order = new Order;
        $order->user_id = $this->request->session('auth')['user_id'];
        $order->sum = $this->app->CartService->getCartTotalSum($this->request);
        $order->user_name = $this->request->post('user_name');
        $order->adress = $this->request->post('adress');
        $order->tel = $this->request->post('tel');
        $order->orders_data = json_encode($this->request->session('cart'), JSON_UNESCAPED_UNICODE);

        if ($this->repository->save($order) === false) {
            $this->request->addMsg('При отправке заказа произошла ошибка. Попробуйте еще раз.');
        } else {
            $this->request->addMsg('Заказ успешно отправлен.');
            $this->request->setSession('cart', []);
        }

        return $this->render('orderresult');
    }

    public function changeStatusAction()
    {
        if (!$this->request->isPost() || empty($this->request->post('status') || empty($this->request->get('id')))) {
            $this->request->redir('/');
        }

        $order = $this->repository->getOne($this->request->get('id'));
        $order->status = $this->app->OrderService->getListOfStatus()[$this->request->post('status')];
        $res = $this->repository->save($order);

        if (is_null($res)) {
            $this->request->addMsg('При обновлении статуса произошла ошибка.');
        } else {
            $this->request->addMsg('Статус успешно изменен.');
        }
        $this->request->redir('');
    }
}
