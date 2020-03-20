<?php

namespace App\services;

class UserService
{

    public function getPasswordHash($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function isAdmin(Request $request)
    {
        return $request->session('auth')['is_admin'];
    }
}
