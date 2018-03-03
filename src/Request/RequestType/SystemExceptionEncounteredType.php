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

namespace Phlexa\Request\RequestType;

use Phlexa\Request\RequestType\Cause\CauseInterface;
use Phlexa\Request\RequestType\Error\ErrorInterface;

/**
 * Class SystemExceptionEncounteredType
 *
 * @package Phlexa\Request\RequestType
 */
class SystemExceptionEncounteredType extends AbstractRequestType
{
    const NAME = 'System.ExceptionEncountered';

    /** @var ErrorInterface */
    private $error;

    /** @var CauseInterface */
    private $cause;

    /** @var string */
    private $type = 'System.ExceptionEncountered';

    /**
     * SystemExceptionEncounteredType constructor.
     *
     * @param string              $requestId
     * @param string              $timestamp
     * @param string              $locale
     * @param ErrorInterface|null $error
     * @param CauseInterface|null $cause
     */
    public function __construct(
        string $requestId,
        string $timestamp,
        string $locale,
        ErrorInterface $error = null,
        CauseInterface $cause = null
    ) {
        $this->requestId = $requestId;
        $this->timestamp = $timestamp;
        $this->locale    = $locale;
        $this->error     = $error;
        $this->cause     = $cause;
    }

    /**
     * @return ErrorInterface|null
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @return CauseInterface
     */
    public function getCause()
    {
        return $this->cause;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
}
