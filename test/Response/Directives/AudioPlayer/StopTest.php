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

use PHPUnit\Framework\TestCase;
use Phlexa\Response\Directives\AudioPlayer\Stop;

/**
 * Class StopTest
 *
 * @package PhlexaTest\Response\Directives\AudioPlayer;
 */
class StopTest extends TestCase
{
    /**
     *
     */
    public function testInstantiation()
    {
        $directive = new Stop();

        $expected = [
            'type' => 'AudioPlayer.Stop',
        ];

        $this->assertEquals($expected, $directive->toArray());
        $this->assertEquals('AudioPlayer.Stop', $directive->getType());
    }
}
