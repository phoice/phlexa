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

namespace Phlexa\Intent\AudioPlayer;

use Phlexa\Intent\AbstractIntent;
use Phlexa\Response\AlexaResponse;

/**
 * Class PlaybackStoppedIntent
 *
 * @package Phlexa\Intent\AudioPlayer
 */
class PlaybackStoppedIntent extends AbstractIntent
{
    public const NAME = 'AudioPlayer.PlaybackStopped';

    /**
     * @return AlexaResponse
     */
    public function handle(): AlexaResponse
    {
        $this->getAlexaResponse()->endSession();

        return $this->getAlexaResponse();
    }
}
