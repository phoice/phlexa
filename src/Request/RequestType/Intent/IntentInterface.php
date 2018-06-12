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

/**
 * Interface Intent
 *
 * @package Phlexa\Request\RequestType\Intent
 */
interface IntentInterface
{
    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param string $key
     * @param bool   $checkResolution
     *
     * @return string
     */
    public function getSlotValue(string $key, $checkResolution = false): string;

    /**
     * @return array
     */
    public function getSlots(): array;

    /**
     * @param string $key
     *
     * @return bool
     */
    public function hasValidSlotValue(string $key): bool;
}
