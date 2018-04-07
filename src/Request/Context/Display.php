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
 * Class Display
 *
 * @package Phlexa\Request\Context
 */
class Display implements DisplayInterface
{
    /** @var string */
    private $templateVersion;

    /** @var string */
    private $markupVersion;

    /** @var string */
    private $token;

    /**
     * @return string
     */
    public function getTemplateVersion()
    {
        return $this->templateVersion;
    }

    /**
     * @param string $templateVersion
     */
    public function setTemplateVersion(string $templateVersion): void
    {
        $this->templateVersion = $templateVersion;
    }

    /**
     * @return string
     */
    public function getMarkupVersion()
    {
        return $this->markupVersion;
    }

    /**
     * @param string $markupVersion
     */
    public function setMarkupVersion(string $markupVersion): void
    {
        $this->markupVersion = $markupVersion;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param string $token
     */
    public function setToken(string $token): void
    {
        $this->token = $token;
    }
}
