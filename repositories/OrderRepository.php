<?php

namespace App\repositories;

use App\entities\Order;
use App\main\App;

class OrderRepository extends Repository
{

    protected function getEntityName(): string
    {
        return Order::class;
    }

    protected function getTableName(): string
    {
        return 'orders';
    }

}
