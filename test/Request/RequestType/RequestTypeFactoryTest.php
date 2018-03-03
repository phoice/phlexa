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

namespace PhlexaTest\Request\RequestType;

use PHPUnit\Framework\TestCase;
use Phlexa\Request\AlexaRequest;
use Phlexa\Request\RequestType\AbstractAudioPlayerRequestType;
use Phlexa\Request\RequestType\AudioPlayerPlaybackFailedType;
use Phlexa\Request\RequestType\AudioPlayerPlaybackFinishedType;
use Phlexa\Request\RequestType\AudioPlayerPlaybackNearlyFinishedType;
use Phlexa\Request\RequestType\AudioPlayerPlaybackStartedType;
use Phlexa\Request\RequestType\AudioPlayerPlaybackStoppedType;
use Phlexa\Request\RequestType\IntentRequestType;
use Phlexa\Request\RequestType\LaunchRequestType;
use Phlexa\Request\RequestType\PlaybackControllerNextCommandIssuedType;
use Phlexa\Request\RequestType\PlaybackControllerPauseCommandIssuedType;
use Phlexa\Request\RequestType\PlaybackControllerPlayCommandIssuedType;
use Phlexa\Request\RequestType\PlaybackControllerPreviousCommandIssuedType;
use Phlexa\Request\RequestType\RequestTypeFactory;
use Phlexa\Request\RequestType\RequestTypeInterface;
use Phlexa\Request\RequestType\SessionEndedRequestType;
use Phlexa\Request\RequestType\SystemExceptionEncounteredType;

/**
 * Class RequestTypeFactoryTest
 *
 * @package PhlexaTest\Request\RequestType
 */
class RequestTypeFactoryTest extends TestCase
{
    /**
     *
     */
    public function testFactoryForIntentRequestTypeWithSlots()
    {
        $data = [
            'version' => '1.0',
            'session' => [
                'new'         => true,
                'sessionId'   => 'sessionId',
                'application' => [
                    'applicationId' => 'applicationId',
                ],
                'attributes'  => [
                    'foo' => 'bar',
                ],
                'user'        => [
                    'userId' => 'userId',
                ],
            ],
            'request' => [
                'type'      => 'IntentRequest',
                'requestId' => 'requestId',
                'timestamp' => '2017-01-27T20:29:59Z',
                'locale'    => 'de-DE',
                'intent'    => [
                    'name'  => 'name',
                    'slots' => [
                        'foo' => 'bar',
                    ],
                ],
            ],
            'context' => [
                'AudioPlayer' => [
                    'playerActivity' => 'IDLE',
                ]
            ],
        ];

        $alexaRequest = RequestTypeFactory::createFromData(json_encode($data));

        $this->assertEquals($data['version'], $alexaRequest->getVersion());

        $this->assertSessionData($alexaRequest, $data);

        $this->assertContextData($alexaRequest, $data);

        $this->assertRequestData(
            $alexaRequest->getRequest(),
            $data,
            IntentRequestType::class
        );
    }

    /**
     *
     */
    public function testFactoryForIntentRequestTypeWithoutSlots()
    {
        $data = [
            'version' => '1.0',
            'session' => [
                'new'         => true,
                'sessionId'   => 'sessionId',
                'application' => [
                    'applicationId' => 'applicationId',
                ],
                'attributes'  => [
                    'foo' => 'bar',
                ],
                'user'        => [
                    'userId' => 'userId',
                ],
            ],
            'request' => [
                'type'      => 'IntentRequest',
                'requestId' => 'requestId',
                'timestamp' => '2017-01-27T20:29:59Z',
                'locale'    => 'de-DE',
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

        $alexaRequest = RequestTypeFactory::createFromData(json_encode($data));

        $this->assertEquals($data['version'], $alexaRequest->getVersion());

        $this->assertSessionData($alexaRequest, $data);

        $this->assertContextData($alexaRequest, $data);

        $this->assertRequestData(
            $alexaRequest->getRequest(),
            $data,
            IntentRequestType::class
        );
    }

    /**
     *
     */
    public function testFactoryForIntentRequestTypeWithoutVersion()
    {
        $data = [
            'session' => [
                'new'         => true,
                'sessionId'   => 'sessionId',
                'application' => [
                    'applicationId' => 'applicationId',
                ],
                'attributes'  => [
                    'foo' => 'bar',
                ],
                'user'        => [
                    'userId' => 'userId',
                ],
            ],
            'request' => [
                'type'      => 'IntentRequest',
                'requestId' => 'requestId',
                'timestamp' => '2017-01-27T20:29:59Z',
                'locale'    => 'de-DE',
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

        $alexaRequest = RequestTypeFactory::createFromData(json_encode($data));

        $this->assertEquals('1.0', $alexaRequest->getVersion());

        $this->assertSessionData($alexaRequest, $data);

        $this->assertContextData($alexaRequest, $data);

        $this->assertRequestData(
            $alexaRequest->getRequest(),
            $data,
            IntentRequestType::class
        );
    }

    /**
     *
     */
    public function testFactoryForIntentRequestTypeWithFullContext()
    {
        $data = [
            'version' => '1.0',
            'session' => [
                'new'         => true,
                'sessionId'   => 'sessionId',
                'application' => [
                    'applicationId' => 'applicationId',
                ],
                'attributes'  => [
                    'foo' => 'bar',
                ],
                'user'        => [
                    'userId' => 'userId',
                ],
            ],
            'request' => [
                'type'      => 'IntentRequest',
                'requestId' => 'requestId',
                'timestamp' => '2017-01-27T20:29:59Z',
                'locale'    => 'de-DE',
                'intent'    => [
                    'name' => 'name',
                ],
            ],
            'context' => [
                'AudioPlayer' => [
                    'playerActivity'       => 'PLAYING',
                    'token'                => '123456',
                    'offsetInMilliseconds' => 1000,
                ],
                'Display'     => [
                    'token'           => '123456',
                    'templateVersion' => '1.0',
                    'markupVersion'   => '1.0',
                ],
                'System'      => [
                    'application' => [
                        'applicationId' => 'applicationId',
                    ],
                    'user'        => [
                        'userId'      => 'userId',
                        'accessToken' => 'accessToken',
                        'permissions' => [
                            'consentToken' => 'consentToken',
                        ],
                    ],
                    'device'      => [
                        'deviceId'            => 'deviceId',
                        'supportedInterfaces' => [
                            'AudioPlayer' => [],
                        ],
                    ],
                    'apiEndpoint' => 'https://api.amazonalexa.com',
                ],
            ],
        ];

        $alexaRequest = RequestTypeFactory::createFromData(json_encode($data));

        $this->assertEquals('1.0', $alexaRequest->getVersion());

        $this->assertSessionData($alexaRequest, $data);

        $this->assertContextData($alexaRequest, $data);

        $this->assertRequestData(
            $alexaRequest->getRequest(),
            $data,
            IntentRequestType::class
        );
    }

    /**
     *
     */
    public function testFactoryForIntentRequestTypeWithNoContext()
    {
        $data = [
            'version' => '1.0',
            'session' => [
                'new'         => true,
                'sessionId'   => 'sessionId',
                'application' => [
                    'applicationId' => 'applicationId',
                ],
                'attributes'  => [
                    'foo' => 'bar',
                ],
                'user'        => [
                    'userId' => 'userId',
                ],
            ],
            'request' => [
                'type'      => 'IntentRequest',
                'requestId' => 'requestId',
                'timestamp' => '2017-01-27T20:29:59Z',
                'locale'    => 'de-DE',
                'intent'    => [
                    'name' => 'name',
                ],
            ],
        ];

        $alexaRequest = RequestTypeFactory::createFromData(json_encode($data));

        $this->assertEquals('1.0', $alexaRequest->getVersion());

        $this->assertSessionData($alexaRequest, $data);

        $this->assertNull($alexaRequest->getContext());

        $this->assertRequestData(
            $alexaRequest->getRequest(),
            $data,
            IntentRequestType::class
        );
    }

    /**
     *
     */
    public function testFactoryForLaunchRequestType()
    {
        $data = [
            'version' => '1.0',
            'session' => [
                'new'         => true,
                'sessionId'   => 'sessionId',
                'application' => [
                    'applicationId' => 'applicationId',
                ],
                'user'        => [
                    'userId' => 'userId',
                ],
            ],
            'request' => [
                'type'      => 'LaunchRequest',
                'requestId' => 'requestId',
                'timestamp' => '2017-01-27T20:29:59Z',
                'locale'    => 'de-DE',
            ],
            'context' => [
                'AudioPlayer' => [
                    'playerActivity' => 'IDLE',
                ]
            ],
        ];

        $alexaRequest = RequestTypeFactory::createFromData(json_encode($data));

        $this->assertEquals($data['version'], $alexaRequest->getVersion());

        $this->assertSessionData($alexaRequest, $data);

        $this->assertContextData($alexaRequest, $data);

        $this->assertRequestData(
            $alexaRequest->getRequest(),
            $data,
            LaunchRequestType::class
        );
    }

    /**
     *
     */
    public function testFactoryForSessionEndedRequestTypeWithError()
    {
        $data = [
            'version' => '1.0',
            'session' => [
                'new'         => true,
                'sessionId'   => 'sessionId',
                'application' => [
                    'applicationId' => 'applicationId',
                ],
                'attributes'  => [
                    'foo' => 'bar',
                ],
                'user'        => [
                    'userId' => 'userId',
                ],
            ],
            'request' => [
                'type'      => 'SessionEndedRequest',
                'requestId' => 'requestId',
                'timestamp' => '2017-01-27T20:29:59Z',
                'locale'    => 'de-DE',
                'reason'    => 'reason',
                'error'     => [
                    'type'    => 'type',
                    'message' => 'message',
                ],
            ],
            'context' => [
                'AudioPlayer' => [
                    'playerActivity' => 'IDLE',
                ]
            ],
        ];

        $alexaRequest = RequestTypeFactory::createFromData(json_encode($data));

        $this->assertEquals($data['version'], $alexaRequest->getVersion());

        $this->assertSessionData($alexaRequest, $data);

        $this->assertContextData($alexaRequest, $data);

        $this->assertRequestData(
            $alexaRequest->getRequest(),
            $data,
            SessionEndedRequestType::class
        );
    }

    /**
     *
     */
    public function testFactoryForSessionEndedRequestTypeWithoutError()
    {
        $data = [
            'version' => '1.0',
            'session' => [
                'new'         => true,
                'sessionId'   => 'sessionId',
                'application' => [
                    'applicationId' => 'applicationId',
                ],
                'attributes'  => [
                    'foo' => 'bar',
                ],
                'user'        => [
                    'userId' => 'userId',
                ],
            ],
            'request' => [
                'type'      => 'SessionEndedRequest',
                'requestId' => 'requestId',
                'timestamp' => '2017-01-27T20:29:59Z',
                'locale'    => 'de-DE',
                'reason'    => 'reason',
            ],
            'context' => [
                'AudioPlayer' => [
                    'playerActivity' => 'IDLE',
                ]
            ],
        ];

        $alexaRequest = RequestTypeFactory::createFromData(json_encode($data));

        $this->assertEquals($data['version'], $alexaRequest->getVersion());

        $this->assertSessionData($alexaRequest, $data);

        $this->assertContextData($alexaRequest, $data);

        $this->assertRequestData(
            $alexaRequest->getRequest(),
            $data,
            SessionEndedRequestType::class
        );
    }

    /**
     *
     */
    public function testFactoryForAudioPlayerPlaybackStartedRequestType()
    {
        $data = [
            'version' => '1.0',
            'session' => [
                'new'         => true,
                'sessionId'   => 'sessionId',
                'application' => [
                    'applicationId' => 'applicationId',
                ],
                'attributes'  => [
                    'foo' => 'bar',
                ],
                'user'        => [
                    'userId' => 'userId',
                ],
            ],
            'request' => [
                'type'                 => 'AudioPlayer.PlaybackStarted',
                'requestId'            => 'requestId',
                'timestamp'            => '2017-01-27T20:29:59Z',
                'locale'               => 'de-DE',
                'token'                => '123456',
                'offsetInMilliseconds' => 1000,
            ],
            'context' => [
                'AudioPlayer' => [
                    'playerActivity' => 'IDLE',
                ]
            ],
        ];

        $alexaRequest = RequestTypeFactory::createFromData(json_encode($data));

        $this->assertEquals($data['version'], $alexaRequest->getVersion());

        $this->assertSessionData($alexaRequest, $data);

        $this->assertContextData($alexaRequest, $data);

        $this->assertRequestData(
            $alexaRequest->getRequest(),
            $data,
            AudioPlayerPlaybackStartedType::class
        );
    }

    /**
     *
     */
    public function testFactoryForAudioPlayerPlaybackStoppedRequestType()
    {
        $data = [
            'version' => '1.0',
            'session' => [
                'new'         => true,
                'sessionId'   => 'sessionId',
                'application' => [
                    'applicationId' => 'applicationId',
                ],
                'attributes'  => [
                    'foo' => 'bar',
                ],
                'user'        => [
                    'userId' => 'userId',
                ],
            ],
            'request' => [
                'type'                 => 'AudioPlayer.PlaybackStopped',
                'requestId'            => 'requestId',
                'timestamp'            => '2017-01-27T20:29:59Z',
                'locale'               => 'de-DE',
                'token'                => '123456',
                'offsetInMilliseconds' => 1000,
            ],
            'context' => [
                'AudioPlayer' => [
                    'playerActivity' => 'IDLE',
                ]
            ],
        ];

        $alexaRequest = RequestTypeFactory::createFromData(json_encode($data));

        $this->assertEquals($data['version'], $alexaRequest->getVersion());

        $this->assertSessionData($alexaRequest, $data);

        $this->assertContextData($alexaRequest, $data);

        $this->assertRequestData(
            $alexaRequest->getRequest(),
            $data,
            AudioPlayerPlaybackStoppedType::class
        );
    }

    /**
     *
     */
    public function testFactoryForAudioPlayerPlaybackFinishedRequestType()
    {
        $data = [
            'version' => '1.0',
            'session' => [
                'new'         => true,
                'sessionId'   => 'sessionId',
                'application' => [
                    'applicationId' => 'applicationId',
                ],
                'attributes'  => [
                    'foo' => 'bar',
                ],
                'user'        => [
                    'userId' => 'userId',
                ],
            ],
            'request' => [
                'type'                 => 'AudioPlayer.PlaybackFinished',
                'requestId'            => 'requestId',
                'timestamp'            => '2017-01-27T20:29:59Z',
                'locale'               => 'de-DE',
                'token'                => '123456',
                'offsetInMilliseconds' => 1000,
            ],
            'context' => [
                'AudioPlayer' => [
                    'playerActivity' => 'IDLE',
                ]
            ],
        ];

        $alexaRequest = RequestTypeFactory::createFromData(json_encode($data));

        $this->assertEquals($data['version'], $alexaRequest->getVersion());

        $this->assertSessionData($alexaRequest, $data);

        $this->assertContextData($alexaRequest, $data);

        $this->assertRequestData(
            $alexaRequest->getRequest(),
            $data,
            AudioPlayerPlaybackFinishedType::class
        );
    }

    /**
     *
     */
    public function testFactoryForAudioPlayerPlaybackNearlyFinishedRequestType()
    {
        $data = [
            'version' => '1.0',
            'session' => [
                'new'         => true,
                'sessionId'   => 'sessionId',
                'application' => [
                    'applicationId' => 'applicationId',
                ],
                'attributes'  => [
                    'foo' => 'bar',
                ],
                'user'        => [
                    'userId' => 'userId',
                ],
            ],
            'request' => [
                'type'                 => 'AudioPlayer.PlaybackNearlyFinished',
                'requestId'            => 'requestId',
                'timestamp'            => '2017-01-27T20:29:59Z',
                'locale'               => 'de-DE',
                'token'                => '123456',
                'offsetInMilliseconds' => 1000,
            ],
            'context' => [
                'AudioPlayer' => [
                    'playerActivity' => 'IDLE',
                ]
            ],
        ];

        $alexaRequest = RequestTypeFactory::createFromData(json_encode($data));

        $this->assertEquals($data['version'], $alexaRequest->getVersion());

        $this->assertSessionData($alexaRequest, $data);

        $this->assertContextData($alexaRequest, $data);

        $this->assertRequestData(
            $alexaRequest->getRequest(),
            $data,
            AudioPlayerPlaybackNearlyFinishedType::class
        );
    }

    /**
     *
     */
    public function testFactoryForAudioPlayerPlaybackFailedRequestType()
    {
        $data = [
            'version' => '1.0',
            'session' => [
                'new'         => true,
                'sessionId'   => 'sessionId',
                'application' => [
                    'applicationId' => 'applicationId',
                ],
                'attributes'  => [
                    'foo' => 'bar',
                ],
                'user'        => [
                    'userId' => 'userId',
                ],
            ],
            'request' => [
                'type'                 => 'AudioPlayer.PlaybackFailed',
                'requestId'            => 'requestId',
                'timestamp'            => '2017-01-27T20:29:59Z',
                'locale'               => 'de-DE',
                'token'                => '123456',
                'error'                => [
                    'type'    => 'type',
                    'message' => 'message',
                ],
                'currentPlaybackState' => [
                    'token'                => 'token',
                    'offsetInMilliseconds' => 1000,
                    'playerActivity'       => 'PLAYING',
                ],
            ],
            'context' => [
                'AudioPlayer' => [
                    'playerActivity' => 'IDLE',
                ]
            ],
        ];

        $alexaRequest = RequestTypeFactory::createFromData(json_encode($data));

        $this->assertEquals($data['version'], $alexaRequest->getVersion());

        $this->assertSessionData($alexaRequest, $data);

        $this->assertContextData($alexaRequest, $data);

        $this->assertRequestData(
            $alexaRequest->getRequest(),
            $data,
            AudioPlayerPlaybackFailedType::class
        );
    }

    /**
     *
     */
    public function testFactoryForAudioPlayerPlaybackFailedRequestTypeWithOutError()
    {
        $data = [
            'version' => '1.0',
            'session' => [
                'new'         => true,
                'sessionId'   => 'sessionId',
                'application' => [
                    'applicationId' => 'applicationId',
                ],
                'attributes'  => [
                    'foo' => 'bar',
                ],
                'user'        => [
                    'userId' => 'userId',
                ],
            ],
            'request' => [
                'type'      => 'AudioPlayer.PlaybackFailed',
                'requestId' => 'requestId',
                'timestamp' => '2017-01-27T20:29:59Z',
                'locale'    => 'de-DE',
                'token'     => '123456',
            ],
            'context' => [
                'AudioPlayer' => [
                    'playerActivity' => 'IDLE',
                ]
            ],
        ];

        $alexaRequest = RequestTypeFactory::createFromData(json_encode($data));

        $this->assertEquals($data['version'], $alexaRequest->getVersion());

        $this->assertSessionData($alexaRequest, $data);

        $this->assertContextData($alexaRequest, $data);

        $this->assertRequestData(
            $alexaRequest->getRequest(),
            $data,
            AudioPlayerPlaybackFailedType::class
        );
    }

    /**
     *
     */
    public function testFactoryForPlaybackControllerNextCommandIssuedRequestType()
    {
        $data = [
            'version' => '1.0',
            'session' => [
                'new'         => true,
                'sessionId'   => 'sessionId',
                'application' => [
                    'applicationId' => 'applicationId',
                ],
                'attributes'  => [
                    'foo' => 'bar',
                ],
                'user'        => [
                    'userId' => 'userId',
                ],
            ],
            'request' => [
                'type'      => 'PlaybackController.NextCommandIssued',
                'requestId' => 'requestId',
                'timestamp' => '2017-01-27T20:29:59Z',
                'locale'    => 'de-DE',
            ],
            'context' => [
                'AudioPlayer' => [
                    'playerActivity' => 'IDLE',
                ]
            ],
        ];

        $alexaRequest = RequestTypeFactory::createFromData(json_encode($data));

        $this->assertEquals($data['version'], $alexaRequest->getVersion());

        $this->assertSessionData($alexaRequest, $data);

        $this->assertContextData($alexaRequest, $data);

        $this->assertRequestData(
            $alexaRequest->getRequest(),
            $data,
            PlaybackControllerNextCommandIssuedType::class
        );
    }

    /**
     *
     */
    public function testFactoryForPlaybackControllerPauseCommandIssuedRequestType()
    {
        $data = [
            'version' => '1.0',
            'session' => [
                'new'         => true,
                'sessionId'   => 'sessionId',
                'application' => [
                    'applicationId' => 'applicationId',
                ],
                'attributes'  => [
                    'foo' => 'bar',
                ],
                'user'        => [
                    'userId' => 'userId',
                ],
            ],
            'request' => [
                'type'      => 'PlaybackController.PauseCommandIssued',
                'requestId' => 'requestId',
                'timestamp' => '2017-01-27T20:29:59Z',
                'locale'    => 'de-DE',
            ],
            'context' => [
                'AudioPlayer' => [
                    'playerActivity' => 'IDLE',
                ]
            ],
        ];

        $alexaRequest = RequestTypeFactory::createFromData(json_encode($data));

        $this->assertEquals($data['version'], $alexaRequest->getVersion());

        $this->assertSessionData($alexaRequest, $data);

        $this->assertContextData($alexaRequest, $data);

        $this->assertRequestData(
            $alexaRequest->getRequest(),
            $data,
            PlaybackControllerPauseCommandIssuedType::class
        );
    }

    /**
     *
     */
    public function testFactoryForPlaybackControllerPlayCommandIssuedRequestType()
    {
        $data = [
            'version' => '1.0',
            'session' => [
                'new'         => true,
                'sessionId'   => 'sessionId',
                'application' => [
                    'applicationId' => 'applicationId',
                ],
                'attributes'  => [
                    'foo' => 'bar',
                ],
                'user'        => [
                    'userId' => 'userId',
                ],
            ],
            'request' => [
                'type'      => 'PlaybackController.PlayCommandIssued',
                'requestId' => 'requestId',
                'timestamp' => '2017-01-27T20:29:59Z',
                'locale'    => 'de-DE',
            ],
            'context' => [
                'AudioPlayer' => [
                    'playerActivity' => 'IDLE',
                ]
            ],
        ];

        $alexaRequest = RequestTypeFactory::createFromData(json_encode($data));

        $this->assertEquals($data['version'], $alexaRequest->getVersion());

        $this->assertSessionData($alexaRequest, $data);

        $this->assertContextData($alexaRequest, $data);

        $this->assertRequestData(
            $alexaRequest->getRequest(),
            $data,
            PlaybackControllerPlayCommandIssuedType::class
        );
    }

    /**
     *
     */
    public function testFactoryForPlaybackControllerPreviousCommandIssuedRequestType()
    {
        $data = [
            'version' => '1.0',
            'session' => [
                'new'         => true,
                'sessionId'   => 'sessionId',
                'application' => [
                    'applicationId' => 'applicationId',
                ],
                'attributes'  => [
                    'foo' => 'bar',
                ],
                'user'        => [
                    'userId' => 'userId',
                ],
            ],
            'request' => [
                'type'      => 'PlaybackController.PreviousCommandIssued',
                'requestId' => 'requestId',
                'timestamp' => '2017-01-27T20:29:59Z',
                'locale'    => 'de-DE',
            ],
            'context' => [
                'AudioPlayer' => [
                    'playerActivity' => 'IDLE',
                ]
            ],
        ];

        $alexaRequest = RequestTypeFactory::createFromData(json_encode($data));

        $this->assertEquals($data['version'], $alexaRequest->getVersion());

        $this->assertSessionData($alexaRequest, $data);

        $this->assertContextData($alexaRequest, $data);

        $this->assertRequestData(
            $alexaRequest->getRequest(),
            $data,
            PlaybackControllerPreviousCommandIssuedType::class
        );
    }

    /**
     *
     */
    public function testFactoryForSystemExceptionEncounteredRequestType()
    {
        $data = [
            'version' => '1.0',
            'request' => [
                'type'      => 'System.ExceptionEncountered',
                'requestId' => 'requestId',
                'timestamp' => '2017-01-27T20:29:59Z',
                'locale'    => 'de-DE',
                'error'     => [
                    'type'    => 'type',
                    'message' => 'message',
                ],
                'cause'     => [
                    'requestId' => 'requestId',
                ],
            ],
            'context' => [
                'AudioPlayer' => [
                    'playerActivity' => 'IDLE',
                ]
            ],
        ];

        $alexaRequest = RequestTypeFactory::createFromData(json_encode($data));

        $this->assertEquals($data['version'], $alexaRequest->getVersion());

        $this->assertContextData($alexaRequest, $data);

        $this->assertRequestData(
            $alexaRequest->getRequest(),
            $data,
            SystemExceptionEncounteredType::class
        );
    }

    /**
     *
     */
    public function testFactoryForSystemExceptionEncounteredRequestTypeWithOutErrorAndCause()
    {
        $data = [
            'version' => '1.0',
            'request' => [
                'type'      => 'System.ExceptionEncountered',
                'requestId' => 'requestId',
                'timestamp' => '2017-01-27T20:29:59Z',
                'locale'    => 'de-DE',
            ],
            'context' => [
                'AudioPlayer' => [
                    'playerActivity' => 'IDLE',
                ]
            ],
        ];

        $alexaRequest = RequestTypeFactory::createFromData(json_encode($data));

        $this->assertEquals($data['version'], $alexaRequest->getVersion());

        $this->assertContextData($alexaRequest, $data);

        $this->assertRequestData(
            $alexaRequest->getRequest(),
            $data,
            SystemExceptionEncounteredType::class
        );
    }

    /**
     * @param AlexaRequest $alexaRequest
     * @param array        $data
     */
    private function assertSessionData(AlexaRequest $alexaRequest, array $data)
    {
        $session = $alexaRequest->getSession();

        $this->assertEquals(
            $data['session']['new'],
            $session->isNew()
        );

        $this->assertEquals(
            $data['session']['sessionId'],
            $session->getSessionId()
        );

        $this->assertEquals(
            $data['session']['application']['applicationId'],
            $session->getApplication()->getApplicationId()
        );

        $this->assertEquals(
            $data['session']['attributes'] ?? [],
            $session->getAttributes()
        );

        $this->assertEquals(
            $data['session']['user']['userId'],
            $session->getUser()->getUserId()
        );
    }

    /**
     * @param AlexaRequest $alexaRequest
     * @param array        $data
     */
    private function assertContextData(AlexaRequest $alexaRequest, array $data)
    {
        $context = $alexaRequest->getContext();

        $this->assertEquals(
            $data['context']['AudioPlayer']['playerActivity'],
            $context->getAudioPlayer()->getPlayerActivity()
        );

        if (isset($data['context']['AudioPlayer']['token'])) {
            $this->assertEquals(
                $data['context']['AudioPlayer']['token'],
                $context->getAudioPlayer()->getToken()
            );
        }

        if (isset($data['context']['AudioPlayer']['offsetInMilliseconds'])) {
            $this->assertEquals(
                $data['context']['AudioPlayer']['offsetInMilliseconds'],
                $context->getAudioPlayer()->getOffsetInMilliseconds()
            );
        }

        if (isset($data['context']['Display'])) {
            if (isset($data['context']['Display']['token'])) {
                $this->assertEquals(
                    $data['context']['Display']['token'],
                    $context->getDisplay()->getToken()
                );
            }

            if (isset($data['context']['Display']['templateVersion'])) {
                $this->assertEquals(
                    $data['context']['Display']['templateVersion'],
                    $context->getDisplay()->getTemplateVersion()
                );
            }

            if (isset($data['context']['Display']['markupVersion'])) {
                $this->assertEquals(
                    $data['context']['Display']['markupVersion'],
                    $context->getDisplay()->getMarkupVersion()
                );
            }
        }

        if (isset($data['context']['System'])) {
            $this->assertEquals(
                $data['context']['System']['application']['applicationId'],
                $context->getSystem()->getApplication()->getApplicationId()
            );

            $this->assertEquals(
                $data['context']['System']['user']['userId'],
                $context->getSystem()->getUser()->getUserId()
            );

            $this->assertEquals(
                $data['context']['System']['user']['accessToken'],
                $context->getSystem()->getUser()->getAccessToken()
            );

            $this->assertEquals(
                $data['context']['System']['user']['permissions']['consentToken'],
                $context->getSystem()->getUser()->getConsentToken()
            );

            $this->assertEquals(
                $data['context']['System']['device']['deviceId'],
                $context->getSystem()->getDevice()->getDeviceId()
            );

            $this->assertEquals(
                $data['context']['System']['device']['supportedInterfaces'],
                $context->getSystem()->getDevice()->getSupportedInterfaces()
            );

            $this->assertEquals(
                $data['context']['System']['apiEndpoint'],
                $context->getSystem()->getApiEndpoint()
            );
        }
    }

    /**
     * @param RequestTypeInterface $requestType
     * @param array                $data
     * @param string               $requestTypeClass
     */
    private function assertRequestData(
        RequestTypeInterface $requestType,
        array $data,
        string $requestTypeClass
    ) {
        $this->assertEquals(
            $requestTypeClass,
            get_class($requestType)
        );

        $this->assertEquals(
            $data['request']['type'],
            $requestType->getType()
        );

        $this->assertEquals(
            $data['request']['requestId'],
            $requestType->getRequestId()
        );

        $this->assertEquals(
            $data['request']['timestamp'],
            $requestType->getTimestamp()
        );

        $this->assertEquals(
            $data['request']['locale'],
            $requestType->getLocale()
        );

        switch ($requestTypeClass) {
            case SessionEndedRequestType::class:
                /** @var SessionEndedRequestType $requestType */
                $this->assertEquals(
                    $data['request']['reason'],
                    $requestType->getReason()
                );

                if (isset($data['request']['error'])) {
                    $this->assertEquals(
                        $data['request']['error']['type'],
                        $requestType->getError()->getType()
                    );

                    $this->assertEquals(
                        $data['request']['error']['message'],
                        $requestType->getError()->getMessage()
                    );
                } else {
                    $this->assertNull(
                        $requestType->getError()
                    );
                }
                break;

            case IntentRequestType::class:
                /** @var IntentRequestType $requestType */
                $this->assertEquals(
                    $data['request']['intent']['name'],
                    $requestType->getIntent()->getName()
                );

                if (isset($data['request']['intent']['slots'])) {
                    $this->assertEquals(
                        $data['request']['intent']['slots'],
                        $requestType->getIntent()->getSlots()
                    );
                }

                break;

            case AudioPlayerPlaybackStartedType::class:
            case AudioPlayerPlaybackStoppedType::class:
            case AudioPlayerPlaybackFinishedType::class:
            case AudioPlayerPlaybackNearlyFinishedType::class:
                /** @var AbstractAudioPlayerRequestType $requestType */
                $this->assertEquals(
                    $data['request']['token'],
                    $requestType->getToken()
                );

                $this->assertEquals(
                    $data['request']['offsetInMilliseconds'],
                    $requestType->getOffsetInMilliseconds()
                );

                break;

            case AudioPlayerPlaybackFailedType::class:
                /** @var AudioPlayerPlaybackFailedType $requestType */
                $this->assertEquals(
                    $data['request']['token'],
                    $requestType->getToken()
                );

                if (isset($data['request']['error'])) {
                    $this->assertEquals(
                        $data['request']['error']['type'],
                        $requestType->getError()->getType()
                    );

                    $this->assertEquals(
                        $data['request']['error']['message'],
                        $requestType->getError()->getMessage()
                    );
                } else {
                    $this->assertNull(
                        $requestType->getError()
                    );
                }

                if (isset($data['request']['currentPlaybackState'])) {
                    $this->assertEquals(
                        $data['request']['currentPlaybackState']['token'],
                        $requestType->getCurrentPlaybackState()->getToken()
                    );

                    $this->assertEquals(
                        $data['request']['currentPlaybackState']['offsetInMilliseconds'],
                        $requestType->getCurrentPlaybackState()->getOffsetInMilliseconds()
                    );

                    $this->assertEquals(
                        $data['request']['currentPlaybackState']['playerActivity'],
                        $requestType->getCurrentPlaybackState()->getPlayerActivity()
                    );
                } else {
                    $this->assertNull(
                        $requestType->getCurrentPlaybackState()
                    );
                }

                break;

            case SystemExceptionEncounteredType::class:
                /** @var SystemExceptionEncounteredType $requestType */
                if (isset($data['request']['error'])) {
                    $this->assertEquals(
                        $data['request']['error']['type'],
                        $requestType->getError()->getType()
                    );

                    $this->assertEquals(
                        $data['request']['error']['message'],
                        $requestType->getError()->getMessage()
                    );
                } else {
                    $this->assertNull(
                        $requestType->getError()
                    );
                }

                if (isset($data['request']['cause'])) {
                    $this->assertEquals(
                        $data['request']['cause']['requestId'],
                        $requestType->getCause()->getRequestId()
                    );
                } else {
                    $this->assertNull(
                        $requestType->getCause()
                    );
                }

                break;
        }
    }
}
