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
 * Class Session
 *
 * @package Phlexa\Request\Session
 */
class Session implements SessionInterface
{
    /** @var ApplicationInterface */
    private $application;

    /** @var array */
    private $attributes = [];

    /** @var bool */
    private $new = true;

    /** @var string */
    private $sessionId;

    /** @var UserInterface */
    private $user;

    /**
     * Session constructor.
     *
     * @param bool                 $new
     * @param string               $sessionId
     * @param ApplicationInterface $application
     * @param array                $attributes
     * @param UserInterface        $user
     */
    public function __construct(
        bool $new,
        string $sessionId,
        ApplicationInterface $application,
        array $attributes,
        UserInterface $user
    ) {
        $this->new         = $new;
        $this->sessionId   = $sessionId;
        $this->application = $application;
        $this->attributes  = $attributes;
        $this->user        = $user;
    }

    /**
     * @return boolean
     */
    public function isNew(): bool
    {
        return $this->new;
    }

    /**
     * @return string
     */
    public function getSessionId(): string
    {
        return $this->sessionId;
    }

    /**
     * @return ApplicationInterface
     */
    public function getApplication(): ApplicationInterface
    {
        return $this->application;
    }

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * @param $key
     *
     * @return mixed
     */
    public function getAttribute($key)
    {
        if (isset($this->attributes[$key])) {
            return $this->attributes[$key];
        }

        return null;
    }

    /**
     * @return UserInterface
     */
    public function getUser(): UserInterface
    {
        return $this->user;
    }
}
