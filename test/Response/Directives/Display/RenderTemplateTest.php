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

use PHPUnit\Framework\TestCase;
use Phlexa\Response\Directives\Display\Image;
use Phlexa\Response\Directives\Display\RenderTemplate;
use Phlexa\Response\Directives\Display\TextContent;

/**
 * Class RenderTemplateTest
 *
 * @package PhlexaTest\Response\Directives\Display;
 */
class RenderTemplateTest extends TestCase
{
    /**
     *
     */
    public function testWithMandatoryOnly()
    {
        $textContent = new TextContent('primary text', null, 'secondary text', 'RichText', 'tertiary text');

        $renderTemplate = new RenderTemplate('BodyTemplate1', 'token', $textContent);

        $expected = [
            'type'     => 'Display.RenderTemplate',
            'template' => [
                'type'        => 'BodyTemplate1',
                'token'       => 'token',
                'backButton'  => 'HIDDEN',
                'textContent' => [
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
                ],
            ],
        ];

        $this->assertEquals($expected, $renderTemplate->toArray());
    }

    /**
     *
     */
    public function testWithWrongType()
    {
        $textContent = new TextContent('primary text');

        $renderTemplate = new RenderTemplate('BodyTemplate99', 'token', $textContent);

        $expected = [
            'type'     => 'Display.RenderTemplate',
            'template' => [
                'type'        => 'BodyTemplate1',
                'token'       => 'token',
                'backButton'  => 'HIDDEN',
                'textContent' => [
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
                ],
            ],
        ];

        $this->assertEquals($expected, $renderTemplate->toArray());
    }

    /**
     *
     */
    public function testWithBackgroundImage()
    {
        $backgroundImage = new Image('background image description');
        $backgroundImage->setUrlSmall('https://image.server/small.png');
        $backgroundImage->setUrlMedium('https://image.server/medium.png');

        $textContent = new TextContent('primary text', null, 'secondary text', 'RichText', 'tertiary text');

        $renderTemplate = new RenderTemplate('BodyTemplate1', 'token', $textContent);
        $renderTemplate->setBackgroundImage($backgroundImage);

        $expected = [
            'type'     => 'Display.RenderTemplate',
            'template' => [
                'type'        => 'BodyTemplate1',
                'token'       => 'token',
                'backButton'  => 'HIDDEN',
                'textContent' => [
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
                ],
                'backgroundImage' => [
                    'contentDescription' => 'background image description',
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
                ]
            ],
        ];

        $this->assertEquals($expected, $renderTemplate->toArray());
    }

    /**
     *
     */
    public function testWithAll()
    {
        $backgroundImage = new Image('background image description');
        $backgroundImage->setUrlSmall('https://image.server/small.png');
        $backgroundImage->setUrlMedium('https://image.server/medium.png');

        $image = new Image('image description');
        $image->setUrlSmall('https://image.server/small.png');
        $image->setUrlMedium('https://image.server/medium.png');

        $textContent = new TextContent('primary text', null, 'secondary text', 'RichText', 'tertiary text');

        $renderTemplate = new RenderTemplate('BodyTemplate1', 'token', $textContent);
        $renderTemplate->setTitle(str_pad('title', 500, 'title'));
        $renderTemplate->setBackButton('VISIBLE');
        $renderTemplate->setBackgroundImage($backgroundImage);
        $renderTemplate->setImage($image);

        $expected = [
            'type'     => 'Display.RenderTemplate',
            'template' => [
                'type'        => 'BodyTemplate1',
                'token'       => 'token',
                'backButton'  => 'VISIBLE',
                'textContent' => [
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
                ],
                'backgroundImage' => [
                    'contentDescription' => 'background image description',
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
                'title' => str_pad('title', 200, 'title'),
                'image' => [
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
            ],
        ];

        $this->assertEquals($expected, $renderTemplate->toArray());
    }
}
