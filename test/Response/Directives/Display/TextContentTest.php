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

namespace PhlexaTest\Response\Directives\Display;

use Phlexa\Response\Directives\Display\TextContent;
use PHPUnit\Framework\TestCase;

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
            'largeText'  => [
                'text' => 'primary text',
                'type' => 'PlainText',
            ],
            'mediumText' => [
                'text' => '',
                'type' => 'PlainText',
            ],
            'shortText'  => [
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
            'largeText'  => [
                'text' => 'primary text',
                'type' => 'PlainText',
            ],
            'mediumText' => [
                'text' => 'secondary text',
                'type' => 'RichText',
            ],
            'shortText'  => [
                'text' => 'tertiary text',
                'type' => 'PlainText',
            ],
        ];

        $this->assertEquals($expected, $textContent->toArray());
    }
}
