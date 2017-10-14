<?php

namespace Tests\Api\DataAccess;

require 'common.php';

use DataAccess\ItemsDAO as ItemsDAO;

/**
 * @coversNothing
 */
class ItemsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Unit test for ItemsDAO::testGetAll.
     */
    public function testGetAll()
    {
        $return = [];
        $return[1] = new \Models\Item(1, 'Salad', 7);
        $return[2] = new \Models\Item(2, 'Hamburger', 10);
        $return[3] = new \Models\Item(3, 'Chips', 3);

        $itemsDAO = ItemsDAO::getInstance();
        $this->assertSame($return, $itemsDAO->getAll());
    }

    /**
     * Unit test for ItemsDAO::getItemById.
     */
    public function testGetItemById()
    {
        $itemsDAO = ItemsDAO::getInstance();

        $salad = new \Models\Item(1, 'Salad', 7);
        $this->assertSame($salad, $itemsDAO->getItemById(1));

        $burger = new \Models\Item(2, 'Hamburger', 10);
        $this->assertSame($burger, $itemsDAO->getItemById(2));

        $chips = new \Models\Item(3, 'Chips', 3);
        $this->assertSame($chips, $itemsDAO->getItemById(3));
    }

    /**
     * Unit test for ItemsDAO::setOrderedItems and ItemsDAO::getOrderedItems.
     */
    public function testSetGetOrderedItems()
    {
        $orderedItems = [new \Models\Item(1, 'Salad', 7)];

        $itemsDAO = ItemsDAO::getInstance();
        $itemsDAO->setOrderedItems($orderedItems);

        // data is stored in cookies as JSON, so everything is converted to standard objects.
        // that's why we need to encode and decode if we want to compare the data.
        $this->assertSame(json_decode(json_encode($orderedItems)), $itemsDAO->getOrderedItems());
    }
}
