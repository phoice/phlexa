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
 * Class TextHelper
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
class TextHelper implements TextHelperInterface
{
    /** @var string */
    protected $locale = 'en-US';

    /** @var array */
    protected $commonTexts = [];

    /**
     * TextHelper constructor.
     *
     * @param array $commonTexts
     */
    public function __construct(array $commonTexts = [])
    {
        $this->commonTexts = array_merge($this->commonTexts, $commonTexts);
    }

    /**
     * Set locale
     *
     * @param string $locale
     */
    public function setLocale(string $locale)
    {
        $this->locale = $locale;
    }

    /**
     * @param $name
     * @param $arguments
     *
     * @return string
     */
    public function __call($name, $arguments)
    {
        $type = lcfirst(str_replace('get', '', $name));

        return $this->getText($type, $arguments);
    }

    /**
     * @param string $type
     * @param array  $arguments
     *
     * @return string
     */
    protected function getText(string $type, array $arguments = [])
    {
        if (!isset($this->commonTexts[$this->locale][$type])) {
            return $type;
        }

        if (is_string($this->commonTexts[$this->locale][$type])) {
            $text = $this->commonTexts[$this->locale][$type];
        } else {
            $randomKey = array_rand($this->commonTexts[$this->locale][$type]);

            $text = $this->commonTexts[$this->locale][$type][$randomKey];
        }

        return vsprintf($text, $arguments);
    }
}
