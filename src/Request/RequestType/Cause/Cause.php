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

namespace Phlexa\Request\RequestType\Cause;

/**
 * Class Cause
 *
 * @package Phlexa\Request\RequestType\Cause
 */
class Cause implements CauseInterface
{
    /** @var string */
    private $requestId;

    /**
     * Cause constructor.
     *
     * @param string $requestId
     */
    public function __construct(string $requestId)
    {
        $this->requestId = $requestId;
    }

    /**
     * @return string
     */
    public function getRequestId(): string
    {
        return $this->requestId;
    }
}
