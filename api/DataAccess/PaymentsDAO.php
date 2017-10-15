<?php

namespace DataAccess;

class PaymentsDAO extends BaseDAO
{
    public static $instance;

    public function savePayment($amount)
    {
        $amountPaid = $this->getTotalAmountPaid();
        setcookie('paid', ($amountPaid + $amount), 0, '/');

        // we need to also set the variable so that it can be accessed during the same request
        $_COOKIE['paid'] = ($amountPaid + $amount);
    }

    public function getTotalAmountPaid()
    {
        return (int)$_COOKIE['paid'];
    }
}