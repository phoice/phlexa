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

namespace Phlexa\Request\RequestType;

/**
 * Class AbstractRequestType
 *
 * @package Phlexa\Request\Request
 */
abstract class AbstractRequestType implements RequestTypeInterface
{
    /** @var string */
    protected $locale;

    /** @var string */
    protected $requestId;

    /** @var string */
    protected $timestamp;

    /**
     * @return string
     */
    abstract public function getType(): string;

    /**
     * @return string
     */
    public function getRequestId(): string
    {
        return $this->requestId;
    }

    /**
     * @return string
     */
    public function getTimestamp(): string
    {
        return $this->timestamp;
    }

    /**
     * @return string
     */
    public function getLocale(): string
    {
        return $this->locale;
    }
}
