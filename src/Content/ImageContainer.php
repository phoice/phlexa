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

namespace Phlexa\Content;

/**
 * Class ImageContainer
 *
 * @package Phlexa\Content
 */
class ImageContainer
{
    /** @var string|null */
    private $imageId;

    /** @var string|null */
    private $imageTitle;

    /** @var string|null */
    private $hintText;

    /** @var string|null */
    private $path;

    /** @var string|null */
    private $smallFrontImage;

    /** @var string|null */
    private $largeFrontImage;

    /** @var string|null */
    private $roundBackgroundImage;

    /** @var string|null */
    private $smallBackgroundImage;

    /** @var string|null */
    private $mediumBackgroundImage;

    /** @var string|null */
    private $largeBackgroundImage;

    /** @var string|null */
    private $extraLargeBackgroundImage;

    /**
     * ImageContainer constructor.
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
    public function getImageId(): ?string
    {
        return $this->imageId;
    }

    /**
     * @param string|null $imageId
     */
    public function setImageId(?string $imageId): void
    {
        $this->imageId = $imageId;
    }

    /**
     * @return bool
     */
    public function hasImageId(): bool
    {
        return null !== $this->imageId;
    }

    /**
     * @return string|null
     */
    public function getImageTitle(): ?string
    {
        return $this->imageTitle;
    }

    /**
     * @param string|null $imageTitle
     */
    public function setImageTitle(?string $imageTitle): void
    {
        $this->imageTitle = $imageTitle;
    }

    /**
     * @return bool
     */
    public function hasImageTitle(): bool
    {
        return null !== $this->imageTitle;
    }

    /**
     * @return string|null
     */
    public function getHintText(): ?string
    {
        return $this->hintText;
    }

    /**
     * @param string|null $hintText
     */
    public function setHintText(?string $hintText): void
    {
        $this->hintText = $hintText;
    }

    /**
     * @return bool
     */
    public function hasHintText(): bool
    {
        return null !== $this->hintText;
    }

    /**
     * @return string|null
     */
    public function getPath(): ?string
    {
        return $this->path;
    }

    /**
     * @param string|null $path
     */
    public function setPath(?string $path): void
    {
        $this->path = $path;
    }

    /**
     * @return bool
     */
    public function hasPath(): bool
    {
        return null !== $this->path;
    }

    /**
     * @return string|null
     */
    public function getSmallFrontImage(): ?string
    {
        return $this->smallFrontImage;
    }

    /**
     * @param string|null $smallFrontImage
     */
    public function setSmallFrontImage(?string $smallFrontImage): void
    {
        $this->smallFrontImage = $smallFrontImage;
    }

    /**
     * @return bool
     */
    public function hasSmallFrontImage(): bool
    {
        return null !== $this->smallFrontImage;
    }

    /**
     * @return string|null
     */
    public function getLargeFrontImage(): ?string
    {
        return $this->largeFrontImage;
    }

    /**
     * @param string|null $largeFrontImage
     */
    public function setLargeFrontImage(?string $largeFrontImage): void
    {
        $this->largeFrontImage = $largeFrontImage;
    }

    /**
     * @return bool
     */
    public function hasLargeFrontImage(): bool
    {
        return null !== $this->largeFrontImage;
    }

    /**
     * @return string|null
     */
    public function getRoundBackgroundImage(): ?string
    {
        return $this->roundBackgroundImage;
    }

    /**
     * @param string|null $roundBackgroundImage
     */
    public function setRoundBackgroundImage(?string $roundBackgroundImage): void
    {
        $this->roundBackgroundImage = $roundBackgroundImage;
    }

    /**
     * @return bool
     */
    public function hasRoundBackgroundImage(): bool
    {
        return null !== $this->roundBackgroundImage;
    }

    /**
     * @return string|null
     */
    public function getSmallBackgroundImage(): ?string
    {
        return $this->smallBackgroundImage;
    }

    /**
     * @param string|null $smallBackgroundImage
     */
    public function setSmallBackgroundImage(?string $smallBackgroundImage): void
    {
        $this->smallBackgroundImage = $smallBackgroundImage;
    }

    /**
     * @return bool
     */
    public function hasSmallBackgroundImage(): bool
    {
        return null !== $this->smallBackgroundImage;
    }

    /**
     * @return string|null
     */
    public function getMediumBackgroundImage(): ?string
    {
        return $this->mediumBackgroundImage;
    }

    /**
     * @param string|null $mediumBackgroundImage
     */
    public function setMediumBackgroundImage(?string $mediumBackgroundImage): void
    {
        $this->mediumBackgroundImage = $mediumBackgroundImage;
    }

    /**
     * @return bool
     */
    public function hasMediumBackgroundImage(): bool
    {
        return null !== $this->mediumBackgroundImage;
    }

    /**
     * @return string|null
     */
    public function getLargeBackgroundImage(): ?string
    {
        return $this->largeBackgroundImage;
    }

    /**
     * @param string|null $largeBackgroundImage
     */
    public function setLargeBackgroundImage(?string $largeBackgroundImage): void
    {
        $this->largeBackgroundImage = $largeBackgroundImage;
    }

    /**
     * @return bool
     */
    public function hasLargeBackgroundImage(): bool
    {
        return null !== $this->largeBackgroundImage;
    }

    /**
     * @return string|null
     */
    public function getExtraLargeBackgroundImage(): ?string
    {
        return $this->extraLargeBackgroundImage;
    }

    /**
     * @param string|null $extraLargeBackgroundImage
     */
    public function setExtraLargeBackgroundImage(?string $extraLargeBackgroundImage): void
    {
        $this->extraLargeBackgroundImage = $extraLargeBackgroundImage;
    }

    /**
     * @return bool
     */
    public function hasExtraLargeBackgroundImage(): bool
    {
        return null !== $this->extraLargeBackgroundImage;
    }
}
