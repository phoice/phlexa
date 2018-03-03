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
    public function getAccessToken(): string;

    /**
     * @return string
     */
    public function getUserId(): string;
}
