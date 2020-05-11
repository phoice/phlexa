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

namespace Phlexa\Request\RequestType\Intent;

use function count;

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

    /**
     * @param string $key
     *
     * @return array
     */
    public function getAllSlotValues(string $key): array
    {
        $values = [];

        if (isset($this->slots[$key]['resolutions'])) {
            if (isset($this->slots[$key]['resolutions']['resolutionsPerAuthority'])) {
                foreach ($this->slots[$key]['resolutions']['resolutionsPerAuthority'] as $resolution) {
                    if (isset($resolution['values'])) {
                        foreach ($resolution['values'] as $resolutionValue) {
                            if (isset($resolutionValue['value']) && isset($resolutionValue['value']['name'])) {
                                $values[] = $resolutionValue['value']['name'];
                            }
                        }
                    }
                }
            }
        }

        return $values;
    }

    /**
     * @param string $key
     *
     * @return int
     */
    public function countSlotValues(string $key): int
    {
        $count = 0;

        if (isset($this->slots[$key], $this->slots[$key]['value'])) {
            $count = 1;
        }

        if (isset($this->slots[$key]['resolutions'])) {
            if (isset($this->slots[$key]['resolutions']['resolutionsPerAuthority'])) {
                foreach ($this->slots[$key]['resolutions']['resolutionsPerAuthority'] as $resolution) {
                    if (isset($resolution['values'])) {
                        $count = count($resolution['values']);
                    }
                }
            }
        }

        return $count;
    }

    /**
     * @param string $key
     *
     * @return bool
     */
    public function hasValidSlotValue(string $key): bool
    {
        if (!isset($this->slots[$key])) {
            return false;
        }

        if (!isset($this->slots[$key]['resolutions'])) {
            return false;
        }

        $resolutions = $this->slots[$key]['resolutions'];

        if (!isset($resolutions['resolutionsPerAuthority'])) {
            return false;
        }

        foreach ($resolutions['resolutionsPerAuthority'] as $resolution) {
            if (isset($resolution['status']) && isset($resolution['status']['code'])) {
                return $resolution['status']['code'] === 'ER_SUCCESS_MATCH';
            }
        }

        return false;
    }

    /**
     * @param string $key
     *
     * @return string
     */
    public function getSlotId(string $key) : string
    {
        if (!isset($this->slots[$key])) {
            return '';
        }

        if (isset($this->slots[$key]['resolutions'])) {
            if (isset($this->slots[$key]['resolutions']['resolutionsPerAuthority'])) {
                foreach ($this->slots[$key]['resolutions']['resolutionsPerAuthority'] as $resolution) {
                    if (isset($resolution['values'])) {
                        foreach ($resolution['values'] as $resolutionValue) {
                            if (isset($resolutionValue['value']) && isset($resolutionValue['value']['id'])) {
                                return $resolutionValue['value']['id'];
                            }
                        }
                    }
                }
            }
        }

        return '';
    }
}
