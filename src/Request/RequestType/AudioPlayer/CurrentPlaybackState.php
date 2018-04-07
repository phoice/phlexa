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

namespace Phlexa\Request\RequestType\AudioPlayer;

/**
 * Class CurrentPlaybackState
 *
 * @package Phlexa\Request\RequestType\AudioPlayer
 */
class CurrentPlaybackState implements CurrentPlaybackStateInterface
{
    /** @var string */
    private $token;

    /** @var int */
    private $offsetInMilliseconds;

    /** @var string */
    private $playerActivity;

    /**
     * Error constructor.
     *
     * @param string $playerActivity
     * @param int    $offsetInMilliseconds
     * @param string $token
     */
    public function __construct(string $playerActivity, int $offsetInMilliseconds, string $token)
    {
        $this->token                = $token;
        $this->offsetInMilliseconds = $offsetInMilliseconds;
        $this->playerActivity       = $playerActivity;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @return int
     */
    public function getOffsetInMilliseconds(): int
    {
        return $this->offsetInMilliseconds;
    }

    /**
     * @return string
     */
    public function getPlayerActivity(): string
    {
        return $this->playerActivity;
    }
}
