<?php

namespace Fixtures;

/**
 * Defines application features from the specific context.
 */
class TwoChipsHaveBeenOrderedAndAPaymentHasBeenMade
{
    /**
     * Loads the fixture's mocked DAOs
     */
    public function load()
    {
        $return = [new \Models\Item(3, 'Chips', 3), new \Models\Item(3, 'Chips', 3)];

        $mock = \Mockery::mock('\DataAccess\ItemsDAO');
        $mock->shouldReceive('getOrderedItems')->andReturn($return);
        \DataAccess\ItemsDAO::setInstance($mock);

        $mock = \Mockery::mock('\DataAccess\PaymentsDAO');
        $mock->shouldReceive('getTotalAmountPaid')->andReturn(3);
        \DataAccess\PaymentsDAO::setInstance($mock);
    }
}
