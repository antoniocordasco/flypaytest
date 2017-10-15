<?php

namespace Fixtures;

/**
 * Defines application features from the specific context.
 */
class TwoChipsHaveBeenOrderedWithoutAnyPaymentsBeingMadeAndAllGetCancelled
{
    /**
     * Loads the fixture's mocked DAOs
     */
    public function load()
    {
        $return = [new \Models\Item(3, 'Chips', 3), new \Models\Item(3, 'Chips', 3)];

        $mock = \Mockery::mock('\DataAccess\ItemsDAO');
        $mock->shouldReceive('getOrderedItems')->once()->andReturn($return);
        $mock->shouldReceive('setOrderedItems')->once()->with([]);
        \DataAccess\ItemsDAO::setInstance($mock);
    }
}
