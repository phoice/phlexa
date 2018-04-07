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
 * Class Device
 *
 * @package Phlexa\Request\Context\System
 */
class Device implements DeviceInterface
{
    /** @var string */
    private $deviceId;

    /** @var array */
    private $supportedInterfaces;

    /**
     * @param string $deviceId
     */
    public function setDeviceId(string $deviceId): void
    {
        $this->deviceId = $deviceId;
    }

    /**
     * @return string
     */
    public function getDeviceId()
    {
        return $this->deviceId;
    }

    /**
     * @param array $supportedInterfaces
     */
    public function setSupportedInterfaces(array $supportedInterfaces): void
    {
        $this->supportedInterfaces = $supportedInterfaces;
    }

    /**
     * @return array|null
     */
    public function getSupportedInterfaces()
    {
        return $this->supportedInterfaces;
    }
}
