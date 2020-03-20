<?php

namespace App\entities;

class Feedback extends Entity
{
    protected $id;
    protected $image_id;
    protected $feedback;

    protected static function getTableName(): string
    {
        return 'feedbacks';
    }

    public function getId()
    {
        return $this->id;
    }

    public function getImage_id()
    {
        return $this->image_id;
    }

    public function getFeedback()
    {
        return $this->feedback;
    }

    public function setImage_id($value)
    {
        return $this->image_id = $value;
    }

    public function setId($value)
    {
        return $this->id = $value;
    }
}
