<?php

namespace DataAccess;

// base class with member properties and methods
class BaseDAO
{
    /**
     * Returns the current instance of the DAO. It will be a mocked DAO when running behat tests.
     *
     * @return static
     */
    public static function getInstance()
    {
        if (static::$instance) {
            return static::$instance;
        }

        return new static();
    }

    /**
     * Sets the current instance for the DAO.
     *
     * @param $instance
     */
    public static function setInstance($instance)
    {
        static::$instance = $instance;
    }
}
