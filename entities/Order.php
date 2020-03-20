<?php

namespace App\entities;

class Order extends Entity
{
    protected $id;
    protected $user_id;
    protected $sum;
    protected $orders_data = '';
    protected $user_name;
    protected $adress;
    protected $tel;
    protected $status = 'Принят';

    protected static function getTableName(): string
    {
        return 'orders';
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUser_id()
    {
        return $this->user_id;
    }

    public function getSum()
    {
        return $this->sum;
    }

    public function getOrders_data()
    {
        return $this->orders_data;
    }

    public function getUser_name()
    {
        return $this->user_name;
    }

    public function getAdress()
    {
        return $this->adress;
    }

    public function getTel()
    {
        return $this->tel;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setId($value)
    {
        return $this->id = $value;
    }

    public function setUser_id($value)
    {
        return $this->user_id = $value;
    }

    public function setSum($value)
    {
        return $this->sum = $value;
    }

    public function setOrders_data($value)
    {
        return $this->orders_data = $value;
    }

    public function setUser_name($value)
    {
        return $this->user_name = $value;
    }

    public function setAdress($value)
    {
        return $this->adress = $value;
    }

    public function setTel($value)
    {
        return $this->tel = $value;
    }

    public function setStatus($value)
    {
        return $this->status = $value;
    }
}
