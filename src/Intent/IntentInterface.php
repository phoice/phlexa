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

namespace Phlexa\Intent;

use Phlexa\Response\AlexaResponse;

/**
 * Interface IntentInterface
 *
 * @package Phlexa\Intent
 */
interface IntentInterface
{
    /**
     * @return AlexaResponse
     */
    public function handle(): AlexaResponse;
}
