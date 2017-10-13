<?php


namespace Models;

// base class with member properties and methods
class Item
{


    public $id;
    public $name;
    public $price;
    public $available;

    public function __construct($id, $name, $price, $available = true)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->available = $available;
    }

}
