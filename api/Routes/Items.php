<?php

namespace Routes;

use DataAccess\ItemsDAO as ItemsDAO;

class Items extends Base
{
    /**
     * Controller action to list all items.
     *
     * @return array
     */
    public function listAction()
    {
        $itemsDAO = ItemsDAO::getInstance();
        return $itemsDAO->getAll();
    }

    /**
     * Controller action to order an item.
     *
     * @param $args
     * @return int|string
     */
    public function orderItemAction($args)
    {
        $id = (int)($args['id']);
        $quantity = (int)($args['quantity']) ? (int)($args['quantity']) : 1;

        $itemsDAO = ItemsDAO::getInstance();
        $item = $itemsDAO->getItemById($id);

        $items = $itemsDAO->getOrderedItems();

        if ($item && $item->available) {
            for ($i = 0; $i < $quantity; ++$i) {
                $items[] = $item;
            }

            setcookie('items', json_encode($items), 0, '/');

            return count($items);
        } else {
            throw new \Exception('The requested item is not available', 403);
        }
    }

    /**
     * Controller action to cancel all orders.
     *
     * @param $args
     */
    public function cancelAllItemsAction($args)
    {
        $itemsDAO = ItemsDAO::getInstance();
        $itemsDAO->setOrderedItems([]);
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
        $id = (int)($args['id']);
        $quantity = (int)($args['quantity']) ? (int)($args['quantity']) : 1;

        $itemsDAO = ItemsDAO::getInstance();
        $items = $itemsDAO->getOrderedItems();

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

        $itemsDAO->setOrderedItems($updatedItems);

        return count($items);
    }
}
