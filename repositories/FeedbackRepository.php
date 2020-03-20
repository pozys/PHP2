<?php

namespace App\repositories;

use App\entities\Feedback;

class FeedbackRepository extends Repository
{

    protected function getEntityName(): string
    {
        return Feedback::class;
    }

    protected function getTableName(): string
    {
        return 'feedbacks';
    }
}
