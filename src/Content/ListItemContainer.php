<?php
/**
 * Build voice applications for Amazon Alexa with phlexa and PHP
 *
 * @author     Meike Ziesecke <m.ziesecke@travello.de>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/phoice/phlexa
 * @link       https://www.phoice.tech/
 * @link       https://www.travello.audio/
 */

namespace Phlexa\Content;

/**
 * Class ListItemContainer
 *
 * @package Phlexa\Content
 */
class ListItemContainer
{
    /**
     * @var string|null
     */
    private $token;

    /**
     * @var string|null
     */
    private $title;

    /**
     * @var string|null
     */
    private $text;

    /**
     * @var string|null
     */
    private $imagePath;

    /**
     * @var string|null
     */
    private $ordinalNumber;

    /**
     * ListItemContainer constructor.
     *
     * @param array $content
     */
    public function __construct(array $content = [])
    {
        foreach ($content as $key => $value) {
            $setMethod = 'set' . str_replace('_', '', ucwords($key, '_'));

            if (method_exists($this, $setMethod)) {
                $this->$setMethod($value);
            }
        }
    }

    /**
     * @return string|null
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * @param mixed $token
     */
    public function setToken($token): void
    {
        $this->token = $token;
    }

    /**
     * @return bool
     */
    public function hasToken(): bool
    {
        return null !== $this->token;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return bool
     */
    public function hasTitle(): bool
    {
        return null !== $this->title;
    }

    /**
     * @return string|null
     */
    public function getText(): ?string
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     */
    public function setText($text): void
    {
        $this->text = $text;
    }

    /**
     * @return bool
     */
    public function hasText(): bool
    {
        return null !== $this->text;
    }


    /**
     * @return string|null
     */
    public function getImagePath(): ?string
    {
        return $this->imagePath;
    }

    /**
     * @param mixed $imagePath
     */
    public function setImagePath($imagePath): void
    {
        $this->imagePath = $imagePath;
    }

    /**
     * @return bool
     */
    public function hasImagePath(): bool
    {
        return null !== $this->imagePath;
    }

    /**
     * @return string|null
     */
    public function getOrdinalNumber(): ?string
    {
        return $this->ordinalNumber;
    }

    /**
     * @param mixed $ordinalNumber
     */
    public function setOrdinalNumber($ordinalNumber): void
    {
        $this->ordinalNumber = $ordinalNumber;
    }

    /**
     * @return bool
     */
    public function hasOrdinalNumber(): bool
    {
        return null !== $this->ordinalNumber;
    }
}

