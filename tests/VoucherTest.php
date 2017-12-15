<?php

require './vendor/autoload.php';

use PHPUnit\Framework\TestCase;

/**
 * @covers Voucher
 */
final class VoucherTest extends TestCase {

    /**
     * Test to avaliate if the function isValid is working properly
     */
    public function testIsVoucherValid() {

        $voucher = new Voucher();
        $voucher->setData(1, 1, '10/10/2020');

        $this->assertEquals(
                true, $voucher->isValid()
        );
    }

    /**
     * Test to avaliate if the function isValid is working properly
     */
    public function testIsNotVoucherValid() {

        $voucher = new Voucher();
        $voucher->setData(1, 1, '10/10/2010');

        $this->assertEquals(
                false, $voucher->isValid()
        );
    }

    /**
     * Test to avaliate if the function isRedeemed is working properly 
     */
    public function testIsVoucherUsed() {

        $voucher = new Voucher();
        $voucher->setData(1, 1, '10/10/2020');

        $this->assertEquals(
                false, $voucher->isRedeemed()
        );
    }

    /**
     * Test to avaliate if the function isRedeemed is working properly
     */
    public function testIsNotVoucherUsed() {

        $voucher = new Voucher();
        $voucher->setData(1, 1, '10/10/2020');

        $voucher->setUsed_at('12/08/2017');

        $this->assertEquals(
                true, $voucher->isRedeemed()
        );
    }

}
