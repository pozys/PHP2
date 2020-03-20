<?php

namespace App\entities;

class User extends Entity
{
    protected $id;
    protected $login;
    protected $password;
    protected $name;
    protected $is_admin = 0;
    protected $adress;
    protected $tel;
    protected $blocked = 0;

    protected static function getTableName(): string
    {
        return 'users';
    }

    public function getId()
    {
        return $this->id;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getIs_admin()
    {
        return $this->is_admin;
    }

    public function getAdress()
    {
        return $this->adress;
    }

    public function getTel()
    {
        return $this->tel;
    }

    public function getBlocked()
    {
        return $this->blocked;
    }

    public function setId($value)
    {
        return $this->id = $value;
    }

    public function setLogin($value)
    {
        return $this->login = $value;
    }

    public function setPassword($value)
    {
        return $this->password = $value;
    }

    public function setName($value)
    {
        return $this->name = $value;
    }

    public function setIs_admin($value)
    {
        return $this->is_admin = $value;
    }

    public function setAdress($value)
    {
        return $this->adress = $value;
    }

    public function setTel($value)
    {
        return $this->tel = $value;
    }

    public function setBlocked($value)
    {
        return $this->blocked = $value;
    }
}
