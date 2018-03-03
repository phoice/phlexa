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
 * Class PlaybackControllerPlayCommandIssuedType
 *
 * @package Phlexa\Request\RequestType
 */
class PlaybackControllerPlayCommandIssuedType extends AbstractRequestType
{
    const NAME = 'PlaybackController.PlayCommandIssued';

    /** @var string */
    private $type = 'PlaybackController.PlayCommandIssued';

    /**
     * PlaybackControllerPlayCommandIssuedType constructor.
     *
     * @param string $requestId
     * @param string $timestamp
     * @param string $locale
     */
    public function __construct(
        string $requestId,
        string $timestamp,
        string $locale
    ) {
        $this->requestId = $requestId;
        $this->timestamp = $timestamp;
        $this->locale    = $locale;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
}
