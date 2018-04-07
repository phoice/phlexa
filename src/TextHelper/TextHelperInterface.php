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

namespace Phlexa\TextHelper;

/**
 * Interface TextHelper
 *
 * @package Phlexa\TextHelper
 *
 * @method string getHelpMessage()
 * @method string getHelpTitle()
 * @method string getLaunchMessage()
 * @method string getLaunchTitle()
 * @method string getRepromptMessage()
 * @method string getCancelMessage()
 * @method string getCancelTitle()
 * @method string getStopMessage()
 * @method string getStopTitle()
 */
interface TextHelperInterface
{
    /**
     * Set locale
     *
     * @param string $locale
     */
    public function setLocale(string $locale);
}
