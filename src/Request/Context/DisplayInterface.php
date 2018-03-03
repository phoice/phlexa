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
 * Interface DisplayInterface
 *
 * @package Phlexa\Request\Context
 */
interface DisplayInterface
{
    /**
     * @return string
     */
    public function getTemplateVersion();

    /**
     * @param string $templateVersion
     */
    public function setTemplateVersion(string $templateVersion);

    /**
     * @return string
     */
    public function getMarkupVersion();

    /**
     * @param string $markupVersion
     */
    public function setMarkupVersion(string $markupVersion);

    /**
     * @return string
     */
    public function getToken();

    /**
     * @param string $token
     */
    public function setToken(string $token);
}
