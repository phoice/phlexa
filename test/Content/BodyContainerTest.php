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

use Phlexa\Content\BodyContainer;
use Phlexa\Response\Directives\Alexa\Presentation\APL\Document\APL;
use PHPUnit\Framework\TestCase;

/**
 * Class BodyContainerTest
 *
 * @package PhlexaTest\Content
 */
class BodyContainerTest extends TestCase
{
    /**
     * Test the getter methods with only mandatory data
     */
    public function testGetMethodsWithMandatory(): void
    {
        $content = [
            'output_speech' => 'test output speech',
        ];

        $container = new BodyContainer($content);

        $this->assertEquals($content['output_speech'], $container->getOutputSpeech());
        $this->assertNull($container->getRepromptSpeech());
        $this->assertNull($container->getToken());
        $this->assertNull($container->getDisplayTemplate());
        $this->assertNull($container->getAplDocument());
        $this->assertNull($container->getDisplayTitle());
        $this->assertNull($container->getDisplayLargeText());
        $this->assertNull($container->getDisplayMediumText());
        $this->assertNull($container->getHintText());
        $this->assertNull($container->getLogoIcon());
        $this->assertNull($container->getImageTitle());
        $this->assertNull($container->getSmallFrontImage());
        $this->assertNull($container->getLargeFrontImage());
        $this->assertNull($container->getSmallBackgroundImage());
        $this->assertNull($container->getMediumBackgroundImage());
        $this->assertNull($container->getLargeBackgroundImage());
        $this->assertNull($container->getExtraLargeBackgroundImage());
        $this->assertFalse($container->hasCard());
        $this->assertFalse($container->hasDisplay());
        $this->assertFalse($container->hasApl());
    }

    /**
     * Test the getter methods with all data
     */
    public function testGetMethodsWithAll(): void
    {
        $content = [
            'output_speech'                => 'test output speech',
            'reprompt_speech'              => 'test reprompt speech',
            'token'                        => 'test token',
            'display_template'             => 'test display template',
            'apl_document'                 => $this->getAplDocument(),
            'display_title'                => 'test display title',
            'display_large_text'           => 'test display primary text',
            'display_medium_text'          => 'test display secondary text',
            'hint_text'                    => 'test hint text',
            'logo_icon'                    => 'test logo icon',
            'image_title'                  => 'test image title',
            'small_front_image'            => 'test small front image',
            'large_front_image'            => 'test large front image',
            'small_background_image'       => 'test small background image',
            'medium_background_image'      => 'test medium background image',
            'large_background_image'       => 'test large background image',
            'extra_large_background_image' => 'test extra large background image',
            'card'                         => true,
            'display'                      => true,
            'apl'                          => true,
        ];

        $container = new BodyContainer($content);

        $this->assertEquals($content['output_speech'], $container->getOutputSpeech());
        $this->assertEquals($content['reprompt_speech'], $container->getRepromptSpeech());
        $this->assertEquals($content['token'], $container->getToken());
        $this->assertEquals($content['display_template'], $container->getDisplayTemplate());
        $this->assertEquals($content['apl_document'], $container->getAplDocument());
        $this->assertEquals($content['display_title'], $container->getDisplayTitle());
        $this->assertEquals($content['display_large_text'], $container->getDisplayLargeText());
        $this->assertEquals($content['display_medium_text'], $container->getDisplayMediumText());
        $this->assertEquals($content['hint_text'], $container->getHintText());
        $this->assertEquals($content['logo_icon'], $container->getLogoIcon());
        $this->assertEquals($content['image_title'], $container->getImageTitle());
        $this->assertEquals($content['small_front_image'], $container->getSmallFrontImage());
        $this->assertEquals($content['large_front_image'], $container->getLargeFrontImage());
        $this->assertEquals($content['small_background_image'], $container->getSmallBackgroundImage());
        $this->assertEquals($content['medium_background_image'], $container->getMediumBackgroundImage());
        $this->assertEquals($content['large_background_image'], $container->getLargeBackgroundImage());
        $this->assertEquals($content['extra_large_background_image'], $container->getExtraLargeBackgroundImage());
        $this->assertTrue($container->hasCard());
        $this->assertTrue($container->hasDisplay());
        $this->assertTrue($container->hasApl());
    }

    /**
     * Test the has methods with only mandatory data
     */
    public function testHasMethodsWithMandatory(): void
    {
        $content = [
            'output_speech' => 'test output speech',
        ];

        $container = new BodyContainer($content);

        $this->assertTrue($container->hasOutputSpeech());
        $this->assertFalse($container->hasRepromptSpeech());
        $this->assertFalse($container->hasToken());
        $this->assertFalse($container->hasDisplayTemplate());
        $this->assertFalse($container->hasAplDocument());
        $this->assertFalse($container->hasDisplayTitle());
        $this->assertFalse($container->hasDisplayLargeText());
        $this->assertFalse($container->hasDisplayMediumText());
        $this->assertFalse($container->hasHintText());
        $this->assertFalse($container->hasLogoIcon());
        $this->assertFalse($container->hasImageTitle());
        $this->assertFalse($container->hasSmallFrontImage());
        $this->assertFalse($container->hasLargeFrontImage());
        $this->assertFalse($container->hasSmallBackgroundImage());
        $this->assertFalse($container->hasMediumBackgroundImage());
        $this->assertFalse($container->hasLargeBackgroundImage());
        $this->assertFalse($container->hasExtraLargeBackgroundImage());
        $this->assertFalse($container->hasCard());
        $this->assertFalse($container->hasDisplay());
        $this->assertFalse($container->hasApl());
    }

    /**
     * Test the has methods with all data
     */
    public function testHasMethodsWithAll(): void
    {
        $content = [
            'output_speech'                => 'test output speech',
            'reprompt_speech'              => 'test reprompt speech',
            'token'                        => 'test token',
            'display_template'             => 'test display template',
            'apl_document'                 => $this->getAplDocument(),
            'display_title'                => 'test display title',
            'display_large_text'           => 'test display primary text',
            'display_medium_text'          => 'test display secondary text',
            'hint_text'                    => 'test hint text',
            'logo_icon'                    => 'test logo icon',
            'image_title'                  => 'test image title',
            'small_front_image'            => 'test small front image',
            'large_front_image'            => 'test large front image',
            'small_background_image'       => 'test small background image',
            'medium_background_image'      => 'test medium background image',
            'large_background_image'       => 'test large background image',
            'extra_large_background_image' => 'test extra large background image',
            'card'                         => true,
            'display'                      => true,
            'apl'                          => true,
        ];

        $container = new BodyContainer($content);

        $this->assertTrue($container->hasOutputSpeech());
        $this->assertTrue($container->hasRepromptSpeech());
        $this->assertTrue($container->hasToken());
        $this->assertTrue($container->hasDisplayTemplate());
        $this->assertTrue($container->hasAplDocument());
        $this->assertTrue($container->hasDisplayTitle());
        $this->assertTrue($container->hasDisplayLargeText());
        $this->assertTrue($container->hasDisplayMediumText());
        $this->assertTrue($container->hasHintText());
        $this->assertTrue($container->hasLogoIcon());
        $this->assertTrue($container->hasImageTitle());
        $this->assertTrue($container->hasSmallFrontImage());
        $this->assertTrue($container->hasLargeFrontImage());
        $this->assertTrue($container->hasSmallBackgroundImage());
        $this->assertTrue($container->hasMediumBackgroundImage());
        $this->assertTrue($container->hasLargeBackgroundImage());
        $this->assertTrue($container->hasExtraLargeBackgroundImage());
        $this->assertTrue($container->hasCard());
        $this->assertTrue($container->hasDisplay());
        $this->assertTrue($container->hasApl());
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
