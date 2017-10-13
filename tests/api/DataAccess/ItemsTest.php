<?php

namespace Tests\Api\DataAccess;

use \DataAccess\Items;

require 'common.php';

class ItemsTest extends \PHPUnit_Framework_TestCase
{
    public function testGetItemById()
    {
        $salad = new \Models\Item(1, 'Salad', 7);
        $itemsDataAccess = new \DataAccess\Items();
        $this->assertEquals($salad, $itemsDataAccess->getItemById(1));

        $burger = new \Models\Item(2, 'Hamburger', 10);
        $itemsDataAccess = new \DataAccess\Items();
        $this->assertEquals($burger, $itemsDataAccess->getItemById(2));

        $chips = new \Models\Item(3, 'Chips', 3);
        $itemsDataAccess = new \DataAccess\Items();
        $this->assertEquals($chips, $itemsDataAccess->getItemById(3));
    }
}