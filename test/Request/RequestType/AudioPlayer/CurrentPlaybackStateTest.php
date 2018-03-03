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

namespace PhlexaTest\Request\RequestType\AudioPlayer;

use PHPUnit\Framework\TestCase;
use Phlexa\Request\RequestType\AudioPlayer\CurrentPlaybackState;

/**
 * Class CurrentPlaybackStateTest
 *
 * @package PhlexaTest\Request\RequestType\AudioPlayer
 */
class CurrentPlaybackStateTest extends TestCase
{
    /**
     *
     */
    public function testInstantiation()
    {
        $currentPlaybackState = new CurrentPlaybackState('PLAYING', 1000, '123456');

        $this->assertEquals('PLAYING', $currentPlaybackState->getPlayerActivity());
        $this->assertEquals(1000, $currentPlaybackState->getOffsetInMilliseconds());
        $this->assertEquals('123456', $currentPlaybackState->getToken());
    }
}
