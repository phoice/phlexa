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
 * Class SlideShowContainer
 *
 * @package Phlexa\Content
 */
class SlideShowContainer extends BodyContainer
{
    /** @var ImageContainer[] */
    private $slideImages = [];

    /**
     * @return ImageContainer[]
     */
    public function getSlideImages(): array
    {
        return $this->slideImages;
    }

    /**
     * @param ImageContainer[] $slideImages
     */
    public function setSlideImages(array $slideImages): void
    {
        $this->slideImages = $slideImages;
    }

    /**
     * @return bool
     */
    public function hasSlideImages(): bool
    {
        return !empty($this->slideImages);
    }
}
