<?php

namespace App\services;

class OrderService
{

    public function getListOfStatus()
    {
        $arr = [];
        $arr['taken'] = 'Принят';
        $arr['processing'] = 'Обрабатывается';
        $arr['formed'] = 'Собран';
        $arr['transit'] = 'В пути';
        $arr['done'] = 'Доставлен';

        return $arr;
    }
}
