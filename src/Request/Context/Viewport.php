<?php


namespace Phlexa\Request\Context;

use Phlexa\Request\Context\Viewport\ExperiencesInterface;
use Phlexa\Request\Context\Viewport\VideoInterface;

class Viewport implements ViewportInterface
{

    /** @var ExperiencesInterface */
    private $experiences;

    /** @var string */
    private $shape;

    /** @var integer */
    private $pixelWidth;

    /** @var integer */
    private $pixelHeight;

    /** @var integer */
    private $dpi;

    /** @var integer */
    private $currentPixelWidth;

    /** @var integer */
    private $currentPixelHeight;

    /** @var array  */
    private $touch = [];

    /** @var array  */
    private $keyboard = [];

    /** @var VideoInterface */
    private $video;

    /**
     * Viewport constructor.
     *
     * @param ExperiencesInterface $experiences
     * @param string              $shape
     * @param int                 $pixelWidth
     * @param int                 $pixelHeight
     * @param int                 $dpi
     * @param int                 $currentPixelWidth
     * @param int                 $currentPixelHeight
     * @param array               $touch
     * @param array               $keyboard
     * @param VideoInterface      $video
     */
    public function __construct(
        ExperiencesInterface $experiences = null, string $shape, int $pixelWidth, int $pixelHeight, int $dpi,
        int $currentPixelWidth, int $currentPixelHeight, array $touch, array $keyboard, VideoInterface $video = null
    ) {
        $this->experiences        = $experiences;
        $this->shape              = $shape;
        $this->pixelWidth         = $pixelWidth;
        $this->pixelHeight        = $pixelHeight;
        $this->dpi                = $dpi;
        $this->currentPixelWidth  = $currentPixelWidth;
        $this->currentPixelHeight = $currentPixelHeight;
        $this->touch              = $touch;
        $this->keyboard           = $keyboard;
        $this->video              = $video;
    }

    /**
     * @return ExperiencesInterface
     */
    public function getExperiences(): ExperiencesInterface
    {
        return $this->experiences;
    }

    /**
     * @return string
     */
    public function getShape(): string
    {
        return $this->shape;
    }

    /**
     * @return int
     */
    public function getPixelWidth(): int
    {
        return $this->pixelWidth;
    }

    /**
     * @return int
     */
    public function getPixelHeight(): int
    {
        return $this->pixelHeight;
    }

    /**
     * @return int
     */
    public function getDpi(): int
    {
        return $this->dpi;
    }

    /**
     * @return int
     */
    public function getCurrentPixelWidth(): int
    {
        return $this->currentPixelWidth;
    }

    /**
     * @return int
     */
    public function getCurrentPixelHeight(): int
    {
        return $this->currentPixelHeight;
    }

    /**
     * @return array
     */
    public function getTouch(): array
    {
        return $this->touch;
    }

    /**
     * @return array
     */
    public function getKeyboard(): array
    {
        return $this->keyboard;
    }

    /**
     * @return VideoInterface
     */
    public function getVideo(): ?VideoInterface
    {
        return $this->video;
    }


}