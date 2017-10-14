<?php

namespace Fixtures;

/**
 * Defines application features from the specific context.
 */
class BurgersAreAvailable
{
    /**
     * Loads the fixture's mocked DAOs
     */
    public function load()
    {
        $return = new \Models\Item(2, 'Hamburger', 10);

        $mock = \Mockery::mock('\DataAccess\ItemsDAO');
        $mock->shouldReceive('getItemById')->andReturn($return);
        $mock->shouldReceive('getOrderedItems')->andReturn([]);
        \DataAccess\ItemsDAO::setInstance($mock);
    }
}
