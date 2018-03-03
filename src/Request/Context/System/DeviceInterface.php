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

namespace Phlexa\Request\Context\System;

/**
 * Interface DeviceInterface
 *
 * @package Phlexa\Request\Context\System
 */
interface DeviceInterface
{
    /**
     * @param string $deviceId
     */
    public function setDeviceId(string $deviceId);

    /**
     * @return string
     */
    public function getDeviceId();

    /**
     * @param array $supportedInterfaces
     */
    public function setSupportedInterfaces(array $supportedInterfaces);

    /**
     * @return array|null
     */
    public function getSupportedInterfaces();
}
