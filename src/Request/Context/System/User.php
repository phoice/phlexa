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
 * Class User
 *
 * @package Phlexa\Request\Context\System
 */
class User implements UserInterface
{
    /** @var string */
    private $userId;

    /** @var string */
    private $accessToken;

    /** @var string */
    private $consentToken;

    /**
     * User constructor.
     *
     * @param string $userId
     */
    public function __construct($userId)
    {
        $this->userId       = $userId;
    }

    /**
     * @return string
     */
    public function getUserId(): string
    {
        return $this->userId;
    }

    /**
     * @param string $accessToken
     */
    public function setAccessToken(string $accessToken): void
    {
        $this->accessToken = $accessToken;
    }

    /**
     * @return string|null
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @param string $consentToken
     */
    public function setConsentToken(string $consentToken): void
    {
        $this->consentToken = $consentToken;
    }

    /**
     * @return string|null
     */
    public function getConsentToken()
    {
        return $this->consentToken;
    }
}
