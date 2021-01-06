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

use Phlexa\Request\RequestType\UserEvent\UserEventInterface;

/**
 * Class UserEventRequestType
 *
 * @package Phlexa\Request\RequestType
 */
class UserEventRequestType extends AbstractRequestType
{
    public const NAME = 'Alexa.Presentation.APL.UserEvent';

    /** @var string */
    private $type = 'Alexa.Presentation.APL.UserEvent';

    /** @var UserEventInterface */
    private $userEvent;

    /**
     * LaunchRequestType constructor.
     *
     * @param string $requestId
     * @param string $timestamp
     * @param string $locale
     */
    public function __construct(
        string $requestId,
        string $timestamp,
        string $locale,
        UserEventInterface $userEvent
    ) {
        $this->requestId = $requestId;
        $this->timestamp = $timestamp;
        $this->locale    = $locale;
        $this->userEvent = $userEvent;
    }
    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return UserEventInterface
     */
    public function getUserEvent(): UserEventInterface
    {
        return $this->userEvent;
    }
}
