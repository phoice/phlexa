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

namespace Phlexa\Request\Session;

/**
 * Interface Application
 *
 * @package Phlexa\Request\Session
 */
interface ApplicationInterface
{
    /**
     * @return string
     */
    public function getApplicationId();
}
