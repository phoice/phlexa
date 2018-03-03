<?php
/**
 * Build voice applications for Amazon Alexa with phlexa and PHP
 *
 * @author     Ralf Eggert <ralf@travello.audio>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/phoice/phlexa
 * @link       https://www.phoice.tech/
 *
 */

namespace PhlexaTest\Response\Directives\Display;

use PHPUnit\Framework\TestCase;
use Phlexa\Response\Directives\Display\TextContent;

/**
 * Class TextContentTest
 *
 * @package PhlexaTest\Response\Directives\Display;
 */
class TextContentTest extends TestCase
{
    /**
     *
     */
    public function testWithPrimaryOnly()
    {
        $textContent = new TextContent('primary text');

        $expected = [
            'primaryText'   => [
                'text' => 'primary text',
                'type' => 'PlainText',
            ],
            'secondaryText' => [
                'text' => '',
                'type' => 'PlainText',
            ],
            'tertiaryText'  => [
                'text' => '',
                'type' => 'PlainText',
            ],
        ];

        $this->assertEquals($expected, $textContent->toArray());
    }

    /**
     *
     */
    public function testWithAllTextsWithSecondaryRichText()
    {
        $textContent = new TextContent('primary text', null, 'secondary text', 'RichText', 'tertiary text');

        $expected = [
            'primaryText'   => [
                'text' => 'primary text',
                'type' => 'PlainText',
            ],
            'secondaryText' => [
                'text' => 'secondary text',
                'type' => 'RichText',
            ],
            'tertiaryText'  => [
                'text' => 'tertiary text',
                'type' => 'PlainText',
            ],
        ];

        $this->assertEquals($expected, $textContent->toArray());
    }
}
