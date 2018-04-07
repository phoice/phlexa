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

namespace PhlexaTest\Response\Directives\AudioPlayer;

use PHPUnit\Framework\TestCase;
use Phlexa\Response\Directives\AudioPlayer\Play;

/**
 * Class PlayTest
 *
 * @package PhlexaTest\Response\Directives\AudioPlayer;
 */
class PlayTest extends TestCase
{
    /**
     *
     */
    public function testInstantiationPlayBehaviourReplaceAll()
    {
        $directive = new Play(
            'REPLACE_ALL', 'https:/www.test.de/music.mp3', '12345678', '98765432', 1000
        );

        $expected = [
            'type'         => 'AudioPlayer.Play',
            'playBehavior' => 'REPLACE_ALL',
            'audioItem'    => [
                'stream' => [
                    'url'                   => 'https:/www.test.de/music.mp3',
                    'token'                 => '12345678',
                    'expectedPreviousToken' => '98765432',
                    'offsetInMilliseconds'  => 1000,
                ],
            ],
        ];

        $this->assertEquals($expected, $directive->toArray());
        $this->assertEquals('AudioPlayer.Play', $directive->getType());
    }

    /**
     *
     */
    public function testInstantiationPlayBehaviourEnqueue()
    {
        $directive = new Play(
            'ENQUEUE', 'https:/www.test.de/music.mp3', '12345678', '98765432', 1000
        );

        $expected = [
            'type'         => 'AudioPlayer.Play',
            'playBehavior' => 'ENQUEUE',
            'audioItem'    => [
                'stream' => [
                    'url'                   => 'https:/www.test.de/music.mp3',
                    'token'                 => '12345678',
                    'expectedPreviousToken' => '98765432',
                    'offsetInMilliseconds'  => 1000,
                ],
            ],
        ];

        $this->assertEquals($expected, $directive->toArray());
        $this->assertEquals('AudioPlayer.Play', $directive->getType());
    }

    /**
     *
     */
    public function testInstantiationPlayBehaviourReplaceEnqueued()
    {
        $directive = new Play(
            'REPLACE_ENQUEUED', 'https:/www.test.de/music.mp3', '12345678', '98765432', 1000
        );

        $expected = [
            'type'         => 'AudioPlayer.Play',
            'playBehavior' => 'REPLACE_ENQUEUED',
            'audioItem'    => [
                'stream' => [
                    'url'                   => 'https:/www.test.de/music.mp3',
                    'token'                 => '12345678',
                    'expectedPreviousToken' => '98765432',
                    'offsetInMilliseconds'  => 1000,
                ],
            ],
        ];

        $this->assertEquals($expected, $directive->toArray());
        $this->assertEquals('AudioPlayer.Play', $directive->getType());
    }

    /**
     *
     */
    public function testInstantiationPlayBehaviourUnknown()
    {
        $directive = new Play(
            'UNKNOWN', 'https:/www.test.de/music.mp3', '12345678', '98765432', 1000
        );

        $expected = [
            'type'         => 'AudioPlayer.Play',
            'playBehavior' => 'REPLACE_ALL',
            'audioItem'    => [
                'stream' => [
                    'url'                   => 'https:/www.test.de/music.mp3',
                    'token'                 => '12345678',
                    'expectedPreviousToken' => '98765432',
                    'offsetInMilliseconds'  => 1000,
                ],
            ],
        ];

        $this->assertEquals($expected, $directive->toArray());
        $this->assertEquals('AudioPlayer.Play', $directive->getType());
    }

    /**
     *
     */
    public function testInstantiationPlayBehaviourWithoutOptionalParams()
    {
        $directive = new Play(
            'REPLACE_ALL', 'https:/www.test.de/music.mp3', '12345678'
        );

        $expected = [
            'type'         => 'AudioPlayer.Play',
            'playBehavior' => 'REPLACE_ALL',
            'audioItem'    => [
                'stream' => [
                    'url'                   => 'https:/www.test.de/music.mp3',
                    'token'                 => '12345678',
                    'expectedPreviousToken' => null,
                    'offsetInMilliseconds'  => 0,
                ],
            ],
        ];

        $this->assertEquals($expected, $directive->toArray());
        $this->assertEquals('AudioPlayer.Play', $directive->getType());
    }

}
