<?php

namespace App\repositories;

use App\entities\User;

class UserRepository extends Repository
{
    protected function getEntityName(): string
    {
        return User::class;
    }

    protected function getTableName(): string
    {
        return 'users';
    }

    public function createUser($password, $params)
    {
        $user = new User;
        $user->login = $params['login'];
        $user->password = $password;
        $user->name = $params['name'];
        $user->adress = $params['adress'];
        $user->tel = $params['tel'];

        $params['password'] = $password;
        $this->save($user);

        return $user;
    }

    public function findUser($login)
    {
        return $this->getOne($login, 'login');
    }

}
