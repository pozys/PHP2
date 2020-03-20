<?php

namespace App\repositories;

use App\entities\Good;

class GoodRepository extends Repository
{

    protected function getEntityName(): string
    {
        return Good::class;
    }

    protected function getTableName(): string
    {
        return 'goods';
    }

    public function getNewFilledItem()
    {
        $good = new Good;

        $this->fillPropertiesFromPOST($good);

        return $good;
    }
}
