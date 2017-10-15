<?php

namespace Fixtures;

/**
 * Defines application features from the specific context.
 */
class NothingHasBeenOrdered
{
    /**
     * Loads the fixture's mocked DAOs
     */
    public function load()
    {
        $mock = \Mockery::mock('\DataAccess\ItemsDAO');
        $mock->shouldReceive('getOrderedItems')->andReturn([]);
        \DataAccess\ItemsDAO::setInstance($mock);
    }
}
