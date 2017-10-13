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
    }
}