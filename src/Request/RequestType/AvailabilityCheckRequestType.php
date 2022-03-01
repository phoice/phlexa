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
 * Class LaunchRequestType
 *
 * @package Phlexa\Request\RequestType
 */
class AvailabilityCheckRequestType extends AbstractRequestType
{
    public const NAME = 'AvailabilityCheckRequest';

    /** @var string */
    private $type = 'AvailabilityCheckRequest';

    /**
     * LaunchRequestType constructor.
     *
     * @param string $requestId
     * @param string $locale
     */
    public function __construct(
        string $requestId,
        string $locale
    ) {
        $this->requestId = $requestId;
        $this->timestamp = date(DATE_ATOM);
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
