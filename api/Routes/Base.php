<?php

namespace Routes;

abstract class Base
{
    /**
     * Runs a specific action.
     */
    public function run()
    {
        $split = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
        $action = $split[1] . 'Action';

        header('Content-type: application/json');

        try {
            if (method_exists($this, $action)) {
                echo json_encode($this->$action($_GET));
            } else {
                http_response_code(404);
                echo json_encode(['code' => 404, 'message' => 'Wrong API method']);
            }
        } catch (\Exception $e) {
            http_response_code($e->getCode());
            echo json_encode(['code' => $e->getCode(), 'message' => $e->getMessage()]);
        }
    }
}
