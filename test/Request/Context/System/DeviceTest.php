<?php
/**
 * Build voice applications for Amazon Alexa with phlexa and PHP
 *
 * @author     Ralf Eggert <ralf@travello.audio>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/phoice/phlexa
 * @link       https://www.phoice.tech/
 * @link       https://www.travello.audio/
 */

declare(strict_types=1);

namespace PhlexaTest\Request\Context\System;

use PHPUnit\Framework\TestCase;
use Phlexa\Request\Context\System\Device;

/**
 * Class DeviceTest
 *
 * @package PhlexaTest\Request\Context\System
 */
class DeviceTest extends TestCase
{
    /**
     *
     */
    public function testInstantiation()
    {
        $device = new Device();

        $this->assertNull($device->getDeviceId());
        $this->assertNull($device->getSupportedInterfaces());
    }

    /**
     *
     */
    public function testDeviceId()
    {
        $device = new Device();
        $device->setDeviceId('deviceId');

        $expected = 'deviceId';

        $this->assertEquals($expected, $device->getDeviceId());
        $this->assertNull($device->getSupportedInterfaces());
    }

    /**
     *
     */
    public function testAccessToken()
    {
        $device = new Device();
        $device->setSupportedInterfaces(['AudioPlayer' => []]);

        $expected = ['AudioPlayer' => []];

        $this->assertNull($device->getDeviceId());
        $this->assertEquals($expected, $device->getSupportedInterfaces());
    }
}
