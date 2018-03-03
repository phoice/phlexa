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
     *
     * @return string
     */
    public function getSlotValue(string $key): string;

    /**
     * @return array
     */
    public function getSlots(): array;
}
