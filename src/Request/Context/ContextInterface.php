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

namespace Phlexa\Request\Context;

/**
 * Interface Context
 *
 * @package Phlexa\Request\Context
 */
interface ContextInterface
{
    /**
     * @param AudioPlayerInterface $audioPlayer
     */
    public function setAudioPlayer(AudioPlayerInterface $audioPlayer);

    /**
     * @return AudioPlayerInterface
     */
    public function getAudioPlayer();

    /**
     * @param SystemInterface $system
     */
    public function setSystem(SystemInterface $system);

    /**
     * @return SystemInterface|null
     */
    public function getSystem();

    /**
     * @param DisplayInterface $display
     */
    public function setDisplay(DisplayInterface $display);

    /**
     * @return DisplayInterface
     */
    public function getDisplay();
}
