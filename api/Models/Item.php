<?php

namespace Models;

// base class with member properties and methods
class Item
{
    public $id;
    public $name;
    public $price;
    public $available;

    /**
     * Item constructor.
     *
     * @param int $id
     * @param string $name
     * @param int $price
     * @param bool $available
     */
    public function __construct($id, $name, $price, $available = true)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->available = $available;
    }
}
