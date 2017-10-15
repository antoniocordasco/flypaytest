<?php

namespace Models;

class Bill
{
    public $total;
    public $toPay;

    /**
     * Bill constructor.
     * @param int $total
     * @param int $toPay
     */
    public function __construct($total, $toPay)
    {
        $this->total = $total;
        $this->toPay = $toPay;
    }
}