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

namespace PhlexaTest\Content;

use Phlexa\Content\ImageContainer;
use Phlexa\Response\Directives\Alexa\Presentation\APL\Document\APL;
use PHPUnit\Framework\TestCase;

/**
 * Class ImageContainerTest
 *
 * @package PhlexaTest\Content
 */
class ImageContainerTest extends TestCase
{
    /**
     * Test the getter methods with only mandatory data
     */
    public function testGetMethodsWithMandatory(): void
    {
        $content = [
            'image_title' => 'test image title',
        ];

        $container = new ImageContainer($content);

        $this->assertEquals($content['image_title'], $container->getImageTitle());
        $this->assertNull($container->getSmallFrontImage());
        $this->assertNull($container->getLargeFrontImage());
        $this->assertNull($container->getSmallBackgroundImage());
        $this->assertNull($container->getMediumBackgroundImage());
        $this->assertNull($container->getLargeBackgroundImage());
        $this->assertNull($container->getExtraLargeBackgroundImage());
    }

    /**
     * Test the getter methods with all data
     */
    public function testGetMethodsWithAll(): void
    {
        $content = [
            'image_title'                  => 'test image title',
            'small_front_image'            => 'test small front image',
            'large_front_image'            => 'test large front image',
            'small_background_image'       => 'test small background image',
            'medium_background_image'      => 'test medium background image',
            'large_background_image'       => 'test large background image',
            'extra_large_background_image' => 'test extra large background image',
        ];

        $container = new ImageContainer($content);

        $this->assertEquals($content['image_title'], $container->getImageTitle());
        $this->assertEquals($content['small_front_image'], $container->getSmallFrontImage());
        $this->assertEquals($content['large_front_image'], $container->getLargeFrontImage());
        $this->assertEquals($content['small_background_image'], $container->getSmallBackgroundImage());
        $this->assertEquals($content['medium_background_image'], $container->getMediumBackgroundImage());
        $this->assertEquals($content['large_background_image'], $container->getLargeBackgroundImage());
        $this->assertEquals($content['extra_large_background_image'], $container->getExtraLargeBackgroundImage());
    }

    /**
     * Test the has methods with only mandatory data
     */
    public function testHasMethodsWithMandatory(): void
    {
        $content = [
            'image_title' => 'test image title',
        ];

        $container = new ImageContainer($content);

        $this->assertTrue($container->hasImageTitle());
        $this->assertFalse($container->hasSmallFrontImage());
        $this->assertFalse($container->hasLargeFrontImage());
        $this->assertFalse($container->hasSmallBackgroundImage());
        $this->assertFalse($container->hasMediumBackgroundImage());
        $this->assertFalse($container->hasLargeBackgroundImage());
        $this->assertFalse($container->hasExtraLargeBackgroundImage());
    }

    /**
     * Test the has methods with all data
     */
    public function testHasMethodsWithAll(): void
    {
        $content = [
            'image_title'                  => 'test image title',
            'small_front_image'            => 'test small front image',
            'large_front_image'            => 'test large front image',
            'small_background_image'       => 'test small background image',
            'medium_background_image'      => 'test medium background image',
            'large_background_image'       => 'test large background image',
            'extra_large_background_image' => 'test extra large background image',
        ];

        $container = new ImageContainer($content);

        $this->assertTrue($container->hasImageTitle());
        $this->assertTrue($container->hasSmallFrontImage());
        $this->assertTrue($container->hasLargeFrontImage());
        $this->assertTrue($container->hasSmallBackgroundImage());
        $this->assertTrue($container->hasMediumBackgroundImage());
        $this->assertTrue($container->hasLargeBackgroundImage());
        $this->assertTrue($container->hasExtraLargeBackgroundImage());
    }

    /**
     * @return APL
     */
    private function getAplDocument(): APL
    {
        $import       = [
            [
                'name'    => 'alexa-layouts',
                'version' => '1.0.0',
            ],
        ];
        $resources    = [
            [
                'description' => 'Stock color for the light theme',
                'colors'      => [
                    'colorTextPrimary' => '#151920',
                ],
            ],
        ];
        $styles       = [
            'textStyleBase' => [
                'description' => 'Base font description; set color and core font family',
                'values'      => [
                    [
                        'color'      => '@colorTextPrimary',
                        'fontFamily' => 'Amazon Ember',
                    ],
                ],
            ],
        ];
        $layouts      = [];
        $mainTemplate = [
            'description' => 'Test Template',
            'parameters'  => [
                'payload',
            ],
            'items'       => [],
        ];

        return new APL($import, $resources, $styles, $layouts, $mainTemplate);
    }
}
