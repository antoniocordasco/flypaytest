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

    /**
     * Controller action to make a payment.
     *
     * @param $args
     * @return Bill
     */
    public function payAction($args)
    {
        $amount = (int)$args['amount'];

        $itemsDAO = ItemsDAO::getInstance();
        $items = $itemsDAO->getOrderedItems();
        $total = 0;
        foreach ($items as $item) {
            $total += $item->price;
        }

        return new Bill($total, ($total - $amount));
    }
}
