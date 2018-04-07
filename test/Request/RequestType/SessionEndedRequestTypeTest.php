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

namespace PhlexaTest\Request\RequestType;

use PHPUnit\Framework\TestCase;
use Phlexa\Request\RequestType\Error\Error;
use Phlexa\Request\RequestType\SessionEndedRequestType;

/**
 * Class SessionEndedRequestTypeTest
 *
 * @package PhlexaTest\Request\RequestType
 */
class SessionEndedRequestTypeTest extends TestCase
{
    /**
     *
     */
    public function testInstantiation()
    {
        $requestId = 'requestId';
        $timestamp = '2017-01-27T20:29:59Z';
        $locale    = 'de-DE';
        $reason    = 'reason';
        $error     = new Error('type', 'message');

        $sessionEndedRequest = new SessionEndedRequestType(
            $requestId,
            $timestamp,
            $locale,
            $reason,
            $error
        );

        $this->assertEquals(
            'SessionEndedRequest',
            $sessionEndedRequest->getType()
        );
        $this->assertEquals($requestId, $sessionEndedRequest->getRequestId());
        $this->assertEquals($timestamp, $sessionEndedRequest->getTimestamp());
        $this->assertEquals($locale, $sessionEndedRequest->getLocale());
        $this->assertEquals($reason, $sessionEndedRequest->getReason());
        $this->assertEquals($error, $sessionEndedRequest->getError());
    }
}
