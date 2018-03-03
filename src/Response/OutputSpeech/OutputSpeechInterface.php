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

namespace Phlexa\Response\OutputSpeech;

/**
 * Interface PlainText
 *
 * @package Phlexa\Response\OutputSpeech
 */
interface OutputSpeechInterface
{
    /**
     * Render the output speech object to an array
     *
     * @return array
     */
    public function toArray(): array;
}
