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

namespace Phlexa\Intent\System;

use Phlexa\Intent\AbstractIntent;
use Phlexa\Response\AlexaResponse;

/**
 * Class ExceptionEncountered
 *
 * @package Phlexa\Intent\System
 */
class ExceptionEncountered extends AbstractIntent
{
    const NAME = 'System.ExceptionEncountered';

    /**
     * @return AlexaResponse
     */
    public function handle(): AlexaResponse
    {
        return $this->getAlexaResponse();
    }
}
