<?php

namespace DataAccess;

// base class with member properties and methods
class BaseDAO
{
    private static $instance;

    public static function getInstance()
    {
        if (self::$instance) {
            return self::$instance;
        }

        return new static();
    }

    public static function setInstance($instance)
    {
        self::$instance = $instance;
    }
}
