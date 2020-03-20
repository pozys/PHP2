<?php

namespace App\controllers;

use App\main\App;
use App\repositories\UserRepository;

class UserController extends Controller
{
    public function __construct($renderer, $request, App $app)
    {
        parent::__construct($renderer, $request, $app);
        $this->repository = new UserRepository($request);
    }

    public function getAllAction()
    {
        $users = $this->repository->getAll();
        return $this->render('users', ['users' => $users]);
    }

    public function changeStatusAction()
    {
        if (!$this->request->isPost() || empty($this->request->get('id'))) {
            $this->request->redir('');
        }

        $user = $this->repository->getOne($this->request->get('id'));
        
        $user->is_admin = (int) ($this->request->post('is_admin') === 'on');
        $user->blocked = (int) ($this->request->post('blocked') === 'on');

        if (is_null($this->repository->save($user))) {
            $this->request->addMsg('При обновлении данных пользователя произошла ошибка.');
        } else {
            $this->request->addMsg('Пользователь успешно изменен.');
        }
        $this->request->redir('');
    }
}
