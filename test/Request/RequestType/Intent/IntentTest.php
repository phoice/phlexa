<?php
/**
 * Build voice applications for Amazon Alexa with phlexa and PHP
 *
 * @author     Ralf Eggert <ralf@travello.audio>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/phoice/phlexa
 * @link       https://www.phoice.tech/
 *
 */

namespace PhlexaTest\Request\RequestType\Intent;

use PHPUnit\Framework\TestCase;
use Phlexa\Request\RequestType\Intent\Intent;

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
    public function testInstantiation()
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
    public function testSingleSlotValue()
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
}
