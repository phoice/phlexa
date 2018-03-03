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

namespace Phlexa\Response\Card;

/**
 * Interface CardInterface
 *
 * @package Phlexa\Response\Card
 */
interface CardInterface
{
    /**
     * Render the card object to an array
     *
     * @return array
     */
    public function toArray(): array;
}
