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

namespace Phlexa\Response\Card;

/**
 * Class Standard
 *
 * @package Phlexa\Response\Card
 */
class Standard implements CardInterface
{
    /** Maximum length of title attribute */
    public const MAX_TITLE_LENGTH = 64;

    /** Maximum length of text attribute */
    public const MAX_TEXT_LENGTH = 6000;

    /** Line break for cards */
    public const BREAK_CARD = "\n \n";

    /** @var string */
    private $text;

    /** @var string */
    private $title;

    /** @var string */
    private $smallImageUrl;

    /** @var string */
    private $largeImageUrl;

    /**
     * Standard constructor.
     *
     * @param string $title
     * @param string $text
     * @param string $smallImageUrl
     * @param string $largeImageUrl
     */
    public function __construct($title, $text, $smallImageUrl, $largeImageUrl)
    {
        $this->setTitle($title);
        $this->setText($text);
        $this->setSmallImageUrl($smallImageUrl);
        $this->setLargeImageUrl($largeImageUrl);
    }

    /**
     * Render the card object to an array
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'type'  => 'Standard',
            'title' => $this->title,
            'text'  => $this->text,
            'image' => [
                'smallFrontImage' => $this->smallImageUrl,
                'largeFrontImage' => $this->largeImageUrl,
            ],
        ];
    }

    /**
     * @param string $title
     */
    private function setTitle($title)
    {
        if (strlen($title) > self::MAX_TITLE_LENGTH) {
            $title = substr($title, 0, self::MAX_TITLE_LENGTH);
        }

        $this->title = $title;
    }

    /**
     * @param string $text
     */
    private function setText($text)
    {
        if (strlen($text) > self::MAX_TEXT_LENGTH) {
            $text = substr($text, 0, self::MAX_TEXT_LENGTH);
        }

        $this->text = $text;
    }

    /**
     * @param string $smallImageUrl
     */
    private function setSmallImageUrl(string $smallImageUrl)
    {
        $this->smallImageUrl = $smallImageUrl;
    }

    /**
     * @param string $largeImageUrl
     */
    private function setLargeImageUrl(string $largeImageUrl)
    {
        $this->largeImageUrl = $largeImageUrl;
    }
}
