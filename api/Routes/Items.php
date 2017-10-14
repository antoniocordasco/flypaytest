<?php

/*
 * This file is part of PHP CS Fixer.
 * (c) Fabien Potencier <fabien@symfony.com>
 *     Dariusz Rumiński <dariusz.ruminski@gmail.com>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Routes;

use \DataAccess\ItemsDAO as ItemsDAO;


// base class with member properties and methods
class Items
{
    public function __construct()
    {
    }

    public function listAction()
    {
        $items = ItemsDAO::getInstance();
        return $items->getAll();
    }

    public function orderItemAction($args)
    {
        $id = (int)($args['id']);
        $quantity = (int)($args['quantity']) ? (int)($args['quantity']) : 1;

        $itemsDAO = new ItemsDAO();
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
        }

        return 'error';
    }

    public function cancelAllItemsAction($args)
    {
        $items = [];
        setcookie('items', json_encode($items), 0, '/');
    }

    public function cancelItemAction($args)
    {
        $id = (int)($args['id']);
        $quantity = (int)($args['quantity']) ? (int)($args['quantity']) : 1;

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

    public function run()
    {
        $split = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
        $action = $split[1] . 'Action';

        header('Content-type: application/json');

        echo json_encode($this->$action($_GET));
    }
}
