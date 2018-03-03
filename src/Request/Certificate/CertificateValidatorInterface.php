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

namespace Phlexa\Request\Certificate;

use Phlexa\Request\AlexaRequestInterface;
use Phlexa\Request\Exception\BadRequest;

/**
 * Interface CertificateValidatorInterface
 *
 * @package Phlexa\Request\Certificate
 */
interface CertificateValidatorInterface
{
    /**
     * @return AlexaRequestInterface
     */
    public function getAlexaRequest(): AlexaRequestInterface;

    /**
     * @return string
     */
    public function getCertificateUrl(): string;

    /**
     * @return string
     */
    public function getSignature(): string;

    /**
     * @throws BadRequest
     */
    public function validate();
}
