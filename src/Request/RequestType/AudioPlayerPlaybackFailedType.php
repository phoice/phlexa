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

namespace Phlexa\Request\RequestType;

use Phlexa\Request\RequestType\AudioPlayer\CurrentPlaybackState;
use Phlexa\Request\RequestType\Error\ErrorInterface;

/**
 * Class AudioPlayerPlaybackFailedType
 *
 * @package Phlexa\Request\RequestType
 */
class AudioPlayerPlaybackFailedType extends AbstractRequestType
{
    const NAME = 'AudioPlayer.PlaybackFailed';

    /** @var string */
    private $token;

    /** @var ErrorInterface */
    private $error;

    /** @var CurrentPlaybackState */
    private $currentPlaybackState;

    /** @var string */
    private $type = 'AudioPlayer.PlaybackFailed';

    /**
     * AudioPlayerPlaybackFailedType constructor.
     *
     * @param string                    $requestId
     * @param string                    $timestamp
     * @param string                    $locale
     * @param string                    $token
     * @param ErrorInterface|null       $error
     * @param CurrentPlaybackState|null $currentPlaybackState
     */
    public function __construct(
        string $requestId,
        string $timestamp,
        string $locale,
        string $token,
        ErrorInterface $error = null,
        CurrentPlaybackState $currentPlaybackState = null
    ) {
        $this->requestId            = $requestId;
        $this->timestamp            = $timestamp;
        $this->locale               = $locale;
        $this->token                = $token;
        $this->error                = $error;
        $this->currentPlaybackState = $currentPlaybackState;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @return ErrorInterface|null
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @return CurrentPlaybackState|null
     */
    public function getCurrentPlaybackState()
    {
        return $this->currentPlaybackState;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
}
