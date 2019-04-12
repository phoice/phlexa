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

use Phlexa\Response\Directives\Display\Image;
use Phlexa\Response\Directives\Display\ListItem;
use Phlexa\Response\Directives\Display\TextContent;
use PHPUnit\Framework\TestCase;

/**
 * Class ListItemTest
 *
 * @package PhlexaTest\Response\Directives\Display;
 */
class ListItemTest extends TestCase
{
    /**
     *
     */
    public function testWithDescriptionOnly()
    {
        $listItem = new ListItem();

        $expected = [];

        $this->assertEquals($expected, $listItem->toArray());
    }

    /**
     *
     */
    public function testWithTokenAndTextContent()
    {
        $textContent = new TextContent('primary text', null, 'secondary text', 'RichText', 'tertiary text');

        $listItem = new ListItem();
        $listItem->setToken('token');
        $listItem->setTextContent($textContent);

        $expected = [
            'token'       => 'token',
            'textContent' => [
                'primaryText'  => [
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
            ],
        ];

        $this->assertEquals($expected, $listItem->toArray());
    }

    /**
     *
     */
    public function testWithAll()
    {
        $textContent = new TextContent('primary text', null, 'secondary text', 'RichText', 'tertiary text');

        $image = new Image('image description');
        $image->setUrlSmall('https://image.server/small.png');
        $image->setUrlMedium('https://image.server/medium.png');

        $listItem = new ListItem();
        $listItem->setToken('token');
        $listItem->setTextContent($textContent);
        $listItem->setImage($image);

        $expected = [
            'token'       => 'token',
            'textContent' => [
                'primaryText'  => [
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
            ],
            'image'       => [
                'contentDescription' => 'image description',
                'sources'            => [
                    [
                        'url'  => 'https://image.server/small.png',
                        'type' => 'SMALL',
                    ],
                    [
                        'url'  => 'https://image.server/medium.png',
                        'type' => 'MEDIUM',
                    ],
                ],
            ],
        ];

        $this->assertEquals($expected, $listItem->toArray());
    }
}
