<?php

namespace Tests\Api\DataAccess;

require 'common.php';

use \DataAccess\ItemsDAO as ItemsDAO;


class ItemsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Unit test for ItemsDAO::getItemById
     */
    public function testGetItemById()
    {
        $itemsDAO = ItemsDAO::getInstance();

        $salad = new \Models\Item(1, 'Salad', 7);
        $this->assertEquals($salad, $itemsDAO->getItemById(1));

        $burger = new \Models\Item(2, 'Hamburger', 10);
        $this->assertEquals($burger, $itemsDAO->getItemById(2));

        $chips = new \Models\Item(3, 'Chips', 3);
        $this->assertEquals($chips, $itemsDAO->getItemById(3));
    }

    /**
     * Unit test for ItemsDAO::setOrderedItems and ItemsDAO::getOrderedItems
     */
    public function testSetGetOrderedItems()
    {
        $orderedItems = [new \Models\Item(1, 'Salad', 7)];

        $itemsDAO = ItemsDAO::getInstance();
        $itemsDAO->setOrderedItems($orderedItems);
        $this->assertEquals(json_decode(json_encode($orderedItems)), $itemsDAO->getOrderedItems());
    }
}