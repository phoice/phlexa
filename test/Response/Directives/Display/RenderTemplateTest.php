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

use Phlexa\Response\Directives\Display\Image;
use Phlexa\Response\Directives\Display\ListItem;
use Phlexa\Response\Directives\Display\RenderTemplate;
use Phlexa\Response\Directives\Display\TextContent;
use PHPUnit\Framework\TestCase;

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
    public function testBodyTemplateWithMandatoryOnly()
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
    public function testBodyTemplateWithWrongType()
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
    public function testBodyTemplateWithBackgroundImage()
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
                'type'            => 'BodyTemplate1',
                'token'           => 'token',
                'backButton'      => 'HIDDEN',
                'textContent'     => [
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
    public function testBodyTemplateWithAll()
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
                'type'            => 'BodyTemplate1',
                'token'           => 'token',
                'backButton'      => 'VISIBLE',
                'textContent'     => [
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
                'title'           => str_pad('title', 200, 'title'),
                'image'           => [
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

    /**
     *
     */
    public function testListTemplateWithMandatoryOnly()
    {
        $renderTemplate = new RenderTemplate('ListTemplate1', 'token');

        $expected = [
            'type'     => 'Display.RenderTemplate',
            'template' => [
                'type'       => 'ListTemplate1',
                'token'      => 'token',
                'backButton' => 'HIDDEN',
            ],
        ];

        $this->assertEquals($expected, $renderTemplate->toArray());
    }

    /**
     *
     */
    public function testListTemplateWithTwoListItems()
    {
        $textContent1 = new TextContent('primary text 1', null, 'secondary text 1', 'RichText', 'tertiary text 1');

        $image1 = new Image('image description 1');
        $image1->setUrlSmall('https://image.server/small.png');
        $image1->setUrlMedium('https://image.server/medium.png');

        $listItem1 = new ListItem();
        $listItem1->setToken('token1');
        $listItem1->setTextContent($textContent1);
        $listItem1->setImage($image1);

        $textContent2 = new TextContent('primary text 2', null, 'secondary text 2', 'RichText', 'tertiary text 2');

        $image2 = new Image('image description 2');
        $image2->setUrlSmall('https://image.server/small.png');
        $image2->setUrlMedium('https://image.server/medium.png');

        $listItem2 = new ListItem();
        $listItem2->setToken('token2');
        $listItem2->setTextContent($textContent2);
        $listItem2->setImage($image2);

        $renderTemplate = new RenderTemplate('ListTemplate1', 'token');
        $renderTemplate->addListItem($listItem1);
        $renderTemplate->addListItem($listItem2);

        $expected = [
            'type'     => 'Display.RenderTemplate',
            'template' => [
                'type'       => 'ListTemplate1',
                'token'      => 'token',
                'backButton' => 'HIDDEN',
                'listItems'  => [
                    [
                        'token' => 'token1',
                        'textContent' => [
                            'primaryText'   => [
                                'text' => 'primary text 1',
                                'type' => 'PlainText',
                            ],
                            'secondaryText' => [
                                'text' => 'secondary text 1',
                                'type' => 'RichText',
                            ],
                            'tertiaryText'  => [
                                'text' => 'tertiary text 1',
                                'type' => 'PlainText',
                            ],
                        ],
                        'image' => [
                            'contentDescription' => 'image description 1',
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
                    [
                        'token' => 'token2',
                        'textContent' => [
                            'primaryText'   => [
                                'text' => 'primary text 2',
                                'type' => 'PlainText',
                            ],
                            'secondaryText' => [
                                'text' => 'secondary text 2',
                                'type' => 'RichText',
                            ],
                            'tertiaryText'  => [
                                'text' => 'tertiary text 2',
                                'type' => 'PlainText',
                            ],
                        ],
                        'image' => [
                            'contentDescription' => 'image description 2',
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
                ],
            ],
        ];

        $this->assertEquals($expected, $renderTemplate->toArray());
    }


}
