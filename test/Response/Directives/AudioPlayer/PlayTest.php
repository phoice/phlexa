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

use Phlexa\Response\Directives\AudioPlayer\Play;
use Phlexa\Response\Directives\Display\Image;
use PHPUnit\Framework\TestCase;

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
        $art = new Image('art image description');
        $art->setUrlSmall('https://image.server/art.png');

        $backgroundImage = new Image('background image description');
        $backgroundImage->setUrlSmall('https://image.server/medium-background.png');

        $directive = new Play(
            'REPLACE_ALL', 'https:/www.test.de/music.mp3', '12345678'
        );
        $directive->setMetaData('title', 'subtitle', $art, $backgroundImage);

        $expected = [
            'type'         => 'AudioPlayer.Play',
            'playBehavior' => 'REPLACE_ALL',
            'audioItem'    => [
                'stream'   => [
                    'url'                   => 'https:/www.test.de/music.mp3',
                    'token'                 => '12345678',
                    'expectedPreviousToken' => null,
                    'offsetInMilliseconds'  => 0,
                ],
                'metadata' => [
                    'title'           => 'title',
                    'subtitle'        => 'subtitle',
                    'art'             => [
                        'contentDescription' => 'art image description',
                        'sources'            => [
                            [
                                'url'  => 'https://image.server/art.png',
                                'type' => 'SMALL',
                            ],
                        ],
                    ],
                    'backgroundImage' => [
                        'contentDescription' => 'background image description',
                        'sources'            => [
                            [
                                'url'  => 'https://image.server/medium-background.png',
                                'type' => 'SMALL',
                            ],
                        ],
                    ],
                ],
            ],
        ];

        $this->assertEquals($expected, $directive->toArray());
        $this->assertEquals('AudioPlayer.Play', $directive->getType());
    }

    /**
     *
     */
    public function testInstantiationPlayBehaviourWithMetaData()
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
