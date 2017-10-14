<?php

namespace Fixtures;

/**
 * Defines application features from the specific context.
 */
class ThereAreThreeItemsInTheMenu
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

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
