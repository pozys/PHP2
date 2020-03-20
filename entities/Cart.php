<?php

namespace App\entities;

class Cart extends Entity
{
    protected $goods = [];

    public function __construct($goods)
    {
        $this->goods = $goods;
    }

    public function getGoods()
    {
        return $this->goods;
    }

    public function setGoods($value)
    {
        return $this->goods = $value;
    }

}
