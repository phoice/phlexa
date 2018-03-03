<?php
/**
 * Build voice applications for Amazon Alexa with phlexa and PHP
 *
 * @author     Ralf Eggert <ralf@travello.audio>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/phoice/phlexa
 * @link       https://www.phoice.tech/
 *
 */

namespace PhlexaTest\Request\Context;

use PHPUnit\Framework\TestCase;
use Phlexa\Request\Context\AudioPlayer;
use Phlexa\Request\Context\Context;
use Phlexa\Request\Context\System;
use Phlexa\Request\Context\System\Application;
use Phlexa\Request\Context\System\Device;
use Phlexa\Request\Context\System\User;

/**
 * Class ContextTest
 *
 * @package PhlexaTest\Request\Context
 */
class ContextTest extends TestCase
{
    /**
     *
     */
    public function testInstantiation()
    {
        $context = new Context();

        $this->assertNull($context->getAudioPlayer());
        $this->assertNull($context->getSystem());
    }

    /**
     *
     */
    public function testWithSystem()
    {
        $audioPlayer = new AudioPlayer('IDLE');

        $apiEndpoint = 'apiEndpoint';

        $application = new Application('applicationId');
        $user        = new User('userId');
        $device      = new Device();
        $device->setDeviceId('deviceId');

        $system = new System($application, $user, $device, $apiEndpoint);

        $context = new Context();
        $context->setAudioPlayer($audioPlayer);
        $context->setSystem($system);

        $this->assertEquals($system, $context->getSystem());
    }
}
