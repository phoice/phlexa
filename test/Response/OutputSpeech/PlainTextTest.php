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

use Phlexa\Response\OutputSpeech\PlainText;
use PHPUnit\Framework\TestCase;

/**
 * Class PlainTextTest
 *
 * @package PhlexaTest\Response\OutputSpeech
 */
class PlainTextTest extends TestCase
{
    /**
     *
     */
    public function testInstantiationWithLongValues()
    {
        $outputSpeech = new PlainText(
            str_pad('text', 7000, 'text')
        );

        $expected = [
            'type' => 'PlainText',
            'text' => str_pad('text', 6000, 'text'),
        ];

        $this->assertEquals($expected, $outputSpeech->toArray());
    }

    /**
     *
     */
    public function testInstantiationWithShortValues()
    {
        $outputSpeech = new PlainText('text');

        $expected = [
            'type' => 'PlainText',
            'text' => 'text',
        ];

        $this->assertEquals($expected, $outputSpeech->toArray());
    }
}
