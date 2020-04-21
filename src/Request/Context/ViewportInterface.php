<?php


namespace Phlexa\Request\Context;


use Phlexa\Request\Context\Viewport\ExperiencesInterface;
use Phlexa\Request\Context\Viewport\VideoInterface;

/**
 * Interface ViewportInterface
 *
 * @package Phlexa\Request\Context
 */
interface ViewportInterface
{
    /**
     * @return ExperiencesInterface
     */
    public function getExperiences(): ExperiencesInterface;
    /**
     * @return string
     */
    public function getShape(): string;

    /**
     * @return int
     */
    public function getPixelWidth(): int;

    /**
     * @return int
     */
    public function getPixelHeight(): int;

    /**
     * @return int
     */
    public function getDpi(): int;

    /**
     * @return int
     */
    public function getCurrentPixelWidth(): int;

    /**
     * @return int
     */
    public function getCurrentPixelHeight(): int;

    /**
     * @return array
     */
    public function getTouch(): array;

    /**
     * @return array
     */
    public function getKeyboard(): array;

    /**
     * @return VideoInterface
     */
    public function getVideo(): ?VideoInterface;
}