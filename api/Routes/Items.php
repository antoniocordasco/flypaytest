<?php

namespace Routes;

use DataAccess\ItemsDAO as ItemsDAO;
use Mockery\Exception;

// base class with member properties and methods
class Items
{
    /**
     * Controller action to list all items.
     *
     * @return array
     */
    public function listAction()
    {
        $items = ItemsDAO::getInstance();

        return $items->getAll();
    }

    /**
     * Controller action to order an item.
     *
     * @param $args
     * @return int|string
     */
    public function orderItemAction($args)
    {
        $id = (int) ($args['id']);
        $quantity = (int) ($args['quantity']) ? (int) ($args['quantity']) : 1;

        $itemsDAO = ItemsDAO::getInstance();
        $item = $itemsDAO->getItemById($id);

        $items = json_decode($_COOKIE['items']);

        if (!$items) {
            $items = [];
        }

        if ($item && $item->available) {
            for ($i = 0; $i < $quantity; ++$i) {
                $items[] = $item;
            }

            setcookie('items', json_encode($items), 0, '/');

            return count($items);
        } else {
            throw new Exception('The requested item is not available', 403);
        }
    }

    /**
     * Controller action to cancel all orders.
     *
     * @param $args
     */
    public function cancelAllItemsAction($args)
    {
        $items = [];
        setcookie('items', json_encode($items), 0, '/');
        return 0;
    }

    /**
     * Controller action to cancel the order of a specific item.
     *
     * @param $args
     * @return int
     */
    public function cancelItemAction($args)
    {
        $id = (int) ($args['id']);
        $quantity = (int) ($args['quantity']) ? (int) ($args['quantity']) : 1;

        $items = json_decode($_COOKIE['items']);

        if (!$items) {
            $items = [];
        }

        $deleted = 0;
        $count = count($items);
        for ($i = 0; $i < $count; ++$i) {
            if ($items[$i]->id === $id && $deleted < $quantity) {
                unset($items[$i]);
                ++$deleted;
            }
        }

        $updatedItems = [];
        foreach ($items as $item) {
            $updatedItems[] = $item;
        }

        setcookie('items', json_encode($updatedItems), 0, '/');

        return count($items);
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
        } catch (Exception $e) {
            http_response_code($e->getCode());
        }
    }
}
