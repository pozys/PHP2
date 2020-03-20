<?php

namespace App\repositories;

use App\entities\Entity;
use App\main\App;
use \App\services\DB;

abstract class Repository
{
    /**
     * @var DB
     */
    protected $db;

    abstract protected function getTableName(): string;
    abstract protected function getEntityName(): string;

    public function __construct()
    {
        $this->db = static::getDB();
    }

    protected function getDB()
    {
        return DB::getInstance();
    }

    public function getOne($condition, $searchField = 'id')

    {
        return static::getDB()->find($this->queryTextGET($searchField, $searchField), $this->getEntityName(), [":{$searchField}" => $condition]);
    }

    public function getAll($condition = '', $searchField = '')
    {
        return static::getDB()->findAll($this->queryTextGET($searchField, $searchField), $this->getEntityName(), [":{$searchField}" => $condition]);
    }

    public function getSelected(array $idArray, $searchField = 'id')
    {
        return static::getDB()->findSelected($this->queryTextGET($searchField, implode(',', array_keys($idArray)), true), $this->getEntityName(), $idArray);
    }

    protected function insert(Entity $entity)
    {
        $fieldArr = $entity->getFieldArr();
        $placeHolderArr = $entity->getPlaceHolderArr();

        $text = sprintf(
            "INSERT INTO %s (%s) VALUES (%s)",
            $this->getTableName(),
            implode(',', $fieldArr),
            implode(',', array_keys($placeHolderArr))
        );

        $res = $this->db->execute($text, $this->getEntityName(), $placeHolderArr);
        $entity->id = (int) $this->db->getLastId();
        return $res;
    }

    protected function update(Entity $entity)
    {
        $valueArr = $entity->getValueArr();
        $placeHolderArr = $entity->getPlaceHolderArr();

        $text = sprintf(
            "UPDATE %s SET %s WHERE %s",
            $this->getTableName(),
            implode(',', $valueArr),
            "id=:id"
        );

        return $this->db->execute($text, $this->getEntityName(), $placeHolderArr);
    }

    public function save(Entity $entity)
    {
        $id = $entity->id;
        if (empty($id)) {
            return $this->insert($entity);
        } else {
            return $this->update($entity);
        }
    }

    public function delete(Entity $entity)
    {
        $text = "DELETE FROM {$this->getTableName()} WHERE id=:id";
        $this->db->execute($text, $this->getEntityName(), [':id' => $entity->id]);
    }

    protected function queryTextGET(string $searchField = '', string $condition = '', bool $multiple = false)
    {
        $tableName = $this->getTableName();
        $text = "SELECT * FROM {$tableName}";

        if (!empty($condition) || $multiple) {
            $text .= " WHERE {$searchField}";
            if ($multiple) {
                $text .= " IN(" . (empty($condition) ? 'null' : $condition) . ")";
            } else {
                $text .= "=:{$condition}";
            }
        }

        return $text;
    }

    protected function fillPropertiesFromPOST(Entity $entity)
    {
        if (!App::call()->request->isPost() || App::call()->request->isEmptyPOST) {
            return null;
        }

        $post = App::call()->request->post();

        foreach ($post as $key => $value) {
            $entity->$key = $value;
        }
    }
}
