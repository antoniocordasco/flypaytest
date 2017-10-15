<?php

namespace Routes;

use DataAccess\ItemsDAO as ItemsDAO;
use Models\Bill;

class Payments extends Base
{

    /**
     * Controller action to get the bill.
     *
     * @return array
     */
    public function billAction()
    {


        $itemsDAO = ItemsDAO::getInstance();
        $items = $itemsDAO->getOrderedItems();
        $total = 0;
        foreach ($items as $item) {
            $total += $item->price;
        }

        return new Bill($total, $total);
    }
}
