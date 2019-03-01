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

use Phlexa\Request\RequestType\AudioPlayer\CurrentPlaybackState;
use Phlexa\Request\RequestType\AudioPlayerPlaybackFailedType;
use Phlexa\Request\RequestType\Error\Error;
use PHPUnit\Framework\TestCase;

/**
 * Class AudioPlayerPlaybackFailedTypeTest
 *
 * @package PhlexaTest\Request\RequestType
 */
class AudioPlayerPlaybackFailedTypeTest extends TestCase
{
    /**
     *
     */
    public function testInstantiation()
    {
        $requestId            = 'requestId';
        $timestamp            = '2017-01-27T20:29:59Z';
        $locale               = 'de-DE';
        $token                = '123456';
        $error                = new Error('type', 'message');
        $currentPlaybackState = new CurrentPlaybackState('PLAYING', 1000, '1234567');

        $launchRequest = new AudioPlayerPlaybackFailedType(
            $requestId,
            $timestamp,
            $locale,
            $token,
            $error,
            $currentPlaybackState
        );

        $this->assertEquals('AudioPlayer.PlaybackFailed', $launchRequest->getType());
        $this->assertEquals($requestId, $launchRequest->getRequestId());
        $this->assertEquals($timestamp, $launchRequest->getTimestamp());
        $this->assertEquals($locale, $launchRequest->getLocale());
        $this->assertEquals($token, $launchRequest->getToken());
        $this->assertEquals($error, $launchRequest->getError());
        $this->assertEquals($currentPlaybackState, $launchRequest->getCurrentPlaybackState());
    }
}
