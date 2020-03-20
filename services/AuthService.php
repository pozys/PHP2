<?php

namespace App\services;

class AuthService
{
    public function verifyUser($user, string $password, string &$msg): bool
    {
        if (empty($user) || !password_verify($password, $user->password)) {
            $msg = 'Неверный логин или пароль.';
            return false;
        }

        if ($user->blocked) {
            $msg = 'Пользователь заблокирован.';
            return false;
        }

        return true;
    }

    public function fillUserData($user, Request $request)
    {
        $authArray = [];
        $authArray['id'] = $user->id;
        $authArray['login'] = $user->login;
        $authArray['name'] = $user->name;
        $authArray['user_id'] = (int) $user->id;
        $authArray['adress'] = $user->adress;
        $authArray['tel'] = $user->tel;
        $authArray['is_admin'] = (bool) $user->is_admin;
        $authArray['blocked'] = (bool) $user->blocked;

        $request->setSession('auth', $authArray);
    }
}
