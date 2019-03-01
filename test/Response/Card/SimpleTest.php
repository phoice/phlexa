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

use Phlexa\Response\Card\Simple;
use PHPUnit\Framework\TestCase;

/**
 * Class SimpleTest
 *
 * @package PhlexaTest\Response\Card
 */
class SimpleTest extends TestCase
{
    /**
     *
     */
    public function testInstantiationWithLongValues()
    {
        $card = new Simple(
            str_pad('title', 70, 'title'),
            str_pad('content', 7000, 'content')
        );

        $expected = [
            'type'    => 'Simple',
            'title'   => str_pad('title', 64, 'title'),
            'content' => str_pad('content', 6000, 'content'),
        ];

        $this->assertEquals($expected, $card->toArray());
    }

    /**
     *
     */
    public function testInstantiationWithShortValues()
    {
        $card = new Simple('title', 'content');

        $expected = [
            'type'    => 'Simple',
            'title'   => 'title',
            'content' => 'content',
        ];

        $this->assertEquals($expected, $card->toArray());
    }
}
