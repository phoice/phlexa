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

namespace Phlexa\Request\Context;

/**
 * Class Context
 *
 * @package Phlexa\Request\Context
 */
class Context implements ContextInterface
{
    /** @var AudioPlayerInterface */
    private $audioPlayer;

    /** @var SystemInterface */
    private $system;

    /** @var DisplayInterface */
    private $display;

    /** @var ViewportInterface */
    private $viewport;

    /**
     * @param AudioPlayerInterface $audioPlayer
     */
    public function setAudioPlayer(AudioPlayerInterface $audioPlayer): void
    {
        $this->audioPlayer = $audioPlayer;
    }

    /**
     * @return AudioPlayerInterface
     */
    public function getAudioPlayer()
    {
        return $this->audioPlayer;
    }

    /**
     * @param SystemInterface $system
     */
    public function setSystem(SystemInterface $system): void
    {
        $this->system = $system;
    }

    /**
     * @return SystemInterface|null
     */
    public function getSystem()
    {
        return $this->system;
    }

    /**
     * @param DisplayInterface $display
     */
    public function setDisplay(DisplayInterface $display): void
    {
        $this->display = $display;
    }

    /**
     * @return DisplayInterface
     */
    public function getDisplay()
    {
        return $this->display;
    }

    /**
     * @return ViewportInterface
     */
    public function getViewport(): ?ViewportInterface
    {
        return $this->viewport;
    }

    /**
     * @param ViewportInterface $viewport
     */
    public function setViewport(ViewportInterface $viewport): void
    {
        $this->viewport = $viewport;
    }


}
