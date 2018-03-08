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
use Phlexa\Response\Directives\AudioPlayer\ClearQueue;

/**
 * Class PlaybackStartedIntent
 *
 * @package Phlexa\Intent\AudioPlayer
 */
class PlaybackStartedIntent extends AbstractIntent
{
    public const NAME = 'AudioPlayer.PlaybackStarted';

    /**
     * @return AlexaResponse
     */
    public function handle(): AlexaResponse
    {
        $this->getAlexaResponse()->addDirective(
            new ClearQueue(ClearQueue::CLEAR_BEHAVIOR_CLEAR_ENQUEUED)
        );

        $this->getAlexaResponse()->endSession();

        return $this->getAlexaResponse();
    }
}
