<?php

namespace DataAccess;

use \Models\Item as Item;

// base class with member properties and methods
class Items
{
    private static $instance;

    public function __construct()
    {
    }

    public static function getInstance()
    {
        if (self::$instance) {
            return self::$instance;
        } else {
            return new self();
        }
    }


    public static function setInstance($instance)
    {
        self::$instance = $instance;
    }


    public function getAll()
    {
        $items = [];
        $items[1] = $this->getItemById(1);
        $items[2] = $this->getItemById(2);
        $items[3] = $this->getItemById(3);
        return $items;
    }


    function getItemById($id)
    {
        switch ($id) {
            case 1:
                return new Item($id, 'Salad', 7);
            case 2:
                return new Item($id, 'Hamburger', 10);
            case 3:
                return new Item($id, 'Chips', 3);
        }

    }

}
