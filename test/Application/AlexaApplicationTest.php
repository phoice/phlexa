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

namespace PhlexaTest\Application;

use Phlexa\Application\AlexaApplication;
use Phlexa\Configuration\SkillConfigurationInterface;
use Phlexa\Intent\CancelIntent;
use Phlexa\Intent\HelpIntent;
use Phlexa\Intent\LaunchIntent;
use Phlexa\Intent\StopIntent;
use Phlexa\Request\RequestType\LaunchRequestType;
use Phlexa\Request\RequestType\RequestTypeFactory;
use Phlexa\Request\RequestType\SessionEndedRequestType;
use Phlexa\Response\AlexaResponse;
use Phlexa\Session\SessionContainer;
use Phlexa\TextHelper\TextHelper;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\MethodProphecy;
use Prophecy\Prophecy\ObjectProphecy;
use Psr\Container\ContainerInterface;

/**
 * Class AlexaApplicationTest
 *
 * @package PhlexaTest\Application
 */
class AlexaApplicationTest extends TestCase
{
    /**
     *
     */
    public function testHelpRequest()
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
                'type'      => 'IntentRequest',
                'requestId' => 'requestId',
                'timestamp' => '2017-01-27T20:29:59Z',
                'locale'    => 'en-US',
                'intent'    => [
                    'name'  => 'AMAZON.HelpIntent',
                    'slots' => [],
                ],
            ],
            'context' => [
                'AudioPlayer' => [
                    'playerActivity' => 'IDLE',
                ]
            ],
        ];

        $sessionContainer = new SessionContainer(['foo' => 'bar']);

        $alexaRequest  = RequestTypeFactory::createFromData(json_encode($data));
        $textHelper    = new TextHelper();
        $alexaResponse = new AlexaResponse();
        $alexaResponse->setSessionContainer($sessionContainer);

        /** @var SkillConfigurationInterface|MockObject $skillConfiguration */
        $skillConfiguration = $this->createMock(SkillConfigurationInterface::class);

        /** @var MethodProphecy $getAplDocumentsMethod */
        $skillConfiguration->expects($this->once())
            ->method('getAplDocuments')
            ->willReturn(['normal-body' => '{"type": "APL"}']);

        $skillConfiguration->expects($this->once())
            ->method('getSmallIconImage')
            ->willReturn('https://image.server/icon.png');

        $skillConfiguration->expects($this->once())
            ->method('getSmallFrontImage')
            ->willReturn('https://image.server/small.png');

        $skillConfiguration->expects($this->once())
            ->method('getLargeFrontImage')
            ->willReturn('https://image.server/large.png');

        $skillConfiguration->expects($this->once())
            ->method('getRoundBackgroundImage')
            ->willReturn('https://image.server/round-background.png');

        $skillConfiguration->expects($this->once())
            ->method('getSmallBackgroundImage')
            ->willReturn('https://image.server/small-background.png');

        $skillConfiguration->expects($this->once())
            ->method('getMediumBackgroundImage')
            ->willReturn('https://image.server/medium-background.png');

        $skillConfiguration->expects($this->once())
            ->method('getLargeBackgroundImage')
            ->willReturn('https://image.server/large-background.png');

        $skillConfiguration->expects($this->once())
            ->method('getExtraLargeBackgroundImage')
            ->willReturn('https://image.server/extra-large-background.png');

        /** @var ContainerInterface|MockObject $intentManager */
        $intentManager = $this->createMock(ContainerInterface::class);

        $intentManager->expects($this->once())->method('has')->willReturn(true);

        $intentManager->expects($this->once())->method('get')->with(HelpIntent::NAME)->willReturn(
            new HelpIntent($alexaRequest, $alexaResponse, $textHelper, $skillConfiguration)
        );

        $application = new AlexaApplication(
            $alexaRequest,
            $alexaResponse,
            $intentManager
        );

        $result = $application->execute();

        $expected = [
            'version'           => '1.0',
            'sessionAttributes' => [
                'foo' => 'bar',
            ],
            'response'          => [
                'outputSpeech'     => [
                    'type' => 'SSML',
                    'ssml' => '<speak>helpMessage</speak>',
                ],
                'card'             => [
                    'type'  => 'Standard',
                    'title' => 'helpTitle',
                    'text'  => 'helpMessage',
                    'image' => [
                        'smallImageUrl' => 'https://image.server/small.png',
                        'largeImageUrl' => 'https://image.server/large.png',
                    ],
                ],
                'reprompt'         => [
                    'outputSpeech' => [
                        'type' => 'SSML',
                        'ssml' => '<speak>repromptMessage</speak>',
                    ],
                ],
                'shouldEndSession' => false,
            ],
            'userAgent'         => 'phlexa-3.0 framework'
        ];

        $this->assertEquals($expected, $result);
    }

    /**
     *
     */
    public function testIntentRequest()
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
                'type'      => 'IntentRequest',
                'requestId' => 'requestId',
                'timestamp' => '2017-01-27T20:29:59Z',
                'locale'    => 'en-US',
                'intent'    => [
                    'name' => 'name',
                ],
            ],
            'context' => [
                'AudioPlayer' => [
                    'playerActivity' => 'IDLE',
                ]
            ],
        ];

        $sessionContainer = new SessionContainer(['foo' => 'bar']);

        $alexaRequest  = RequestTypeFactory::createFromData(json_encode($data));
        $textHelper    = new TextHelper();
        $alexaResponse = new AlexaResponse();
        $alexaResponse->setSessionContainer($sessionContainer);

        /** @var SkillConfigurationInterface|MockObject $skillConfiguration */
        $skillConfiguration = $this->createMock(SkillConfigurationInterface::class);

        /** @var MethodProphecy $getAplDocumentsMethod */
        $skillConfiguration->expects($this->once())
            ->method('getAplDocuments')
            ->willReturn(['normal-body' => '{"type": "APL"}']);

        $skillConfiguration->expects($this->once())
            ->method('getSmallIconImage')
            ->willReturn('https://image.server/icon.png');

        $skillConfiguration->expects($this->once())
            ->method('getSmallFrontImage')
            ->willReturn('https://image.server/small.png');

        $skillConfiguration->expects($this->once())
            ->method('getLargeFrontImage')
            ->willReturn('https://image.server/large.png');

        $skillConfiguration->expects($this->once())
            ->method('getRoundBackgroundImage')
            ->willReturn('https://image.server/round-background.png');

        $skillConfiguration->expects($this->once())
            ->method('getSmallBackgroundImage')
            ->willReturn('https://image.server/small-background.png');

        $skillConfiguration->expects($this->once())
            ->method('getMediumBackgroundImage')
            ->willReturn('https://image.server/medium-background.png');

        $skillConfiguration->expects($this->once())
            ->method('getLargeBackgroundImage')
            ->willReturn('https://image.server/large-background.png');

        $skillConfiguration->expects($this->once())
            ->method('getExtraLargeBackgroundImage')
            ->willReturn('https://image.server/extra-large-background.png');

        $intentManager = $this->createMock(ContainerInterface::class);

        $intentManager->expects($this->once())->method('has')->with('name')->willReturn(false);

        $intentManager->expects($this->once())->method('get')->with(HelpIntent::NAME)->willReturn(
            new HelpIntent($alexaRequest, $alexaResponse, $textHelper, $skillConfiguration)
        );

        /** @var ContainerInterface|ObjectProphecy $intentManager */
//        $intentManager = $this->prophesize(ContainerInterface::class);

        /** @var MethodProphecy $hasMethod */
//        $hasMethod = $intentManager->has('name');
//        $hasMethod->shouldBeCalled()->willReturn(false);
//
//        /** @var MethodProphecy $getMethod */
//        $getMethod = $intentManager->get(HelpIntent::NAME);
//        $getMethod->shouldBeCalled()->willReturn(
//            new HelpIntent($alexaRequest, $alexaResponse, $textHelper, $skillConfiguration->reveal())
//        );

        $application = new AlexaApplication(
            $alexaRequest,
            $alexaResponse,
            $intentManager
        );

        $result = $application->execute();

        $expected = [
            'version'           => '1.0',
            'sessionAttributes' => [
                'foo' => 'bar',
            ],
            'response'          => [
                'outputSpeech'     => [
                    'type' => 'SSML',
                    'ssml' => '<speak>helpMessage</speak>',
                ],
                'card'             => [
                    'type'  => 'Standard',
                    'title' => 'helpTitle',
                    'text'  => 'helpMessage',
                    'image' => [
                        'smallImageUrl' => 'https://image.server/small.png',
                        'largeImageUrl' => 'https://image.server/large.png',
                    ],
                ],
                'reprompt'         => [
                    'outputSpeech' => [
                        'type' => 'SSML',
                        'ssml' => '<speak>repromptMessage</speak>',
                    ],
                ],
                'shouldEndSession' => false,
            ],
            'userAgent'         => 'phlexa-3.0 framework'
        ];

        $this->assertEquals($expected, $result);
    }

    /**
     *
     */
    public function testLaunchRequest()
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
                'type'      => 'LaunchRequest',
                'requestId' => 'requestId',
                'timestamp' => '2017-01-27T20:29:59Z',
                'locale'    => 'en-US',
            ],
            'context' => [
                'AudioPlayer' => [
                    'playerActivity' => 'IDLE',
                ]
            ],
        ];

        $sessionContainer = new SessionContainer(['foo' => 'bar']);

        $alexaRequest  = RequestTypeFactory::createFromData(json_encode($data));
        $textHelper    = new TextHelper();
        $alexaResponse = new AlexaResponse();
        $alexaResponse->setSessionContainer($sessionContainer);

        /** @var SkillConfigurationInterface|MockObject $skillConfiguration */
        $skillConfiguration = $this->createMock(SkillConfigurationInterface::class);

        /** @var MethodProphecy $getAplDocumentsMethod */
        $skillConfiguration->expects($this->once())
            ->method('getAplDocuments')
            ->willReturn(['normal-body' => '{"type": "APL"}']);

        $skillConfiguration->expects($this->once())
            ->method('getSmallIconImage')
            ->willReturn('https://image.server/icon.png');

        $skillConfiguration->expects($this->once())
            ->method('getSmallFrontImage')
            ->willReturn('https://image.server/small.png');

        $skillConfiguration->expects($this->once())
            ->method('getLargeFrontImage')
            ->willReturn('https://image.server/large.png');

        $skillConfiguration->expects($this->once())
            ->method('getRoundBackgroundImage')
            ->willReturn('https://image.server/round-background.png');

        $skillConfiguration->expects($this->once())
            ->method('getSmallBackgroundImage')
            ->willReturn('https://image.server/small-background.png');

        $skillConfiguration->expects($this->once())
            ->method('getMediumBackgroundImage')
            ->willReturn('https://image.server/medium-background.png');

        $skillConfiguration->expects($this->once())
            ->method('getLargeBackgroundImage')
            ->willReturn('https://image.server/large-background.png');

        $skillConfiguration->expects($this->once())
            ->method('getExtraLargeBackgroundImage')
            ->willReturn('https://image.server/extra-large-background.png');

        $intentManager = $this->createMock(ContainerInterface::class);

        $intentManager->expects($this->once())
            ->method('has')
            ->with(LaunchRequestType::NAME)
            ->willReturn(true);

        $intentManager->method('get')
            ->with(LaunchRequestType::NAME)
            ->willReturn(
                new LaunchIntent($alexaRequest, $alexaResponse, $textHelper, $skillConfiguration)
            );

        $application = new AlexaApplication(
            $alexaRequest,
            $alexaResponse,
            $intentManager
        );

        $result = $application->execute();

        $expected = [
            'version'           => '1.0',
            'sessionAttributes' => [
                'foo' => 'bar',
            ],
            'response'          => [
                'outputSpeech'     => [
                    'type' => 'SSML',
                    'ssml' => '<speak>launchMessage</speak>',
                ],
                'card'             => [
                    'type'  => 'Standard',
                    'title' => 'launchTitle',
                    'text'  => 'launchMessage',
                    'image' => [
                        'smallImageUrl' => 'https://image.server/small.png',
                        'largeImageUrl' => 'https://image.server/large.png',
                    ],
                ],
                'reprompt'         => [
                    'outputSpeech' => [
                        'type' => 'SSML',
                        'ssml' => '<speak>repromptMessage</speak>',
                    ],
                ],
                'shouldEndSession' => false,
            ],
            'userAgent'         => 'phlexa-3.0 framework'
        ];

        $this->assertEquals($expected, $result);
    }

    /**
     *
     */
    public function testSessionEndedRequest()
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
                'type'      => 'SessionEndedRequest',
                'requestId' => 'requestId',
                'timestamp' => '2017-01-27T20:29:59Z',
                'locale'    => 'en-US',
                'reason'    => 'reason',
            ],
            'context' => [
                'AudioPlayer' => [
                    'playerActivity' => 'IDLE',
                ]
            ],
        ];

        $sessionContainer = new SessionContainer(['foo' => 'bar']);

        $alexaRequest  = RequestTypeFactory::createFromData(json_encode($data));
        $textHelper    = new TextHelper();
        $alexaResponse = new AlexaResponse();
        $alexaResponse->setSessionContainer($sessionContainer);

        /** @var SkillConfigurationInterface|MockObject $skillConfiguration */
        $skillConfiguration = $this->createMock(SkillConfigurationInterface::class);

        /** @var MethodProphecy $getAplDocumentsMethod */
        $skillConfiguration->expects($this->once())
            ->method('getAplDocuments')
            ->willReturn(['normal-body' => '{"type": "APL"}']);

        $skillConfiguration->expects($this->once())
            ->method('getSmallIconImage')
            ->willReturn('https://image.server/icon.png');

        $skillConfiguration->expects($this->once())
            ->method('getSmallFrontImage')
            ->willReturn('https://image.server/small.png');

        $skillConfiguration->expects($this->once())
            ->method('getLargeFrontImage')
            ->willReturn('https://image.server/large.png');

        $skillConfiguration->expects($this->once())
            ->method('getRoundBackgroundImage')
            ->willReturn('https://image.server/round-background.png');

        $skillConfiguration->expects($this->once())
            ->method('getSmallBackgroundImage')
            ->willReturn('https://image.server/small-background.png');

        $skillConfiguration->expects($this->once())
            ->method('getMediumBackgroundImage')
            ->willReturn('https://image.server/medium-background.png');

        $skillConfiguration->expects($this->once())
            ->method('getLargeBackgroundImage')
            ->willReturn('https://image.server/large-background.png');

        $skillConfiguration->expects($this->once())
            ->method('getExtraLargeBackgroundImage')
            ->willReturn('https://image.server/extra-large-background.png');

        $intentManager = $this->createMock(ContainerInterface::class);

        $intentManager->expects($this->once())
            ->method('has')
            ->with(SessionEndedRequestType::NAME)
            ->willReturn(true);

        $intentManager->expects($this->once())
            ->method('get')
            ->with(SessionEndedRequestType::NAME)
            ->willReturn(
                new StopIntent($alexaRequest, $alexaResponse, $textHelper, $skillConfiguration)
            );

        $application = new AlexaApplication(
            $alexaRequest,
            $alexaResponse,
            $intentManager
        );

        $result = $application->execute();

        $expected = [
            'version'           => '1.0',
            'sessionAttributes' => [],
            'response'          => [
                'outputSpeech'     => [
                    'type' => 'SSML',
                    'ssml' => '<speak>stopMessage</speak>',
                ],
                'card'             => [
                    'type'  => 'Standard',
                    'title' => 'stopTitle',
                    'text'  => 'stopMessage',
                    'image' => [
                        'smallImageUrl' => 'https://image.server/small.png',
                        'largeImageUrl' => 'https://image.server/large.png',
                    ],
                ],
                'shouldEndSession' => true,
            ],
            'userAgent'         => 'phlexa-3.0 framework'
        ];

        $this->assertEquals($expected, $result);
    }

    /**
     *
     */
    public function testStopRequest()
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
                'type'      => 'IntentRequest',
                'requestId' => 'requestId',
                'timestamp' => '2017-01-27T20:29:59Z',
                'locale'    => 'en-US',
                'intent'    => [
                    'name'  => 'AMAZON.StopIntent',
                    'slots' => [],
                ],
            ],
            'context' => [
                'AudioPlayer' => [
                    'playerActivity' => 'IDLE',
                ]
            ],
        ];

        $sessionContainer = new SessionContainer(['foo' => 'bar']);

        $alexaRequest  = RequestTypeFactory::createFromData(json_encode($data));
        $textHelper    = new TextHelper();
        $alexaResponse = new AlexaResponse();
        $alexaResponse->setSessionContainer($sessionContainer);

        /** @var SkillConfigurationInterface|MockObject $skillConfiguration */
        $skillConfiguration = $this->createMock(SkillConfigurationInterface::class);

        /** @var MethodProphecy $getAplDocumentsMethod */
        $skillConfiguration->expects($this->once())
            ->method('getAplDocuments')
            ->willReturn(['normal-body' => '{"type": "APL"}']);

        $skillConfiguration->expects($this->once())
            ->method('getSmallIconImage')
            ->willReturn('https://image.server/icon.png');

        $skillConfiguration->expects($this->once())
            ->method('getSmallFrontImage')
            ->willReturn('https://image.server/small.png');

        $skillConfiguration->expects($this->once())
            ->method('getLargeFrontImage')
            ->willReturn('https://image.server/large.png');

        $skillConfiguration->expects($this->once())
            ->method('getRoundBackgroundImage')
            ->willReturn('https://image.server/round-background.png');

        $skillConfiguration->expects($this->once())
            ->method('getSmallBackgroundImage')
            ->willReturn('https://image.server/small-background.png');

        $skillConfiguration->expects($this->once())
            ->method('getMediumBackgroundImage')
            ->willReturn('https://image.server/medium-background.png');

        $skillConfiguration->expects($this->once())
            ->method('getLargeBackgroundImage')
            ->willReturn('https://image.server/large-background.png');

        $skillConfiguration->expects($this->once())
            ->method('getExtraLargeBackgroundImage')
            ->willReturn('https://image.server/extra-large-background.png');

        $intentManager = $this->createMock(ContainerInterface::class);

        $intentManager->expects($this->once())
            ->method('has')
            ->with(StopIntent::NAME)
            ->willReturn(true);

        $intentManager->expects($this->once())
            ->method('get')
            ->with(StopIntent::NAME)
            ->willReturn(
                new StopIntent($alexaRequest, $alexaResponse, $textHelper, $skillConfiguration)
            );

        $application = new AlexaApplication(
            $alexaRequest,
            $alexaResponse,
            $intentManager
        );

        $result = $application->execute();

        $expected = [
            'version'           => '1.0',
            'sessionAttributes' => [],
            'response'          => [
                'outputSpeech'     => [
                    'type' => 'SSML',
                    'ssml' => '<speak>stopMessage</speak>',
                ],
                'card'             => [
                    'type'  => 'Standard',
                    'title' => 'stopTitle',
                    'text'  => 'stopMessage',
                    'image' => [
                        'smallImageUrl' => 'https://image.server/small.png',
                        'largeImageUrl' => 'https://image.server/large.png',
                    ],
                ],
                'shouldEndSession' => true,
            ],
            'userAgent'         => 'phlexa-3.0 framework'
        ];

        $this->assertEquals($expected, $result);
    }

    /**
     *
     */
    public function testCancelRequest()
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
                'type'      => 'IntentRequest',
                'requestId' => 'requestId',
                'timestamp' => '2017-01-27T20:29:59Z',
                'locale'    => 'en-US',
                'intent'    => [
                    'name'  => 'AMAZON.CancelIntent',
                    'slots' => [],
                ],
            ],
            'context' => [
                'AudioPlayer' => [
                    'playerActivity' => 'IDLE',
                ]
            ],
        ];

        $sessionContainer = new SessionContainer(['foo' => 'bar']);

        $alexaRequest  = RequestTypeFactory::createFromData(json_encode($data));
        $textHelper    = new TextHelper();
        $alexaResponse = new AlexaResponse();
        $alexaResponse->setSessionContainer($sessionContainer);

        /** @var SkillConfigurationInterface|MockObject $skillConfiguration */
        $skillConfiguration = $this->createMock(SkillConfigurationInterface::class);

        /** @var MethodProphecy $getAplDocumentsMethod */
        $skillConfiguration->expects($this->once())
            ->method('getAplDocuments')
            ->willReturn(['normal-body' => '{"type": "APL"}']);

        $skillConfiguration->expects($this->once())
            ->method('getSmallIconImage')
            ->willReturn('https://image.server/icon.png');

        $skillConfiguration->expects($this->once())
            ->method('getSmallFrontImage')
            ->willReturn('https://image.server/small.png');

        $skillConfiguration->expects($this->once())
            ->method('getLargeFrontImage')
            ->willReturn('https://image.server/large.png');

        $skillConfiguration->expects($this->once())
            ->method('getRoundBackgroundImage')
            ->willReturn('https://image.server/round-background.png');

        $skillConfiguration->expects($this->once())
            ->method('getSmallBackgroundImage')
            ->willReturn('https://image.server/small-background.png');

        $skillConfiguration->expects($this->once())
            ->method('getMediumBackgroundImage')
            ->willReturn('https://image.server/medium-background.png');

        $skillConfiguration->expects($this->once())
            ->method('getLargeBackgroundImage')
            ->willReturn('https://image.server/large-background.png');

        $skillConfiguration->expects($this->once())
            ->method('getExtraLargeBackgroundImage')
            ->willReturn('https://image.server/extra-large-background.png');

        $intentManager = $this->createMock(ContainerInterface::class);

        $intentManager->expects($this->once())
            ->method('has')
            ->with(CancelIntent::NAME)
            ->willReturn(true);

        $intentManager->expects($this->once())
            ->method('get')
            ->with(CancelIntent::NAME)
            ->willReturn(
                new CancelIntent($alexaRequest, $alexaResponse, $textHelper, $skillConfiguration)
            );

        $application = new AlexaApplication(
            $alexaRequest,
            $alexaResponse,
            $intentManager
        );

        $result = $application->execute();

        $expected = [
            'version'           => '1.0',
            'sessionAttributes' => [],
            'response'          => [
                'outputSpeech'     => [
                    'type' => 'SSML',
                    'ssml' => '<speak>cancelMessage</speak>',
                ],
                'card'             => [
                    'type'  => 'Standard',
                    'title' => 'cancelTitle',
                    'text'  => 'cancelMessage',
                    'image' => [
                        'smallImageUrl' => 'https://image.server/small.png',
                        'largeImageUrl' => 'https://image.server/large.png',
                    ],
                ],
                'shouldEndSession' => true,
            ],
            'userAgent'         => 'phlexa-3.0 framework'
        ];

        $this->assertEquals($expected, $result);
    }
}
