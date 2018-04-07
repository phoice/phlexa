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

namespace PhlexaTest\Response\Card;

use PHPUnit\Framework\TestCase;
use Phlexa\Response\Card\Standard;

/**
 * Class StandardTest
 *
 * @package PhlexaTest\Response\Card
 */
class StandardTest extends TestCase
{
    /**
     *
     */
    public function testInstantiationWithLongValues()
    {
        $card = new Standard(
            str_pad('title', 70, 'title'),
            str_pad('text', 7000, 'text'),
            'https://image.server/small.png',
            'https://image.server/large.png'
        );

        $expected = [
            'type'  => 'Standard',
            'title' => str_pad('title', 64, 'title'),
            'text'  => str_pad('text', 6000, 'text'),
            'image' => [
                'smallImageUrl' => 'https://image.server/small.png',
                'largeImageUrl' => 'https://image.server/large.png',
            ],
        ];

        $this->assertEquals($expected, $card->toArray());
    }

    /**
     *
     */
    public function testInstantiationWithShortValues()
    {
        $card = new Standard('title', 'text', 'https://image.server/small.png', 'https://image.server/large.png');

        $expected = [
            'type'  => 'Standard',
            'title' => 'title',
            'text'  => 'text',
            'image' => [
                'smallImageUrl' => 'https://image.server/small.png',
                'largeImageUrl' => 'https://image.server/large.png',
            ],
        ];

        $this->assertEquals($expected, $card->toArray());
    }
}
