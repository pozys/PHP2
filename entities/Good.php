<?php

namespace App\entities;

class Good extends Entity
{
    protected $id;
    protected $path = '';
    protected $name = '';
    protected $size = 0;
    protected $viewings = 0;
    protected $price = 0;
    protected $good_name;

    public function getImagePlaceholder(int $width, int $height)
    {
        return "https://placehold.it/{$width}x{$height}";
    }

    /**
     * @width - ширина картинки-placeholder'а
     * @height - высота картинки-placeholder'а
     */
    public function getImagePath(int $width, int $height)
    {
        $defaultImageName = $this->getImagePlaceholder($width, $height);
        $imageName = $defaultImageName;
        if (!empty($this->path) && !empty($this->name)) {
            $imageName = "/{$this->path}/{$this->name}";
            // if (!file_exists($imageName)) {
            //     $imageName = $defaultImageName;
            // }
        }

        return $imageName;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function getViewings()
    {
        return $this->viewings;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getGood_name()
    {
        return $this->good_name;
    }

    public function setId($value)
    {
        return $this->id = $value;
    }

    public function setPath($value)
    {
        return $this->path = $value;
    }

    public function setName($value)
    {
        return $this->name = $value;
    }

    public function setSize($value)
    {
        return $this->size = $value;
    }

    public function setViewings($value)
    {
        return $this->viewings = $value;
    }

    public function setPrice($value)
    {
        return $this->price = $value;
    }

    public function setGood_name($value)
    {
        return $this->good_name = $value;
    }
}
