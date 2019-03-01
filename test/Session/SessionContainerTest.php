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

namespace Session;

use Phlexa\Request\AlexaRequest;
use Phlexa\Request\Context\AudioPlayer;
use Phlexa\Request\Context\Context;
use Phlexa\Request\RequestType\LaunchRequestType;
use Phlexa\Request\Session\Application;
use Phlexa\Request\Session\Session;
use Phlexa\Request\Session\User;
use Phlexa\Session\SessionContainer;
use PHPUnit\Framework\TestCase;

/**
 * Class SessionContainerTest
 *
 * @package Session
 */
class SessionContainerTest extends TestCase
{
    public function testInstantiation()
    {
        $defaults = [
            'foo' => null,
            'bar' => [],
        ];

        $sessionContainer = new SessionContainer($defaults);

        $this->assertEquals($defaults, $sessionContainer->getAttributes());
    }

    public function testAttributes()
    {
        $defaults = [
            'foo' => 'bar',
        ];

        $sessionContainer = new SessionContainer($defaults);

        $this->assertEquals('bar', $sessionContainer->getAttribute('foo'));
        $this->assertEquals(null, $sessionContainer->getAttribute('bar'));
    }

    public function testInitialization()
    {
        $defaults = [
            'foo' => null,
            'bar' => [],
        ];

        $alexaRequest = $this->createAlexaRequest();

        $sessionContainer = new SessionContainer($defaults);
        $sessionContainer->initAttributes($alexaRequest);

        $this->assertEquals($alexaRequest->getSession()->getAttributes(), $sessionContainer->getAttributes());
    }

    public function testResetting()
    {
        $defaults = [
            'foo' => null,
            'bar' => [],
        ];

        $alexaRequest = $this->createAlexaRequest();

        $sessionContainer = new SessionContainer($defaults);
        $sessionContainer->initAttributes($alexaRequest);
        $sessionContainer->resetAttributes();

        $this->assertEquals($defaults, $sessionContainer->getAttributes());
    }

    public function testClearing()
    {
        $defaults = [
            'foo' => 'bar',
            'bar' => [],
        ];

        $sessionContainer = new SessionContainer($defaults);
        $sessionContainer->clearAttributes();

        $this->assertEquals([], $sessionContainer->getAttributes());
    }

    public function testAppending()
    {
        $defaults = [
            'foo' => null,
            'bar' => [],
        ];

        $alexaRequest = $this->createAlexaRequest();

        $sessionContainer = new SessionContainer($defaults);
        $sessionContainer->initAttributes($alexaRequest);
        $sessionContainer->appendAttribute('foo', 'foo');
        $sessionContainer->appendAttribute('bar', 'foobarfoo');

        $expected = [
            'foo' => [
                'bar',
                'foo',
            ],
            'bar' => [
                'foobar' => 'barfoo',
                'barfoo' => 'foobar',
                0        => 'foobarfoo',
            ],
        ];

        $this->assertEquals($expected, $sessionContainer->getAttributes());
    }

    public function testRemoving()
    {
        $defaults = [
            'foo' => null,
            'bar' => [],
        ];

        $alexaRequest = $this->createAlexaRequest();

        $sessionContainer = new SessionContainer($defaults);
        $sessionContainer->initAttributes($alexaRequest);
        $sessionContainer->removeAttribute('bar');

        $expected = [
            'foo' => 'bar',
        ];

        $this->assertEquals($expected, $sessionContainer->getAttributes());
    }

    /**
     * @return AlexaRequest
     */
    private function createAlexaRequest(): AlexaRequest
    {
        $application = new Application('applicationId');

        $user = new User('userId');

        $session = new Session(
            true,
            'sessionId',
            $application,
            [
                'foo' => 'bar',
                'bar' => [
                    'foobar' => 'barfoo',
                    'barfoo' => 'foobar',
                ],
            ],
            $user
        );

        $launchRequest = new LaunchRequestType(
            'requestId',
            '2017-01-27T20:29:59Z',
            'de-DE'
        );

        $context = new Context(
            new AudioPlayer('IDLE')
        );

        $rawRequestData = json_encode(['foo' => 'bar']);

        $alexaRequest = new AlexaRequest(
            'version',
            $launchRequest,
            $session,
            $context,
            $rawRequestData
        );

        return $alexaRequest;
    }
}
