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

namespace PhlexaTest\Intent\AudioPlayer;

use Phlexa\Configuration\SkillConfiguration;
use Phlexa\Intent\AbstractIntent;
use Phlexa\Intent\AudioPlayer\PlaybackFinishedIntent;
use Phlexa\Intent\IntentInterface;
use Phlexa\Request\RequestType\RequestTypeFactory;
use Phlexa\Response\AlexaResponse;
use Phlexa\TextHelper\TextHelper;
use PHPUnit\Framework\TestCase;

/**
 * Class PlaybackFinishedIntentTest
 *
 * @package PhlexaTest\Intent\AudioPlayer
 */
class PlaybackFinishedIntentTest extends TestCase
{
    /**
     * Test the instantiation of the class
     */
    public function testInstantiation(): void
    {
        $data = [
            'version' => '1.0',
            'session' => [
                'new'         => true,
                'sessionId'   => 'sessionId',
                'application' => [
                    'applicationId' => 'amzn1.ask.skill.applicationId',
                ],
                'user'        => [
                    'userId' => 'userId',
                ],
            ],
            'request' => [
                'type'                 => 'AudioPlayer.PlaybackFinished',
                'requestId'            => 'requestId',
                'timestamp'            => '2017-01-27T20:29:59Z',
                'locale'               => 'en-US',
                'token'                => '12345',
                'offsetInMilliseconds' => 1000,
            ],
            'context' => [
                'AudioPlayer' => [
                    'playerActivity' => 'IDLE',
                ]
            ],
        ];

        $alexaRequest       = RequestTypeFactory::createFromData(json_encode($data));
        $alexaResponse      = new AlexaResponse();
        $textHelper         = new TextHelper();
        $skillConfiguration = new SkillConfiguration();

        $intent = new PlaybackFinishedIntent($alexaRequest, $alexaResponse, $textHelper, $skillConfiguration);

        $this->assertInstanceOf(AbstractIntent::class, $intent);
        $this->assertInstanceOf(IntentInterface::class, $intent);
    }

    /**
     * Test the handling of the intent
     */
    public function testHandle(): void
    {
        $data = [
            'version' => '1.0',
            'session' => [
                'new'         => true,
                'sessionId'   => 'sessionId',
                'application' => [
                    'applicationId' => 'amzn1.ask.skill.applicationId',
                ],
                'user'        => [
                    'userId' => 'userId',
                ],
            ],
            'request' => [
                'type'                 => 'AudioPlayer.PlaybackFinished',
                'requestId'            => 'requestId',
                'timestamp'            => '2017-01-27T20:29:59Z',
                'locale'               => 'en-US',
                'token'                => '12345',
                'offsetInMilliseconds' => 1000,
            ],
            'context' => [
                'AudioPlayer' => [
                    'playerActivity' => 'IDLE',
                ]
            ],
        ];

        $alexaRequest       = RequestTypeFactory::createFromData(json_encode($data));
        $textHelper         = new TextHelper();
        $alexaResponse      = new AlexaResponse();
        $skillConfiguration = new SkillConfiguration();

        $intent = new PlaybackFinishedIntent($alexaRequest, $alexaResponse, $textHelper, $skillConfiguration);
        $intent->handle();

        $expected = [
            'version'           => '1.0',
            'sessionAttributes' => [],
            'response'          => [
                'shouldEndSession' => true,
            ],
            'userAgent'         => 'phlexa-2.0 framework'
        ];

        $this->assertEquals($expected, $alexaResponse->toArray());
    }
}
