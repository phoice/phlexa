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

namespace PhlexaTest\Response\OutputSpeech;

use Phlexa\Response\OutputSpeech\SSML;
use PHPUnit\Framework\TestCase;

/**
 * Class SSMLTest
 *
 * @package PhlexaTest\Response\OutputSpeech
 */
class SSMLTest extends TestCase
{
    /**
     *
     */
    public function testInstantiationWithLongValues()
    {
        $outputSpeech = new SSML(
            str_pad('ssml', 7000, 'ssml')
        );

        $expected = [
            'type' => 'SSML',
            'ssml' => '<speak>' . str_pad('ssml', 6000, 'ssml') . '</speak>',
        ];

        $this->assertEquals($expected, $outputSpeech->toArray());
    }

    /**
     *
     */
    public function testInstantiationWithShortValues()
    {
        $outputSpeech = new SSML('ssml');

        $expected = [
            'type' => 'SSML',
            'ssml' => '<speak>ssml</speak>',
        ];

        $this->assertEquals($expected, $outputSpeech->toArray());
    }
}
