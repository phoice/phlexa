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

use Phlexa\Request\RequestType\Intent\IntentInterface;

/**
 * Class IntentRequestType
 *
 * @package Phlexa\Request\RequestType
 */
class IntentRequestType extends AbstractRequestType
{
    const NAME = 'IntentRequest';

    /** @var IntentInterface */
    private $intent;

    /** @var string */
    private $type = 'IntentRequest';

    /**
     * IntentRequestType constructor.
     *
     * @param string          $requestId
     * @param string          $timestamp
     * @param string          $locale
     * @param IntentInterface $intent
     */
    public function __construct(
        string $requestId,
        string $timestamp,
        string $locale,
        IntentInterface $intent
    ) {
        $this->requestId = $requestId;
        $this->timestamp = $timestamp;
        $this->locale    = $locale;
        $this->intent    = $intent;
    }

    /**
     * @return IntentInterface
     */
    public function getIntent(): IntentInterface
    {
        return $this->intent;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
}
