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

namespace Phlexa\Response\Directives\Display;

/**
 * Class ListItem
 *
 * @package Phlexa\Response\Directives\Display
 */
class ListItem
{
    /** @var string */
    private $token;

    /** @var TextContent */
    private $textContent;

    /** @var Image */
    private $image;

    /**
     * @param string $token
     */
    public function setToken(string $token): void
    {
        $this->token = $token;
    }

    /**
     * @param TextContent $textContent
     */
    public function setTextContent(TextContent $textContent): void
    {
        $this->textContent = $textContent;
    }

    /**
     * @param Image $image
     */
    public function setImage(Image $image): void
    {
        $this->image = $image;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $data = [];

        if ($this->token) {
            $data['token'] = $this->token;
        }

        if ($this->textContent) {
            $data['textContent'] = $this->textContent->toArray();
        }

        if ($this->image) {
            $data['image'] = $this->image->toArray();
        }

        return $data;
    }
}
