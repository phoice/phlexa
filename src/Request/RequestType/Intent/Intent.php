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

namespace Phlexa\Request\RequestType\Intent;

/**
 * Class Intent
 *
 * @package Phlexa\Request\RequestType\Intent
 */
class Intent implements IntentInterface
{
    /** @var string */
    private $name;

    /** @var array */
    private $slots = [];

    /**
     * Intent constructor.
     *
     * @param string $name
     * @param array  $slots
     */
    public function __construct(string $name, array $slots = [])
    {
        $this->name  = $name;
        $this->slots = $slots;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getSlots(): array
    {
        return $this->slots;
    }

    /**
     * @param string $key
     * @param bool   $checkResolution
     *
     * @return string
     */
    public function getSlotValue(string $key, $checkResolution = false): string
    {
        if (!isset($this->slots[$key])) {
            return '';
        }

        if ($checkResolution && isset($this->slots[$key]['resolutions'])) {
            if (isset($this->slots[$key]['resolutions']['resolutionsPerAuthority'])) {
                foreach ($this->slots[$key]['resolutions']['resolutionsPerAuthority'] as $resolution) {
                    if (isset($resolution['values'])) {
                        foreach ($resolution['values'] as $resolutionValue) {
                            if (isset($resolutionValue['value']) && isset($resolutionValue['value']['name'])) {
                                return $resolutionValue['value']['name'];
                            }
                        }
                    }
                }
            }
        }

        if (isset($this->slots[$key]['value'])) {
            return $this->slots[$key]['value'];
        }

        return '';
    }
}
