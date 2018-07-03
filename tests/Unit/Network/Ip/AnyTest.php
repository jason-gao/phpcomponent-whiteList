<?php

namespace Tests\Unit\Network\Ip;

use WhiteList\Network\Ip\Any;
use WhiteList\Network\Ip\Converter;
use Tests\TestCase;

class AnyTest extends TestCase
{
    /**
     */
    public function testConstructCorrectInstance()
    {
        $ipRange = new Any();

        $this->assertInstanceOf(Converter::class, $ipRange);
    }

    /**
     * @covers WhiteList\Network\Ip\Any::isValid
     */
    public function testIsValidValid()
    {
        $ipRange = new Any();

        $this->assertTrue($ipRange->isValid('*'));
    }

    /**
     * @covers WhiteList\Network\Ip\Any::isValid
     */
    public function testIsValidNotValidSingle()
    {
        $ipRange = new Any();

        $this->assertFalse($ipRange->isValid('127.0.0.1'));
    }

    /**
     * @covers WhiteList\Network\Ip\Any::isValid
     */
    public function testIsValidNotValidCidr()
    {
        $ipRange = new Any();

        $this->assertFalse($ipRange->isValid('127.0.0.1/32'));
    }

    /**
     * @covers WhiteList\Network\Ip\Any::isValid
     */
    public function testIsValidNotValidRange()
    {
        $ipRange = new Any();

        $this->assertFalse($ipRange->isValid('10.0.0.1-10.0.0.5'));
    }

    /**
     * @covers WhiteList\Network\Ip\Any::isValid
     */
    public function testIsValidNotValidLocalhost()
    {
        $ipRange = new Any();

        $this->assertFalse($ipRange->isValid('localhost'));
    }

    /**
     * @covers WhiteList\Network\Ip\Any::isValid
     */
    public function testIsValidNotValidWildcard()
    {
        $ipRange = new Any();

        $this->assertFalse($ipRange->isValid('10.0.0.*'));
    }

    /**
     * @covers WhiteList\Network\Ip\Any::convert
     */
    public function testConvert()
    {
        $ipRange = new Any();

        $this->assertSame([0.0, 4294967295.0], $ipRange->convert('*'));
    }
}
