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

namespace PhlexaTest\Response\Directives\Alexa\Presentation\APL;

use Phlexa\Response\Directives\Alexa\Presentation\APL\Document\APL;
use Phlexa\Response\Directives\Alexa\Presentation\APL\RenderDocument;
use PHPUnit\Framework\TestCase;

/**
 * Class RenderDocumentTest
 *
 * @package PhlexaTest\Response\Directives\Alexa\Presentation\APL
 */
class RenderDocumentTest extends TestCase
{
    /**
     *
     */
    public function testWithMandatoryOnly(): void
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

        $aplDocument = new APL($import, $resources, $styles, $layouts, $mainTemplate);

        $datasources = [];

        $renderDocument = new RenderDocument($aplDocument, 'my-token', $datasources);

        $expected = [
            'type'        => 'Alexa.Presentation.APL.RenderDocument',
            'document'    => [
                'type'         => 'APL',
                'version'      => '1.0',
                'theme'        => 'dark',
                'import'       => $import,
                'resources'    => $resources,
                'styles'       => $styles,
                'layouts'      => $layouts,
                'mainTemplate' => $mainTemplate,
            ],
            'version'     => '1.0',
            'token'       => 'my-token',
            'datasources' => $datasources,
        ];

        $this->assertEquals($expected, $renderDocument->toArray());
        $this->assertEquals('Alexa.Presentation.APL.RenderDocument', $renderDocument->getType());
    }
}
