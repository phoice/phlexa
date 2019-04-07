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
use Phlexa\Content\SlideShowContainer;
use Phlexa\Response\Directives\Alexa\Presentation\APL\Document\APL;
use PHPUnit\Framework\TestCase;

/**
 * Class SlideShowContainerTest
 *
 * @package PhlexaTest\Content
 */
class SlideShowContainerTest extends TestCase
{
    /**
     * Test the getter methods with only mandatory data
     */
    public function testGetMethodsWithMandatory(): void
    {
        $content = [
            'output_speech' => 'test output speech',
        ];

        $container = new SlideShowContainer($content);

        $this->assertEquals($content['output_speech'], $container->getOutputSpeech());
        $this->assertNull($container->getRepromptSpeech());
        $this->assertNull($container->getToken());
        $this->assertNull($container->getDisplayTemplate());
        $this->assertNull($container->getAplDocument());
        $this->assertNull($container->getDisplayTitle());
        $this->assertNull($container->getDisplayLargeText());
        $this->assertNull($container->getDisplayMediumText());
        $this->assertNull($container->getDisplayShortText());
        $this->assertNull($container->getHintText());
        $this->assertNull($container->getLogoIcon());
        $this->assertEmpty($container->getSlideImages());
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
            'output_speech'       => 'test output speech',
            'reprompt_speech'     => 'test reprompt speech',
            'token'               => 'test token',
            'display_template'    => 'test display template',
            'apl_document'        => $this->getAplDocument(),
            'display_title'       => 'test display title',
            'display_large_text'  => 'test display large text',
            'display_medium_text' => 'test display medium text',
            'display_short_text'  => 'test display short text',
            'hint_text'           => 'test hint text',
            'logo_icon'           => 'test logo icon',
            'slide_images'        => ['slide images'],
            'card'                => true,
            'display'             => true,
            'apl'                 => true,
        ];

        $container = new SlideShowContainer($content);

        $this->assertEquals($content['output_speech'], $container->getOutputSpeech());
        $this->assertEquals($content['reprompt_speech'], $container->getRepromptSpeech());
        $this->assertEquals($content['token'], $container->getToken());
        $this->assertEquals($content['display_template'], $container->getDisplayTemplate());
        $this->assertEquals($content['apl_document'], $container->getAplDocument());
        $this->assertEquals($content['display_title'], $container->getDisplayTitle());
        $this->assertEquals($content['display_large_text'], $container->getDisplayLargeText());
        $this->assertEquals($content['display_medium_text'], $container->getDisplayMediumText());
        $this->assertEquals($content['display_short_text'], $container->getDisplayShortText());
        $this->assertEquals($content['hint_text'], $container->getHintText());
        $this->assertEquals($content['logo_icon'], $container->getLogoIcon());
        $this->assertEquals($content['slide_images'], $container->getSlideImages());
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

        $container = new SlideShowContainer($content);

        $this->assertTrue($container->hasOutputSpeech());
        $this->assertFalse($container->hasRepromptSpeech());
        $this->assertFalse($container->hasToken());
        $this->assertFalse($container->hasDisplayTemplate());
        $this->assertFalse($container->hasAplDocument());
        $this->assertFalse($container->hasDisplayTitle());
        $this->assertFalse($container->hasDisplayLargeText());
        $this->assertFalse($container->hasDisplayMediumText());
        $this->assertFalse($container->hasDisplayShortText());
        $this->assertFalse($container->hasHintText());
        $this->assertFalse($container->hasLogoIcon());
        $this->assertFalse($container->hasSlideImages());
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
            'output_speech'       => 'test output speech',
            'reprompt_speech'     => 'test reprompt speech',
            'token'               => 'test token',
            'display_template'    => 'test display template',
            'apl_document'        => $this->getAplDocument(),
            'display_title'       => 'test display title',
            'display_large_text'  => 'test display large text',
            'display_medium_text' => 'test display medium text',
            'display_short_text'  => 'test display short text',
            'hint_text'           => 'test hint text',
            'logo_icon'           => 'test logo icon',
            'slide_images'        => [new ImageContainer()],
            'card'                => true,
            'display'             => true,
            'apl'                 => true,
        ];

        $container = new SlideShowContainer($content);

        $this->assertTrue($container->hasOutputSpeech());
        $this->assertTrue($container->hasRepromptSpeech());
        $this->assertTrue($container->hasToken());
        $this->assertTrue($container->hasDisplayTemplate());
        $this->assertTrue($container->hasAplDocument());
        $this->assertTrue($container->hasDisplayTitle());
        $this->assertTrue($container->hasDisplayLargeText());
        $this->assertTrue($container->hasDisplayMediumText());
        $this->assertTrue($container->hasDisplayShortText());
        $this->assertTrue($container->hasHintText());
        $this->assertTrue($container->hasLogoIcon());
        $this->assertTrue($container->hasSlideImages());
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
