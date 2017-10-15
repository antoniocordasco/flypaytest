<?php

namespace Routes;

use DataAccess\ItemsDAO;
use DataAccess\PaymentsDAO;
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

        $paymentsDAO = PaymentsDAO::getInstance();
        $paid = $paymentsDAO->getTotalAmountPaid();

        return new Bill($total, ($total > $paid) ? $total - $paid : 0, ($paid > $total) ? $paid - $total : 0);
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


        $paymentsDAO = PaymentsDAO::getInstance();
        $paymentsDAO->savePayment($amount);
        $paid = $paymentsDAO->getTotalAmountPaid();

        $itemsDAO = ItemsDAO::getInstance();
        $items = $itemsDAO->getOrderedItems();
        $total = 0;
        foreach ($items as $item) {
            $total += $item->price;
        }

        return new Bill($total, ($total > $paid) ? $total - $paid : 0, ($paid > $total) ? $paid - $total : 0);
    }
}
