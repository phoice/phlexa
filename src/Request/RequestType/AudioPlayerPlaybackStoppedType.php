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

namespace Phlexa\Request\RequestType;

/**
 * Class AudioPlayerPlaybackStoppedType
 *
 * @package Phlexa\Request\RequestType
 */
class AudioPlayerPlaybackStoppedType extends AbstractAudioPlayerRequestType
{
    public const NAME = 'AudioPlayer.PlaybackStopped';

    /** @var string */
    private $type = 'AudioPlayer.PlaybackStopped';

    /**
     * AudioPlayerPlaybackStoppedType constructor.
     *
     * @param string $requestId
     * @param string $timestamp
     * @param string $locale
     * @param string $token
     * @param int    $offsetInMilliseconds
     */
    public function __construct(
        string $requestId,
        string $timestamp,
        string $locale,
        string $token,
        int $offsetInMilliseconds
    ) {
        $this->requestId            = $requestId;
        $this->timestamp            = $timestamp;
        $this->locale               = $locale;
        $this->token                = $token;
        $this->offsetInMilliseconds = $offsetInMilliseconds;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
}
