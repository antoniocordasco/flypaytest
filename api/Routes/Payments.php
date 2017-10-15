<?php

namespace Routes;

use DataAccess\ItemsDAO as ItemsDAO;
use Models\Bill;

class Payments
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
     * Runs a specific action.
     */
    public function run()
    {
        $split = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
        $action = $split[1] . 'Action';

        header('Content-type: application/json');

        try {
            echo json_encode($this->$action($_GET));
        } catch (\Exception $e) {
            http_response_code($e->getCode());
        }
    }
}
