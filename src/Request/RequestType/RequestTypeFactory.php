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

namespace Phlexa\Request\RequestType;

use Phlexa\Request\AlexaRequest;
use Phlexa\Request\Context\AudioPlayer;
use Phlexa\Request\Context\Context;
use Phlexa\Request\Context\Display;
use Phlexa\Request\Context\System;
use Phlexa\Request\Context\System\Application as ContextApplication;
use Phlexa\Request\Context\System\Device;
use Phlexa\Request\Context\System\Person as ContextPerson;
use Phlexa\Request\Context\System\User as ContextUser;
use Phlexa\Request\Context\Viewport;
use Phlexa\Request\Context\Viewport\Experiences as ViewportExperiences;
use Phlexa\Request\Context\Viewport\Video as ViewportVideo;
use Phlexa\Request\RequestType\AudioPlayer\CurrentPlaybackState;
use Phlexa\Request\RequestType\Cause\Cause;
use Phlexa\Request\RequestType\Error\Error;
use Phlexa\Request\RequestType\Intent\Intent;
use Phlexa\Request\RequestType\UserEvent\UserEvent;
use Phlexa\Request\Session\Application as SessionApplication;
use Phlexa\Request\Session\Session;
use Phlexa\Request\Session\User as SessionUser;

/**
 * Class RequestTypeFactory
 *
 * @package Phlexa\Request\RequestType
 */
class RequestTypeFactory
{
    /**
     * @param string $data
     *
     * @return AlexaRequest
     */
    public static function createFromData(string $data): AlexaRequest
    {
        $rawRequestData = $data;

        $data = json_decode($data, true);

        $version = $data['version'] ?? AlexaRequest::DEFAULT_VERSION;

        if (isset($data['session'])) {
            $session = new Session(
                $data['session']['new'],
                $data['session']['sessionId'],
                new SessionApplication($data['session']['application']['applicationId']),
                $data['session']['attributes'] ?? [],
                new SessionUser($data['session']['user']['userId'], $data['session']['user']['accessToken'] ?? null)
            );
        } else {
            $session = null;
        }

        if (isset($data['context'])) {
            $context = new Context();

            if (isset($data['context']['AudioPlayer'])) {
                $audioPlayer = new AudioPlayer(
                    $data['context']['AudioPlayer']['playerActivity']
                );

                if (isset($data['context']['AudioPlayer']['token'])) {
                    $audioPlayer->setToken($data['context']['AudioPlayer']['token']);
                }

                if (isset($data['context']['AudioPlayer']['offsetInMilliseconds'])) {
                    $audioPlayer->setOffsetInMilliseconds($data['context']['AudioPlayer']['offsetInMilliseconds']);
                }

                $context->setAudioPlayer($audioPlayer);
            }

            if (isset($data['context']['Display'])) {
                $display = new Display();

                if (isset($data['context']['Display']['token'])) {
                    $display->setToken($data['context']['Display']['token']);
                }

                if (isset($data['context']['Display']['templateVersion'])) {
                    $display->setTemplateVersion($data['context']['Display']['templateVersion']);
                }

                if (isset($data['context']['Display']['markupVersion'])) {
                    $display->setMarkupVersion($data['context']['Display']['markupVersion']);
                }

                $context->setDisplay($display);
            }

            if (isset($data['context']['System'])) {
                $contextUser = new ContextUser($data['context']['System']['user']['userId']);

                if (isset($data['context']['System']['user']['accessToken'])) {
                    $contextUser->setAccessToken($data['context']['System']['user']['accessToken']);
                }

                if (isset($data['context']['System']['user']['permissions'])
                    && isset($data['context']['System']['user']['permissions']['consentToken'])) {
                    $contextUser->setConsentToken($data['context']['System']['user']['permissions']['consentToken']);
                }

                $device = new Device();

                if (isset($data['context']['System']['device']['deviceId'])) {
                    $device->setDeviceId($data['context']['System']['device']['deviceId']);
                }

                if (isset($data['context']['System']['device']['supportedInterfaces'])) {
                    $device->setSupportedInterfaces($data['context']['System']['device']['supportedInterfaces']);
                }

                if (isset($data['context']['System']['person'])
                    && isset($data['context']['System']['person']['personId'])) {
                    $contextPerson = new ContextPerson($data['context']['System']['person']['personId']);

                    if (isset($data['context']['System']['person']['accessToken'])) {
                        $contextPerson->setAccessToken($data['context']['System']['person']['accessToken']);
                    }
                } else {
                    $contextPerson = null;
                }

                $system = new System(
                    new ContextApplication($data['context']['System']['application']['applicationId']),
                    $contextUser,
                    $device,
                    $data['context']['System']['apiEndpoint'] ?? null,
                    $data['context']['System']['apiAccessToken'] ?? null,
                    $contextPerson
                );

                $context->setSystem($system);
            }

            if (isset($data['context']['Viewport'])) {

                if (isset($data['context']['Viewport']['experiences'])) {
                    $viewportExperiences = new ViewportExperiences();
                    $viewportExperiences->setExperiences($data['context']['Viewport']['experiences']);
                }

                if (isset($data['context']['Viewport']['video'])) {
                    $viewportVideo = new ViewportVideo();
                    $viewportVideo->setCodecs($data['context']['Viewport']['video']['codecs']);
                }

                if (isset($data['context']['Viewport']['pixelWidth'])
                    && isset($data['context']['Viewport']['pixelHeight'])) {
                    $pixelWidth  = $data['context']['Viewport']['pixelWidth'];
                    $pixelHeight = $data['context']['Viewport']['pixelHeight'];

                    if (isset($data['context']['Viewport']['currentPixelWidth'])
                        && isset($data['context']['Viewport']['currentPixelHeight'])) {
                        $curPixelWidth  = $data['context']['Viewport']['currentPixelWidth'];
                        $curPixelHeight = $data['context']['Viewport']['currentPixelHeight'];
                    } else {
                        $curPixelWidth  = $pixelWidth;
                        $curPixelHeight = $pixelHeight;
                    }
                } elseif (isset($data['context']['Viewport']['currentPixelWidth'])
                    && isset($data['context']['Viewport']['currentPixelHeight'])) {
                    $curPixelWidth  = $data['context']['Viewport']['currentPixelWidth'];
                    $curPixelHeight = $data['context']['Viewport']['currentPixelHeight'];
                    $pixelHeight    = $curPixelHeight;
                    $pixelWidth     = $curPixelWidth;
                } else {
                    $curPixelWidth  = null;
                    $curPixelHeight = null;
                    $pixelHeight    = $curPixelHeight;
                    $pixelWidth     = $curPixelWidth;
                }

                $viewport = new Viewport(
                    $viewportExperiences ?? null,
                    $data['context']['Viewport']['shape'],
                    $pixelWidth,
                    $pixelHeight,
                    $data['context']['Viewport']['dpi'],
                    $curPixelWidth,
                    $curPixelHeight,
                    $data['context']['Viewport']['touch'],
                    $data['context']['Viewport']['keyboard'] ?? null,
                    $viewportVideo ?? null
                );

                $context->setViewport($viewport);
            }
        } else {
            $context = null;
        }

        switch ($data['request']['type']) {
            case 'LaunchRequest':
                $request = new LaunchRequestType(
                    $data['request']['requestId'],
                    $data['request']['timestamp'],
                    $data['request']['locale']
                );
                break;

            case 'SessionEndedRequest':
                if (isset($data['request']['error'])) {
                    $error = new Error(
                        $data['request']['error']['type'],
                        $data['request']['error']['message']
                    );
                } else {
                    $error = null;
                }

                $request = new SessionEndedRequestType(
                    $data['request']['requestId'],
                    $data['request']['timestamp'],
                    $data['request']['locale'],
                    $data['request']['reason'],
                    $error
                );

                break;

            case 'AudioPlayer.PlaybackStarted':
                $request = new AudioPlayerPlaybackStartedType(
                    $data['request']['requestId'],
                    $data['request']['timestamp'],
                    $data['request']['locale'],
                    $data['request']['token'],
                    $data['request']['offsetInMilliseconds']
                );

                break;

            case 'AudioPlayer.PlaybackStopped':
                $request = new AudioPlayerPlaybackStoppedType(
                    $data['request']['requestId'],
                    $data['request']['timestamp'],
                    $data['request']['locale'],
                    $data['request']['token'],
                    $data['request']['offsetInMilliseconds']
                );

                break;

            case 'AudioPlayer.PlaybackFinished':
                $request = new AudioPlayerPlaybackFinishedType(
                    $data['request']['requestId'],
                    $data['request']['timestamp'],
                    $data['request']['locale'],
                    $data['request']['token'],
                    $data['request']['offsetInMilliseconds']
                );

                break;

            case 'AudioPlayer.PlaybackNearlyFinished':
                $request = new AudioPlayerPlaybackNearlyFinishedType(
                    $data['request']['requestId'],
                    $data['request']['timestamp'],
                    $data['request']['locale'],
                    $data['request']['token'],
                    $data['request']['offsetInMilliseconds']
                );

                break;

            case 'AudioPlayer.PlaybackFailed':
                if (isset($data['request']['error'])) {
                    $error = new Error(
                        $data['request']['error']['type'],
                        $data['request']['error']['message']
                    );
                } else {
                    $error = null;
                }

                if (isset($data['request']['currentPlaybackState'])) {
                    $currentPlaybackState = new CurrentPlaybackState(
                        $data['request']['currentPlaybackState']['playerActivity'],
                        $data['request']['currentPlaybackState']['offsetInMilliseconds'],
                        $data['request']['currentPlaybackState']['token']
                    );
                } else {
                    $currentPlaybackState = null;
                }

                $request = new AudioPlayerPlaybackFailedType(
                    $data['request']['requestId'],
                    $data['request']['timestamp'],
                    $data['request']['locale'],
                    $data['request']['token'],
                    $error,
                    $currentPlaybackState
                );

                break;

            case 'PlaybackController.NextCommandIssued':
                $request = new PlaybackControllerNextCommandIssuedType(
                    $data['request']['requestId'],
                    $data['request']['timestamp'],
                    $data['request']['locale']
                );
                break;

            case 'PlaybackController.PauseCommandIssued':
                $request = new PlaybackControllerPauseCommandIssuedType(
                    $data['request']['requestId'],
                    $data['request']['timestamp'],
                    $data['request']['locale']
                );
                break;

            case 'PlaybackController.PlayCommandIssued':
                $request = new PlaybackControllerPlayCommandIssuedType(
                    $data['request']['requestId'],
                    $data['request']['timestamp'],
                    $data['request']['locale']
                );
                break;

            case 'PlaybackController.PreviousCommandIssued':
                $request = new PlaybackControllerPreviousCommandIssuedType(
                    $data['request']['requestId'],
                    $data['request']['timestamp'],
                    $data['request']['locale']
                );
                break;

            case 'System.ExceptionEncountered':
                if (isset($data['request']['error'])) {
                    $error = new Error(
                        $data['request']['error']['type'],
                        $data['request']['error']['message']
                    );
                } else {
                    $error = null;
                }

                if (isset($data['request']['cause'])) {
                    $cause = new Cause(
                        $data['request']['cause']['requestId']
                    );
                } else {
                    $cause = null;
                }

                $request = new SystemExceptionEncounteredType(
                    $data['request']['requestId'],
                    $data['request']['timestamp'],
                    $data['request']['locale'],
                    $error,
                    $cause
                );

                break;
            case 'Alexa.Presentation.APL.UserEvent':
                $userEvent = new UserEvent(
                    $data['request']['arguments'],
                    $data['request']['token'],
                    $data['request']['components'] ?? []
                );
                $request   = new UserEventRequestType(
                    $data['request']['requestId'],
                    $data['request']['timestamp'],
                    $data['request']['locale'],
                    $userEvent
                );
                break;

            case 'IntentRequest':
            default:
                $intent = new Intent(
                    $data['request']['intent']['name'],
                    $data['request']['intent']['slots'] ?? []
                );

                $request = new IntentRequestType(
                    $data['request']['requestId'],
                    $data['request']['timestamp'],
                    $data['request']['locale'],
                    $intent
                );
                break;
        }

        return new AlexaRequest($version, $request, $session, $context, $rawRequestData);
    }
}
