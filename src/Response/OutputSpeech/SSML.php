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

namespace Phlexa\Response\OutputSpeech;

/**
 * Class SSML
 *
 * @package Phlexa\Response\OutputSpeech
 */
class SSML implements OutputSpeechInterface
{
    /** Maximum length of ssml attribute */
    public const MAX_SSML_LENGTH = 6000;

    /** Speech break */
    public const BREAK_OUTPUT = '<break time="1s"/>';

    /** @var string */
    private $ssml;

    /**
     * SSML constructor.
     *
     * @param string $ssml
     */
    public function __construct(string $ssml)
    {
        $this->setSsml($ssml);
    }

    /**
     * Render the output speech object to an array
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'type' => 'SSML',
            'ssml' => $this->ssml,
        ];
    }

    /**
     * @param string $ssml
     */
    private function setSsml(string $ssml)
    {
        if (strlen($ssml) > self::MAX_SSML_LENGTH) {
            $ssml = substr($ssml, 0, self::MAX_SSML_LENGTH);
        }

        $this->ssml = '<speak>' . $ssml . '</speak>';
    }
}
