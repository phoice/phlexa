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

namespace PhlexaTest\Response;

use PHPUnit\Framework\TestCase;
use Phlexa\Response\AlexaResponse;
use Phlexa\Response\Card\Simple;
use Phlexa\Response\Card\Standard;
use Phlexa\Response\Directives\AudioPlayer\Play;
use Phlexa\Response\OutputSpeech\PlainText;
use Phlexa\Response\OutputSpeech\SSML;
use Phlexa\Session\SessionContainer;

/**
 * Class AlexaResponseTest
 *
 * @package PhlexaTest\Response
 */
class AlexaResponseTest extends TestCase
{
    /**
     *
     */
    public function testInstantiationWithAddingSessionContainer()
    {
        $sessionContainer = new SessionContainer(['foo' => 'bar']);

        $alexaResponse = new AlexaResponse();
        $alexaResponse->setSessionContainer($sessionContainer);

        $expected = [
            'version'           => '1.0',
            'sessionAttributes' => [
                'foo' => 'bar',
            ],
            'response'          => [
                'shouldEndSession' => false,
            ],
        ];

        $this->assertEquals($expected, $alexaResponse->toArray());
        $this->assertEquals($sessionContainer, $alexaResponse->getSessionContainer());
    }

    /**
     *
     */
    public function testInstantiationWithAll()
    {
        $plainText        = new PlainText('text');
        $simple           = new Simple('title', 'content');
        $reprompt         = new PlainText('text');
        $sessionContainer = new SessionContainer(['foo' => 'bar']);

        $alexaResponse = new AlexaResponse();
        $alexaResponse->setOutputSpeech($plainText);
        $alexaResponse->setCard($simple);
        $alexaResponse->setReprompt($reprompt);
        $alexaResponse->setSessionContainer($sessionContainer);
        $alexaResponse->endSession();

        $expected = [
            'version'           => '1.0',
            'sessionAttributes' => [
                'foo' => 'bar',
            ],
            'response'          => [
                'outputSpeech'     => [
                    'type' => 'PlainText',
                    'text' => 'text',
                ],
                'card'             => [
                    'type'    => 'Simple',
                    'title'   => 'title',
                    'content' => 'content',
                ],
                'reprompt'         => [
                    'outputSpeech' => [
                        'type' => 'PlainText',
                        'text' => 'text',
                    ],
                ],
                'shouldEndSession' => true,
            ],
        ];

        $this->assertEquals($expected, $alexaResponse->toArray());
    }

    /**
     *
     */
    public function testIsEmptyWithAll()
    {
        $plainText        = new PlainText('text');
        $simple           = new Simple('title', 'content');
        $reprompt         = new PlainText('text');
        $sessionContainer = new SessionContainer(['foo' => 'bar']);

        $alexaResponse = new AlexaResponse();
        $alexaResponse->setOutputSpeech($plainText);
        $alexaResponse->setCard($simple);
        $alexaResponse->setReprompt($reprompt);
        $alexaResponse->setSessionContainer($sessionContainer);
        $alexaResponse->endSession();
        $alexaResponse->setIsEmpty(true);

        $expected = [];

        $this->assertEquals($expected, $alexaResponse->toArray());
    }

    /**
     *
     */
    public function testInstantiationWithSSMLAndStandardCard()
    {
        $ssml             = new SSML('ssml');
        $standard         = new Standard(
            'title', 'text', 'https://image.server/small.png', 'https://image.server/large.png'
        );
        $reprompt         = new SSML('ssml');
        $sessionContainer = new SessionContainer(['foo' => 'bar']);

        $alexaResponse = new AlexaResponse();
        $alexaResponse->setOutputSpeech($ssml);
        $alexaResponse->setCard($standard);
        $alexaResponse->setReprompt($reprompt);
        $alexaResponse->endSession();
        $alexaResponse->setSessionContainer($sessionContainer);

        $expected = [
            'version'           => '1.0',
            'sessionAttributes' => [
                'foo' => 'bar',
            ],
            'response'          => [
                'outputSpeech'     => [
                    'type' => 'SSML',
                    'ssml' => '<speak>ssml</speak>',
                ],
                'card'             => [
                    'type'  => 'Standard',
                    'title' => 'title',
                    'text'  => 'text',
                    'image' => [
                        'smallImageUrl' => 'https://image.server/small.png',
                        'largeImageUrl' => 'https://image.server/large.png',
                    ],
                ],
                'reprompt'         => [
                    'outputSpeech' => [
                        'type' => 'SSML',
                        'ssml' => '<speak>ssml</speak>',
                    ],
                ],
                'shouldEndSession' => true,
            ],
        ];

        $this->assertEquals($expected, $alexaResponse->toArray());
    }

    /**
     *
     */
    public function testInstantiationWithCard()
    {
        $simple = new Simple('title', 'content');

        $alexaResponse = new AlexaResponse();
        $alexaResponse->setCard($simple);

        $expected = [
            'version'           => '1.0',
            'sessionAttributes' => [],
            'response'          => [
                'card'             => [
                    'type'    => 'Simple',
                    'title'   => 'title',
                    'content' => 'content',
                ],
                'shouldEndSession' => false,
            ],
        ];

        $this->assertEquals($expected, $alexaResponse->toArray());
    }

    /**
     *
     */
    public function testInstantiationWithEndSession()
    {
        $alexaResponse = new AlexaResponse();
        $alexaResponse->endSession();

        $expected = [
            'version'           => '1.0',
            'sessionAttributes' => [],
            'response'          => [
                'shouldEndSession' => true,
            ],
        ];

        $this->assertEquals($expected, $alexaResponse->toArray());
    }

    /**
     *
     */
    public function testInstantiationWithNoValues()
    {
        $alexaResponse = new AlexaResponse();

        $expected = [
            'version'           => '1.0',
            'sessionAttributes' => [],
            'response'          => [
                'shouldEndSession' => false,
            ],
        ];

        $this->assertEquals($expected, $alexaResponse->toArray());
    }

    /**
     *
     */
    public function testInstantiationWithOutputSpeech()
    {
        $plainText = new PlainText('text');

        $alexaResponse = new AlexaResponse();
        $alexaResponse->setOutputSpeech($plainText);

        $expected = [
            'version'           => '1.0',
            'sessionAttributes' => [],
            'response'          => [
                'outputSpeech'     => [
                    'type' => 'PlainText',
                    'text' => 'text',
                ],
                'shouldEndSession' => false,
            ],
        ];

        $this->assertEquals($expected, $alexaResponse->toArray());
    }

    /**
     *
     */
    public function testInstantiationWithReprompt()
    {
        $reprompt = new PlainText('text');

        $alexaResponse = new AlexaResponse();
        $alexaResponse->setReprompt($reprompt);

        $expected = [
            'version'           => '1.0',
            'sessionAttributes' => [],
            'response'          => [
                'reprompt'         => [
                    'outputSpeech' => [
                        'type' => 'PlainText',
                        'text' => 'text',
                    ],
                ],
                'shouldEndSession' => false,
            ],
        ];

        $this->assertEquals($expected, $alexaResponse->toArray());
    }

    /**
     *
     */
    public function testInstantiationWithOneDirective()
    {
        $directive = new Play(
            'REPLACE_ALL', 'https:/www.test.de/music.mp3', '12345678', '98765432', 1000
        );

        $alexaResponse = new AlexaResponse();
        $alexaResponse->addDirective($directive);

        $expected = [
            'version'           => '1.0',
            'sessionAttributes' => [],
            'response'          => [
                'shouldEndSession' => false,
                'directives' => [
                    [
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
                    ]
                ],
            ],
        ];

        $this->assertEquals($expected, $alexaResponse->toArray());
    }

    /**
     *
     */
    public function testInstantiationWithOverwritingDirective()
    {
        $directive1 = new Play(
            'REPLACE_ALL', 'https:/www.test.de/music.mp3', '12345678', '98765432', 1000
        );
        $directive2 = new Play(
            'REPLACE_ENQUEUED', 'https:/www.test.de/music2.mp3', 'ABCDEFGH', 'HGFEDCBA', 0
        );

        $alexaResponse = new AlexaResponse();
        $alexaResponse->addDirective($directive1);
        $alexaResponse->addDirective($directive2);

        $expected = [
            'version'           => '1.0',
            'sessionAttributes' => [],
            'response'          => [
                'shouldEndSession' => false,
                'directives' => [
                    [
                        'type'         => 'AudioPlayer.Play',
                        'playBehavior' => 'REPLACE_ENQUEUED',
                        'audioItem'    => [
                            'stream' => [
                                'url'                   => 'https:/www.test.de/music2.mp3',
                                'token'                 => 'ABCDEFGH',
                                'expectedPreviousToken' => 'HGFEDCBA',
                                'offsetInMilliseconds'  => 0,
                            ],
                        ],
                    ]
                ],
            ],
        ];

        $this->assertEquals($expected, $alexaResponse->toArray());
    }

}
