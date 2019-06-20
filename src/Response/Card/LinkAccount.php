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

namespace Phlexa\Response\Card;

/**
 * Class LinkAccount
 *
 * @package Phlexa\Response\Card
 */
class LinkAccount implements CardInterface
{
    /**
     * Render the card object to an array
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'type' => 'LinkAccount',
        ];
    }
}
