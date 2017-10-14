<?php

namespace Fixtures;

/**
 * Defines application features from the specific context.
 */
class ThereAreThreeItemsInTheMenu
{
    /**
     * Loads the fixture's mocked DAOs
     */
    public function load()
    {
        $return = [];
        $return[1] = new \Models\Item(1, 'Salad', 7);
        $return[2] = new \Models\Item(2, 'Hamburger', 10);
        $return[3] = new \Models\Item(3, 'Chips', 3);

        $mock = \Mockery::mock('\DataAccess\ItemsDAO');
        $mock->shouldReceive('getAll')->andReturn($return);
        \DataAccess\ItemsDAO::setInstance($mock);
    }
}
