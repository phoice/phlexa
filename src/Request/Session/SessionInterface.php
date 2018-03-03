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

namespace Phlexa\Request\Session;

/**
 * Interface SessionInterface
 *
 * @package Phlexa\Request\Session
 */
interface SessionInterface
{
    /**
     * @return ApplicationInterface
     */
    public function getApplication(): ApplicationInterface;

    /**
     * @param $key
     *
     * @return mixed
     */
    public function getAttribute($key);

    /**
     * @return array
     */
    public function getAttributes(): array;

    /**
     * @return string
     */
    public function getSessionId(): string;

    /**
     * @return UserInterface
     */
    public function getUser(): UserInterface;

    /**
     * @return boolean
     */
    public function isNew(): bool;
}
