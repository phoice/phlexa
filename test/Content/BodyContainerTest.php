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
use Phlexa\Content\ImageContainer;
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
        $this->assertNull($container->getDisplayShortText());
        $this->assertNull($container->getCardText());
        $this->assertNull($container->getHintText());
        $this->assertNull($container->getLogoIcon());
        $this->assertNull($container->getImage());
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
            'card_text'           => 'test card text',
            'hint_text'           => 'test hint text',
            'logo_icon'           => 'test logo icon',
            'image'               => new ImageContainer(
                [
                    'image_id'                     => 'imageDefault',
                    'image_title'                  => 'test image title',
                    'hint_text'                    => 'test hint text',
                    'small_front_image'            => 'test small front image',
                    'large_front_image'            => 'test large front image',
                    'round_background_image'       => 'test round background image',
                    'medium_background_image'      => 'test medium background image',
                    'large_background_image'       => 'test large background image',
                    'extra_large_background_image' => 'test extra large background image',
                ]
            ),
            'card'                => true,
            'display'             => true,
            'apl'                 => true,
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
        $this->assertEquals($content['display_short_text'], $container->getDisplayShortText());
        $this->assertEquals($content['card_text'], $container->getCardText());
        $this->assertEquals($content['hint_text'], $container->getHintText());
        $this->assertEquals($content['logo_icon'], $container->getLogoIcon());
        $this->assertEquals($content['image'], $container->getImage());
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
        $this->assertFalse($container->hasDisplayShortText());
        $this->assertFalse($container->hasCardText());
        $this->assertFalse($container->hasHintText());
        $this->assertFalse($container->hasLogoIcon());
        $this->assertFalse($container->hasImage());
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
            'card_text'           => 'test card text',
            'hint_text'           => 'test hint text',
            'logo_icon'           => 'test logo icon',
            'image'               => new ImageContainer(
                [
                    'image_id'                     => 'imageDefault',
                    'image_title'                  => 'test image title',
                    'hint_text'                    => 'test hint text',
                    'small_front_image'            => 'test small front image',
                    'large_front_image'            => 'test large front image',
                    'round_background_image'       => 'test round background image',
                    'medium_background_image'      => 'test medium background image',
                    'large_background_image'       => 'test large background image',
                    'extra_large_background_image' => 'test extra large background image',
                ]
            ),
            'card'                => true,
            'display'             => true,
            'apl'                 => true,
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
        $this->assertTrue($container->hasDisplayShortText());
        $this->assertTrue($container->hasCardText());
        $this->assertTrue($container->hasHintText());
        $this->assertTrue($container->hasLogoIcon());
        $this->assertTrue($container->hasImage());
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

    /**
     * Test the getter methods with only mandatory data
     */
    public function testSpecialData(): void
    {
        $content = [
            'output_speech' => 'test output speech',
        ];

        $specialData = [
            'foo' => 'bar',
        ];

        $container = new BodyContainer($content);
        $container->setSpecialData($specialData);

        $this->assertEquals($content['output_speech'], $container->getOutputSpeech());
        $this->assertEquals($specialData, $container->getSpecialData());
    }


}
