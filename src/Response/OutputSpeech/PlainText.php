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

namespace Phlexa\Response\OutputSpeech;

/**
 * Class PlainText
 *
 * @package Phlexa\Response\OutputSpeech
 */
class PlainText implements OutputSpeechInterface
{
    /** Maximum length of text attribute */
    public const MAX_TEXT_LENGTH = 6000;

    /** @var string */
    private $text;

    /**
     * PlainText constructor.
     *
     * @param string $text
     */
    public function __construct(string $text)
    {
        $this->setText($text);
    }

    /**
     * Render the output speech object to an array
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'type' => 'PlainText',
            'text' => $this->text,
        ];
    }

    /**
     * @param string $text
     */
    private function setText(string $text)
    {
        if (strlen($text) > self::MAX_TEXT_LENGTH) {
            $text = substr($text, 0, self::MAX_TEXT_LENGTH);
        }

        $this->text = $text;
    }
}
