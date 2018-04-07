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

namespace Phlexa\Request\Context;

/**
 * Interface AudioPlayer
 *
 * @package Phlexa\Request\Context
 */
interface AudioPlayerInterface
{
    /**
     * @return string
     */
    public function getPlayerActivity(): string;

    /**
     * @param string $token
     */
    public function setToken(string $token);

    /**
     * @return string|null
     */
    public function getToken();

    /**
     * @param int $offsetInMilliseconds
     */
    public function setOffsetInMilliseconds(int $offsetInMilliseconds);

    /**
     * @return int|null
     */
    public function getOffsetInMilliseconds();
}
