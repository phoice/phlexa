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

namespace Phlexa\Intent\AudioPlayer;

use Phlexa\Intent\AbstractIntent;
use Phlexa\Response\AlexaResponse;

/**
 * Class PlaybackNearlyFinishedIntent
 *
 * @package Phlexa\Intent\AudioPlayer
 */
class PlaybackNearlyFinishedIntent extends AbstractIntent
{
    const NAME = 'AudioPlayer.PlaybackNearlyFinished';

    /**
     * @return AlexaResponse
     */
    public function handle(): AlexaResponse
    {
        $this->getAlexaResponse()->endSession();

        return $this->getAlexaResponse();
    }
}
