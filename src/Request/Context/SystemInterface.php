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
 * Interface System
 *
 * @package Phlexa\Request\Context
 */
interface SystemInterface
{
    /**
     * @return ApplicationInterface
     */
    public function getApplication(): ApplicationInterface;

    /**
     * @return UserInterface
     */
    public function getUser(): UserInterface;

    /**
     * @return DeviceInterface
     */
    public function getDevice(): DeviceInterface;

    /**
     * @return string
     */
    public function getApiEndpoint();

    /**
     * @return string
     */
    public function getApiAccessToken();
}
