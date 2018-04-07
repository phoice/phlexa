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

namespace PhlexaTest\Response\Directives\Hint;

use PHPUnit\Framework\TestCase;
use Phlexa\Response\Directives\Hint\Hint;

/**
 * Class HintTest
 *
 * @package PhlexaTest\Response\Directives\Hint;
 */
class HintTest extends TestCase
{
    /**
     *
     */
    public function testWithMandatoryOnly()
    {
        $hint = new Hint('this is a text');

        $expected = [
            'type' => 'Hint',
            'hint' => [
                'type' => 'PlainText',
                'text' => 'this is a text',
            ],
        ];

        $this->assertEquals($expected, $hint->toArray());
    }
}
