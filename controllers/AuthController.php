<?php

namespace App\controllers;

class AuthController extends Controller
{

    public function indexAction()
    {

        return $this->render('auth');
    }

    public function authAction()
    {

        if (!$this->request->isPost()) {
            $this->request->addMsg('Что-то пошло не так.');
            return $this->render('auth');
        }
        if (empty($this->request->post('login')) || empty($this->request->post('password'))) {
            $this->request->addMsg('Нет полных данных.');
            return $this->render('auth');
        }

        $msg = '';
        $user = $this->app->UserRepository->getOne($this->request->post('login'), 'login');

        if (!$this->app->AuthService->verifyUser($user, $this->request->post('password'), $msg)) {
            $this->request->addMsg($msg);
            return $this->render('auth');
        }

        $this->app->AuthService->fillUserData($user, $this->request);
        $this->request->redir("/account/index");
    }

    public function unAuthAction()
    {
        $this->request->setSession('auth', []);
        $this->request->setSession('cart', []);
        $this->request->redir('/auth/index');
    }
}
