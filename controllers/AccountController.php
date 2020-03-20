<?php

namespace App\controllers;

class AccountController extends Controller
{

    public function indexAction()
    {
        if ($this->request->session('auth')) {
            $isAdmin = $this->app->UserService->isAdmin($this->request);
            if ($isAdmin) {
                $orders = $this->app->OrderRepository->getAll();
            } else {
                $orders = $this->app->OrderRepository->getAll($this->request->session('auth')['user_id'], 'user_id');
            }

            foreach ($orders as $order) {
                $order->orders_data = json_decode($order->orders_data, true);
            }

            return $this->render('account', [
                'name' => $this->request->session('auth')['name'],
                'orders' => $orders,          
                'arrStatus' => $this->app->OrderService->getListOfStatus()
            ]);
        } else {
            $this->request->redir('/auth/index');
        }
    }

    public function registerAction()
    {
        return $this->render('register');
    }

    public function createUserAction()
    {
        if (!$this->request->isPost()) {
            $this->request->redir('/auth/index');
        }

        $password = $this->app->UserService->getPasswordHash($this->request->post('password'));
        if ($this->app->UserRepository->findUser($this->request->post('login'))) {
            $this->request->addMsg('Пользователь с таким логином уже зарегистрирован');
            return $this->render('register');
        }

        $user = $this->app->UserRepository->createUser($password, $this->request->post());
        $this->app->AuthService->fillUserData($user, $this->request);
        $this->request->redir('/account/index');
    }
}
