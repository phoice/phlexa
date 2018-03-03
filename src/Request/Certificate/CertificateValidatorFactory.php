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

/**
 * Class CertificateValidatorFactory
 *
 * @package Phlexa\Request\Certificate
 */
class CertificateValidatorFactory
{
    /**
     * @param string                     $certificateUrl
     * @param string                     $signature
     * @param AlexaRequestInterface      $alexaRequest
     * @param CertificateLoaderInterface $certificateLoader
     * @param bool                       $validateSignatureFlag
     *
     * @return CertificateValidator
     */
    public function create(
        string $certificateUrl,
        string $signature,
        AlexaRequestInterface $alexaRequest,
        CertificateLoaderInterface $certificateLoader,
        bool $validateSignatureFlag = true
    ) {
        return new CertificateValidator(
            $certificateUrl,
            $signature,
            $alexaRequest,
            $certificateLoader,
            $validateSignatureFlag
        );
    }
}
