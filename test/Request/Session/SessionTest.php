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

namespace PhlexaTest\Request\Session;

use Phlexa\Request\Session\Application;
use Phlexa\Request\Session\Session;
use Phlexa\Request\Session\User;
use PHPUnit\Framework\TestCase;

/**
 * Class SessionTest
 *
 * @package PhlexaTest\Request\Session
 */
class SessionTest extends TestCase
{
    /**
     *
     */
    public function testInstantiation()
    {
        $application = new Application('applicationId');
        $attributes  = ['foo' => 'bar'];
        $user        = new User('userId', 'accessToken');

        $session = new Session(
            true,
            'sessionId',
            $application,
            $attributes,
            $user
        );

        $this->assertEquals(true, $session->isNew());
        $this->assertEquals('sessionId', $session->getSessionId());
        $this->assertEquals($application, $session->getApplication());
        $this->assertEquals($attributes, $session->getAttributes());
        $this->assertEquals($attributes['foo'], $session->getAttribute('foo'));
        $this->assertEquals(null, $session->getAttribute('bar'));
        $this->assertEquals($user, $session->getUser());
    }
}
