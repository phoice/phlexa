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
 * Class AbstractAudioPlayerRequestType
 *
 * @package Phlexa\Request\RequestType
 */
abstract class AbstractAudioPlayerRequestType extends AbstractRequestType
{
    /** @var string */
    protected $token;

    /** @var int */
    protected $offsetInMilliseconds;

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @return int
     */
    public function getOffsetInMilliseconds(): int
    {
        return $this->offsetInMilliseconds;
    }
}
