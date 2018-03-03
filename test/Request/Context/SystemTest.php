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

namespace PhlexaTest\Request\Context;

use PHPUnit\Framework\TestCase;
use Phlexa\Request\Context\System;
use Phlexa\Request\Context\System\Application;
use Phlexa\Request\Context\System\Device;
use Phlexa\Request\Context\System\User;

/**
 * Class SystemTest
 *
 * @package PhlexaTest\Request\Context
 */
class SystemTest extends TestCase
{
    /**
     *
     */
    public function testInstantiation()
    {
        $application = new Application('applicationId');
        $user        = new User('userId');
        $device      = new Device();
        $apiEndpoint = 'apiEndpoint';

        $system = new System($application, $user, $device, $apiEndpoint);

        $this->assertEquals($application, $system->getApplication());
        $this->assertEquals($user, $system->getUser());
        $this->assertEquals($device, $system->getDevice());
        $this->assertEquals($apiEndpoint, $system->getApiEndpoint());
    }
}
