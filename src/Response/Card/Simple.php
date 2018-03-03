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

namespace Phlexa\Response\Card;

/**
 * Class Simple
 *
 * @package Phlexa\Response\Card
 */
class Simple implements CardInterface
{
    /** Maximum length of title attribute */
    const MAX_TITLE_LENGTH = 64;

    /** Maximum length of content attribute */
    const MAX_CONTENT_LENGTH = 6000;

    /** @var string */
    private $content;

    /** @var string*/
    private $title;

    /**
     * Simple constructor.
     *
     * @param string $title
     * @param string $content
     */
    public function __construct($title, $content)
    {
        $this->setTitle($title);
        $this->setContent($content);
    }

    /**
     * Render the card object to an array
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'type'    => 'Simple',
            'title'   => $this->title,
            'content' => $this->content,
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
     * @param string $content
     */
    private function setContent($content)
    {
        if (strlen($content) > self::MAX_CONTENT_LENGTH) {
            $content = substr($content, 0, self::MAX_CONTENT_LENGTH);
        }

        $this->content = $content;
    }
}
