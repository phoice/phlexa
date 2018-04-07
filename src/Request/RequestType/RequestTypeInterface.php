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

namespace Phlexa\Request\RequestType;

/**
 * Interface AbstractRequestType
 *
 * @package Phlexa\Request\Request
 */
interface RequestTypeInterface
{
    /**
     * @return string
     */
    public function getLocale(): string;

    /**
     * @return string
     */
    public function getRequestId(): string;

    /**
     * @return string
     */
    public function getTimestamp(): string;

    /**
     * @return string
     */
    public function getType(): string;
}
