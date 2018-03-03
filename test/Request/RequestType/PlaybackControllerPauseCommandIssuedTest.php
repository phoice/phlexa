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

namespace PhlexaTest\Request\RequestType;

use PHPUnit\Framework\TestCase;
use Phlexa\Request\RequestType\PlaybackControllerPauseCommandIssuedType;

/**
 * Class PlaybackControllerPauseCommandIssuedTest
 *
 * @package PhlexaTest\Request\RequestType
 */
class PlaybackControllerPauseCommandIssuedTest extends TestCase
{
    /**
     *
     */
    public function testInstantiation()
    {
        $requestId = 'requestId';
        $timestamp = '2017-01-27T20:29:59Z';
        $locale    = 'de-DE';

        $launchRequest = new PlaybackControllerPauseCommandIssuedType(
            $requestId,
            $timestamp,
            $locale
        );

        $this->assertEquals('PlaybackController.PauseCommandIssued', $launchRequest->getType());
        $this->assertEquals($requestId, $launchRequest->getRequestId());
        $this->assertEquals($timestamp, $launchRequest->getTimestamp());
        $this->assertEquals($locale, $launchRequest->getLocale());
    }
}
