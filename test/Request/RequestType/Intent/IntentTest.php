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

    /**
     *
     */
    public function testSingleSlotCount(): void
    {
        $slots = [
            'foo' => [
                'name'  => 'foo',
                'value' => 'bar',
            ],
            'bar' => [],
        ];

        $intent = new Intent('name', $slots);

        $this->assertEquals(
            1,
            $intent->countSlotValues('foo')
        );
        $this->assertEquals(
            0,
            $intent->countSlotValues('bar')
        );
    }

    /**
     *
     */
    public function testSlotValue(): void
    {
        $slots = [
            'foo' => [
                'name'  => 'foo',
                'value' => 'bar',
            ],
            'bar' => [],
        ];

        $intent = new Intent('name', $slots);

        $this->assertEquals(
            'bar',
            $intent->getSlotValue('foo')
        );
        $this->assertEquals(
            '',
            $intent->getSlotValue('bar')
        );
    }

    /**
     *
     */
    public function testHasValidSlotValue(): void
    {
        $slots = [
            'foo'  => [
                'name'        => 'foo',
                'value'       => 'bar',
                'resolutions' => [
                    'resolutionsPerAuthority' => [
                        [
                            'status' => [
                                'code' => 'ER_SUCCESS_MATCH',
                            ],
                        ]
                    ],
                ]
            ],
            'bar'  => [],
            'bar2' => [
                'resolutions' => [],
            ],
            'bar3' => [
                'resolutions' => [
                    'resolutionsPerAuthority' => [],
                ],
            ],
        ];

        $intent = new Intent('name', $slots);

        $this->assertTrue(
            $intent->hasValidSlotValue('foo')
        );
        $this->assertFalse(
            $intent->hasValidSlotValue('foobar')
        );
        $this->assertFalse(
            $intent->hasValidSlotValue('bar')
        );
        $this->assertFalse(
            $intent->hasValidSlotValue('bar2')
        );
        $this->assertFalse(
            $intent->hasValidSlotValue('bar3')
        );
    }

    /**
     *
     */
    public function testComplexSlotValueCountWithResolutions(): void
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
                                        'id'   => '123456789abcdefA',
                                    ],
                                ],
                                [
                                    'value' => [
                                        'name' => 'foo123',
                                        'id'   => '123456789abcdefB',
                                    ],
                                ],
                                [
                                    'value' => [
                                        'name' => 'foobar123',
                                        'id'   => '123456789abcdefC',
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
            3,
            $intent->countSlotValues('foo')
        );
    }

    /**
     *
     */
    public function testComplexSlotValuesWithResolutions(): void
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
                                        'id'   => '123456789abcdefA',
                                    ],
                                ],
                                [
                                    'value' => [
                                        'name' => 'foo123',
                                        'id'   => '123456789abcdefB',
                                    ],
                                ],
                                [
                                    'value' => [
                                        'name' => 'foobar123',
                                        'id'   => '123456789abcdefC',
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
            [
                'bar123',
                'foo123',
                'foobar123',
            ],
            $intent->getAllSlotValues('foo')
        );
    }
}
