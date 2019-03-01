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

namespace PhlexaTest\Response\Directives\AudioPlayer;

use Phlexa\Response\Directives\AudioPlayer\ClearQueue;
use PHPUnit\Framework\TestCase;

/**
 * Class ClearQueueTest
 *
 * @package PhlexaTest\Response\Directives\AudioPlayer;
 */
class ClearQueueTest extends TestCase
{
    /**
     *
     */
    public function testInstantiationClearBehaviourClearEnqueued()
    {
        $directive = new ClearQueue('CLEAR_ENQUEUED');

        $expected = [
            'type'          => 'AudioPlayer.ClearQueue',
            'clearBehavior' => 'CLEAR_ENQUEUED',
        ];

        $this->assertEquals($expected, $directive->toArray());
        $this->assertEquals('AudioPlayer.ClearQueue', $directive->getType());
    }

    /**
     *
     */
    public function testInstantiationClearBehaviourClearAll()
    {
        $directive = new ClearQueue('CLEAR_ALL');

        $expected = [
            'type'          => 'AudioPlayer.ClearQueue',
            'clearBehavior' => 'CLEAR_ALL',
        ];

        $this->assertEquals($expected, $directive->toArray());
        $this->assertEquals('AudioPlayer.ClearQueue', $directive->getType());
    }

    /**
     *
     */
    public function testInstantiationClearBehaviourUnknown()
    {
        $directive = new ClearQueue('UNKNOWN');

        $expected = [
            'type'          => 'AudioPlayer.ClearQueue',
            'clearBehavior' => 'CLEAR_ALL',
        ];

        $this->assertEquals($expected, $directive->toArray());
        $this->assertEquals('AudioPlayer.ClearQueue', $directive->getType());
    }
}
