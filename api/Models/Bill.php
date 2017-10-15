<?php

namespace Models;

class Bill
{
    public $total;
    public $toPay;
    public $closed;
    public $tip;

    /**
     * Bill constructor.
     *
     * @param int   $total
     * @param int   $toPay
     * @param mixed $tip
     */
    public function __construct($total, $toPay, $tip = 0)
    {
        $this->total = $total;
        $this->toPay = $toPay;
        $this->closed = (0 === $this->toPay);
        $this->tip = $tip;
    }
}
