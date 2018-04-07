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

use Phlexa\Request\Context\System\ApplicationInterface;
use Phlexa\Request\Context\System\DeviceInterface;
use Phlexa\Request\Context\System\UserInterface;

/**
 * Class System
 *
 * @package Phlexa\Request\Context
 */
class System implements SystemInterface
{
    /** @var ApplicationInterface */
    private $application;

    /** @var UserInterface */
    private $user;

    /** @var DeviceInterface */
    private $device;

    /** @var string */
    private $apiEndpoint;

    /**
     * System constructor.
     *
     * @param ApplicationInterface $application
     * @param UserInterface        $user
     * @param DeviceInterface      $device
     * @param string|null          $apiEndpoint
     */
    public function __construct(
        ApplicationInterface $application,
        UserInterface $user,
        DeviceInterface $device,
        string $apiEndpoint = null
    ) {
        $this->application = $application;
        $this->user        = $user;
        $this->device      = $device;

        if ($apiEndpoint) {
            $this->apiEndpoint = $apiEndpoint;
        }
    }

    /**
     * @return ApplicationInterface
     */
    public function getApplication(): ApplicationInterface
    {
        return $this->application;
    }

    /**
     * @return UserInterface
     */
    public function getUser(): UserInterface
    {
        return $this->user;
    }

    /**
     * @return DeviceInterface
     */
    public function getDevice(): DeviceInterface
    {
        return $this->device;
    }

    /**
     * @return string
     */
    public function getApiEndpoint()
    {
        return $this->apiEndpoint;
    }
}
