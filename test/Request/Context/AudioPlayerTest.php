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

namespace PhlexaTest\Request\Context;

use Phlexa\Request\Context\AudioPlayer;
use PHPUnit\Framework\TestCase;

/**
 * Class AudioPlayerTest
 *
 * @package PhlexaTest\Request\Context
 */
class AudioPlayerTest extends TestCase
{
    /**
     *
     */
    public function testInstantiation()
    {
        $audioPlayer = new AudioPlayer('IDLE');

        $expected = 'IDLE';

        $this->assertEquals($expected, $audioPlayer->getPlayerActivity());
    }

    /**
     *
     */
    public function testToken()
    {
        $audioPlayer = new AudioPlayer('IDLE');
        $audioPlayer->setToken('123456');

        $expected = '123456';

        $this->assertEquals($expected, $audioPlayer->getToken());
    }

    /**
     *
     */
    public function testOffsetInMilliseconds()
    {
        $audioPlayer = new AudioPlayer('IDLE');
        $audioPlayer->setOffsetInMilliseconds(1000);

        $expected = 1000;

        $this->assertEquals($expected, $audioPlayer->getOffsetInMilliseconds());
    }
}
