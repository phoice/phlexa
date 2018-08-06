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

namespace Phlexa\Request\Session;

/**
 * Interface User
 *
 * @package Phlexa\Request\Session
 */
interface UserInterface
{
    /**
     * @return string
     */
    public function getUserId(): string;

    /**
     * @return string
     */
    public function getAccessToken(): ?string;
}
