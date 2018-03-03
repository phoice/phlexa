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

namespace Phlexa\Request\RequestType\Cause;

/**
 * Interface CauseInterface
 *
 * @package Phlexa\Request\RequestType\Cause
 */
interface CauseInterface
{
    /**
     * @return string
     */
    public function getRequestId(): string;
}
