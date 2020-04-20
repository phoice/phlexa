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

namespace PhlexaTest\Response\Directives\Alexa\Presentation\APL\Document;

use Phlexa\Response\Directives\Alexa\Presentation\APL\Document\APL;
use PHPUnit\Framework\TestCase;

/**
 * Class APLTest
 *
 * @package PhlexaTest\Response\Directives\Alexa\Presentation\APL\Document
 */
class APLTest extends TestCase
{
    /**
     *
     */
    public function testConstructor(): void
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

        $expected = [
            'type'         => 'APL',
            'version'      => '1.3',
            'theme'        => 'dark',
            'import'       => $import,
            'resources'    => $resources,
            'styles'       => $styles,
            'layouts'      => $layouts,
            'mainTemplate' => $mainTemplate,
            'settings'     => [],
            'onMount'      => [],
            'graphics'     => [],
            'commands'     => [],
        ];

        $this->assertEquals($expected, $aplDocument->toArray());
        $this->assertEquals('APL', $aplDocument->getType());
    }

    /**
     *
     */
    public function testFactoryFromString(): void
    {
        $aplJson  = file_get_contents(__DIR__ . '/test-assets/simple-apl.json');
        $aplArray = include __DIR__ . '/test-assets/simple-apl.php';

        $aplDocument = APL::createFromString($aplJson);

        $this->assertEquals($aplArray, $aplDocument->toArray());
        $this->assertEquals($aplArray['type'], $aplDocument->getType());
    }

    /**
     *
     */
    public function testFactoryFromFile(): void
    {
        $aplFile  = __DIR__ . '/test-assets/simple-apl.json';
        $aplArray = include __DIR__ . '/test-assets/simple-apl.php';

        $aplDocument = APL::createFromFile($aplFile);

        $this->assertEquals($aplArray, $aplDocument->toArray());
        $this->assertEquals($aplArray['type'], $aplDocument->getType());
    }
}
