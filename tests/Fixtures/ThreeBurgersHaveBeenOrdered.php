<?php

namespace Fixtures;

/**
 * Defines application features from the specific context.
 */
class ThreeBurgersHaveBeenOrdered
{
    /**
     * Loads the fixture's mocked DAOs
     */
    public function load()
    {
        $return = [new \Models\Item(2, 'Hamburger', 10),new \Models\Item(2, 'Hamburger', 10),new \Models\Item(2, 'Hamburger', 10)];

        $mock = \Mockery::mock('\DataAccess\ItemsDAO');
        $mock->shouldReceive('getOrderedItems')->andReturn($return);
        \DataAccess\ItemsDAO::setInstance($mock);
    }
}
