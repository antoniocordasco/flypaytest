<?php

namespace Tests\Api\DataAccess;

require 'common.php';

use DataAccess\PaymentsDAO;
/**
 * @coversNothing
 */
class PaymentsDAOTest extends \PHPUnit_Framework_TestCase
{
    public function testSetGetOrderedItems()
    {
        $paymentsDAO = PaymentsDAO::getInstance();
        $paymentsDAO->savePayment(10);

        $this->assertEquals(10, $paymentsDAO->getTotalAmountPaid());
    }
}
