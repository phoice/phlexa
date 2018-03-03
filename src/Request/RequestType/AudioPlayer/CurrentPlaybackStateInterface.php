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

namespace Phlexa\Request\RequestType\AudioPlayer;

/**
 * Interface CurrentPlaybackStateInterface
 *
 * @package Phlexa\Request\RequestType\AudioPlayer
 */
interface CurrentPlaybackStateInterface
{
    /**
     * @return string
     */
    public function getToken(): string;

    /**
     * @return int
     */
    public function getOffsetInMilliseconds(): int;

    /**
     * @return string
     */
    public function getPlayerActivity(): string;
}
