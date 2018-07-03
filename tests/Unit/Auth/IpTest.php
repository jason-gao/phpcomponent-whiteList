<?php

namespace Tests\Unit\Auth;

use WhiteList\Auth\Ip;
use WhiteList\Auth\Whitelist;
use WhiteList\Network\Ip\Converter;
use Tests\TestCase;

class IpTest extends TestCase
{
    /**
     * @covers WhiteList\Auth\Ip::__construct
     */
    public function testConstructCorrectInstance()
    {
        $whitelist = new Ip([]);

        $this->assertInstanceOf(Whitelist::class, $whitelist);
    }

    /**
     * @covers WhiteList\Auth\Ip::__construct
     * @covers WhiteList\Auth\Ip::buildWhitelist
     */
    public function testBuildListWithoutAddresses()
    {
        $whitelist = new Ip([]);

        $this->assertNull($whitelist->buildWhitelist([]));
    }

    /**
     * @covers WhiteList\Auth\Ip::__construct
     * @covers WhiteList\Auth\Ip::buildWhitelist
     * @covers WhiteList\Auth\Ip::addWhitelist
     */
    public function testBuildListWithoutConverters()
    {
        $whitelist = new Ip([]);

        $this->assertNull($whitelist->buildWhitelist(['localhost']));
    }

    /**
     * @covers WhiteList\Auth\Ip::__construct
     * @covers WhiteList\Auth\Ip::buildWhitelist
     * @covers WhiteList\Auth\Ip::addWhitelist
     */
    public function testBuildListWithValidConverter()
    {
        $converter = $this->createMock(Converter::class);
        $converter->method('isValid')->will($this->returnValue(true));

        $whitelist = new Ip([$converter]);

        $this->assertNull($whitelist->buildWhitelist(['localhost']));
    }

    /**
     * @covers WhiteList\Auth\Ip::__construct
     * @covers WhiteList\Auth\Ip::buildWhitelist
     * @covers WhiteList\Auth\Ip::addWhitelist
     */
    public function testBuildListWithInvalidConverter()
    {
        $converter = $this->createMock(Converter::class);
        $converter->method('isValid')->will($this->returnValue(false));

        $whitelist = new Ip([$converter]);

        $this->assertNull($whitelist->buildWhitelist(['localhost']));
    }

    /**
     * @covers WhiteList\Auth\Ip::__construct
     * @covers WhiteList\Auth\Ip::buildWhitelist
     * @covers WhiteList\Auth\Ip::addWhitelist
     * @covers WhiteList\Auth\Ip::isAllowed
     */
    public function testIsAllowedTrue()
    {
        $converter = $this->createMock(Converter::class);
        $converter->method('isValid')->will($this->returnValue(true));
        $converter->method('convert')->will($this->returnValue([167772161, 167772165]));

        $whitelist = new Ip([$converter]);

        $whitelist->buildWhitelist(['10.0.0.1-10.0.0.5']);

        $this->assertTrue($whitelist->isAllowed('10.0.0.2'));
    }

    /**
     * @covers WhiteList\Auth\Ip::__construct
     * @covers WhiteList\Auth\Ip::buildWhitelist
     * @covers WhiteList\Auth\Ip::addWhitelist
     * @covers WhiteList\Auth\Ip::isAllowed
     */
    public function testIsAllowedFalse()
    {
        $converter = $this->createMock(Converter::class);
        $converter->method('isValid')->will($this->returnValue(true));
        $converter->method('convert')->will($this->returnValue([167772161, 167772161]));

        $whitelist = new Ip([$converter]);

        $whitelist->buildWhitelist(['10.0.0.1-10.0.0.5']);

        $this->assertFalse($whitelist->isAllowed('10.0.0.2'));
    }
}
