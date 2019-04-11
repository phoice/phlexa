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
            'image_id'    => 'test image id',
            'image_title' => 'test image title',
        ];

        $container = new ImageContainer($content);

        $this->assertEquals($content['image_id'], $container->getImageId());
        $this->assertEquals($content['image_title'], $container->getImageTitle());
        $this->assertNull($container->getHintText());
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
            'image_id'                     => 'test image id',
            'image_title'                  => 'test image title',
            'hint_text'                    => 'test hint text',
            'small_front_image'            => 'test small front image',
            'large_front_image'            => 'test large front image',
            'small_background_image'       => 'test small background image',
            'medium_background_image'      => 'test medium background image',
            'large_background_image'       => 'test large background image',
            'extra_large_background_image' => 'test extra large background image',
        ];

        $container = new ImageContainer($content);

        $this->assertEquals($content['image_id'], $container->getImageId());
        $this->assertEquals($content['image_title'], $container->getImageTitle());
        $this->assertEquals($content['hint_text'], $container->getHintText());
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
            'image_id'    => 'test image id',
            'image_title' => 'test image title',
        ];

        $container = new ImageContainer($content);

        $this->assertTrue($container->hasImageId());
        $this->assertTrue($container->hasImageTitle());
        $this->assertFalse($container->hasHintText());
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
            'image_id'                     => 'test image id',
            'image_title'                  => 'test image title',
            'hint_text'                    => 'test hint text',
            'small_front_image'            => 'test small front image',
            'large_front_image'            => 'test large front image',
            'small_background_image'       => 'test small background image',
            'medium_background_image'      => 'test medium background image',
            'large_background_image'       => 'test large background image',
            'extra_large_background_image' => 'test extra large background image',
        ];

        $container = new ImageContainer($content);

        $this->assertTrue($container->hasImageId());
        $this->assertTrue($container->hasImageTitle());
        $this->assertTrue($container->hasHintText());
        $this->assertTrue($container->hasSmallFrontImage());
        $this->assertTrue($container->hasLargeFrontImage());
        $this->assertTrue($container->hasSmallBackgroundImage());
        $this->assertTrue($container->hasMediumBackgroundImage());
        $this->assertTrue($container->hasLargeBackgroundImage());
        $this->assertTrue($container->hasExtraLargeBackgroundImage());
    }
}
