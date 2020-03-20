<?php

namespace App\entities;

/**
 * function getId
 */
abstract class Entity
{
    public function __get($name)
    {
        $methodName = 'get' . ucfirst($name);
        if (property_exists($this, $name) && method_exists($this, $methodName)) {
            return $this->$methodName();
        } else {

            return null;
        }
    }

    public function __set($name, $value)
    {
        $methodName = 'set' . ucfirst($name);
        if (property_exists($this, $name) && method_exists($this, $methodName)) {
            $this->$methodName($value);
        }
    }

    public function getPlaceHolderArr()
    {
        $placeHolderArr = [];
        foreach ($this as $field => $value) {
            if ($field === 'db') {
                continue;
            }
            $placeHolderArr[":{$field}"] = $value;
        }
        $placeHolderArr[":id"] = $this->id;

        return $placeHolderArr;
    }

    public function getValueArr()
    {
        $valueArr = [];
        foreach ($this as $field => $value) {
            if ($field === 'db') {
                continue;
            }
            $valueArr[] = "{$field}=:{$field}";
        }
        return $valueArr;
    }

    public function getFieldArr()
    {
        $fieldArr = [];
        foreach ($this as $field => $value) {
            if ($field === 'db') {
                continue;
            }
            $fieldArr[] = $field;
        }
        return $fieldArr;
    }
}
