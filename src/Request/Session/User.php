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
 * Class User
 *
 * @package Phlexa\Request\Session
 */
class User implements UserInterface
{
    /** @var string */
    private $accessToken;

    /** @var string */
    private $userId;

    /**
     * User constructor.
     *
     * @param string $userId
     * @param string $accessToken
     */
    public function __construct(string $userId, string $accessToken = null)
    {
        $this->userId      = $userId;
        $this->accessToken = $accessToken;
    }

    /**
     * @return string
     */
    public function getUserId(): string
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function getAccessToken(): string
    {
        return $this->accessToken;
    }
}
