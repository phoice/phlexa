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

namespace PhlexaTest\Request\Session;

use PHPUnit\Framework\TestCase;
use Phlexa\Request\Session\User;

/**
 * Class UserTest
 *
 * @package PhlexaTest\Request\Session
 */
class UserTest extends TestCase
{
    /**
     *
     */
    public function testInstantiationWithAccessToken()
    {
        $user = new User('userId', 'accessToken');

        $expected = 'accessToken';

        $this->assertEquals($expected, $user->getAccessToken());
    }

    /**
     *
     */
    public function testInstantiationWithUserId()
    {
        $user = new User('userId');

        $expected = 'userId';

        $this->assertEquals($expected, $user->getUserId());
    }
}
