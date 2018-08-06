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

namespace Phlexa\Request\Context\System;

/**
 * Interface UserInterface
 *
 * @package Phlexa\Request\Context\System
 */
interface UserInterface
{
    /**
     * @return string
     */
    public function getUserId(): string;

    /**
     * @param string $accessToken
     */
    public function setAccessToken(string $accessToken);

    /**
     * @return string|null
     */
    public function getAccessToken(): ?string;

    /**
     * @param string $consentToken
     */
    public function setConsentToken(string $consentToken);

    /**
     * @return string|null
     */
    public function getConsentToken(): ?string;
}
