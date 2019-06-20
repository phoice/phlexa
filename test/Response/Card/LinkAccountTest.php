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

use Phlexa\Response\Card\LinkAccount;
use PHPUnit\Framework\TestCase;

/**
 * Class LinkAccountTest
 *
 * @package PhlexaTest\Response\Card
 */
class LinkAccountTest extends TestCase
{
    /**
     *
     */
    public function testInstantiation()
    {
        $card = new LinkAccount();

        $expected = [
            'type' => 'LinkAccount',
        ];

        $this->assertEquals($expected, $card->toArray());
    }
}
