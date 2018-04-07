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

namespace PhlexaTest\Request\RequestType\Intent;

use Phlexa\Request\RequestType\Intent\Intent;
use PHPUnit\Framework\TestCase;

/**
 * Class IntentTest
 *
 * @package PhlexaTest\Request\RequestType\Intent
 */
class IntentTest extends TestCase
{
    /**
     *
     */
    public function testInstantiation(): void
    {
        $slots = [
            'foo' => [
                'name'  => 'foo',
                'value' => 'bar',
            ],
        ];

        $intent = new Intent('name', $slots);

        $this->assertEquals('name', $intent->getName());
        $this->assertEquals($slots, $intent->getSlots());
    }

    /**
     *
     */
    public function testSingleSlotValue(): void
    {
        $slots = [
            'foo' => [
                'name'  => 'foo',
                'value' => 'bar',
            ],
            'bar' => [
                'name'  => 'bar',
                'value' => 'foo',
            ],
        ];

        $intent = new Intent('name', $slots);

        $this->assertEquals(
            $slots['foo']['value'],
            $intent->getSlotValue('foo')
        );
        $this->assertEquals(
            $slots['bar']['value'],
            $intent->getSlotValue('bar')
        );
        $this->assertEquals(
            '',
            $intent->getSlotValue('foobar')
        );
    }

    /**
     *
     */
    public function testComplexSlotValueWithResolutions(): void
    {
        $slots = [
            'foo' => [
                'name'        => 'foo',
                'value'       => 'bar',
                'resolutions' => [
                    'resolutionsPerAuthority' => [
                        [
                            'authority' => 'amzn1.er-authority.echo-sdk.amzn1.ask.skill',
                            'status'    => [
                                'code' => 'ER_SUCCESS_MATCH',
                            ],
                            'values'    => [
                                [
                                    'value' => [
                                        'name' => 'bar123',
                                        'id'   => '123456789abcdef',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ]
            ],
        ];

        $intent = new Intent('name', $slots);

        $this->assertEquals(
            $slots['foo']['resolutions']['resolutionsPerAuthority'][0]['values'][0]['value']['name'],
            $intent->getSlotValue('foo', true)
        );
        $this->assertEquals(
            $slots['foo']['value'],
            $intent->getSlotValue('foo')
        );
    }
}
