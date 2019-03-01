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

use Phlexa\Request\RequestType\Cause\Cause;
use Phlexa\Request\RequestType\Error\Error;
use Phlexa\Request\RequestType\SystemExceptionEncounteredType;
use PHPUnit\Framework\TestCase;

/**
 * Class SystemExceptionEncounteredTypeTest
 *
 * @package PhlexaTest\Request\RequestType
 */
class SystemExceptionEncounteredTypeTest extends TestCase
{
    /**
     *
     */
    public function testInstantiation()
    {
        $requestId = 'requestId';
        $timestamp = '2017-01-27T20:29:59Z';
        $locale    = 'de-DE';
        $error     = new Error('type', 'message');
        $cause     = new Cause('requestId');

        $launchRequest = new SystemExceptionEncounteredType(
            $requestId,
            $timestamp,
            $locale,
            $error,
            $cause
        );

        $this->assertEquals('System.ExceptionEncountered', $launchRequest->getType());
        $this->assertEquals($requestId, $launchRequest->getRequestId());
        $this->assertEquals($timestamp, $launchRequest->getTimestamp());
        $this->assertEquals($locale, $launchRequest->getLocale());
        $this->assertEquals($error, $launchRequest->getError());
        $this->assertEquals($cause, $launchRequest->getCause());
    }
}
