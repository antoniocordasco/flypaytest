<?php

namespace DataAccess;

use \Models\Item as Item;

// base class with member properties and methods
class ItemsDAO extends BaseDAO
{
    /**
     * Returns all items, even the ones that are not available.
     *
     * @return array
     */
    public function getAll()
    {
        $items = [];
        $items[1] = $this->getItemById(1);
        $items[2] = $this->getItemById(2);
        $items[3] = $this->getItemById(3);
        return $items;
    }

    public function getOrderedItems()
    {
        $items = json_decode($_COOKIE['items']);

        if (!$items) {
            $items = [];
        }
        return $items;
    }

    /**
     * Gets an item by id.
     *
     * @param $id
     * @return Item
     */
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
