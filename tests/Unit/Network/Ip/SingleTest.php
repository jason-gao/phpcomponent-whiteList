<?php

namespace Tests\Unit\Network\Ip;

use WhiteList\Network\Ip\Converter;
use WhiteList\Network\Ip\Single;
use Tests\TestCase;

class SingleTest extends TestCase
{
    /**
     */
    public function testConstructCorrectInstance()
    {
        $ipRange = new Single();

        $this->assertInstanceOf(Converter::class, $ipRange);
    }

    /**
     * @covers WhiteList\Network\Ip\Single::isValid
     */
    public function testIsValidValid()
    {
        $ipRange = new Single();

        $this->assertTrue($ipRange->isValid('127.0.0.1'));
    }

    /**
     * @covers WhiteList\Network\Ip\Single::isValid
     */
    public function testIsValidNotValidCidr()
    {
        $ipRange = new Single();

        $this->assertFalse($ipRange->isValid('127.0.0.1/32'));
    }

    /**
     * @covers WhiteList\Network\Ip\Single::isValid
     */
    public function testIsValidNotValidRange()
    {
        $ipRange = new Single();

        $this->assertFalse($ipRange->isValid('10.0.0.1-10.0.0.5'));
    }

    /**
     * @covers WhiteList\Network\Ip\Single::isValid
     */
    public function testIsValidNotValidLocalhost()
    {
        $ipRange = new Single();

        $this->assertFalse($ipRange->isValid('localhost'));
    }

    /**
     * @covers WhiteList\Network\Ip\Single::isValid
     */
    public function testIsValidNotValidWildcard()
    {
        $ipRange = new Single();

        $this->assertFalse($ipRange->isValid('10.0.0.*'));
    }

    /**
     * @covers WhiteList\Network\Ip\Single::convert
     */
    public function testConvert()
    {
        $ipRange = new Single();

        $this->assertSame([2130706433.0, 2130706433.0], $ipRange->convert('127.0.0.1'));
    }
}
