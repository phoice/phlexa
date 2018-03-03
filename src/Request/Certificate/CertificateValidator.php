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

use DateTime;
use Phlexa\Request\AlexaRequestInterface;
use Phlexa\Request\Exception\BadRequest;
use URL\Normalizer;
use Zend\Diactoros\Uri;

/**
 * Class CertificateValidator
 *
 * @package Phlexa\Request\Certificate
 */
class CertificateValidator implements CertificateValidatorInterface
{
    const NAME = 'CertificateValidator';

    /** maximum difference in seconds for timestamp */
    const MAX_TIMESTAMP_DIFFERENCE = 140;

    /** allowed scheme for certificate url */
    const ALLOWED_SCHEME = 'https';

    /** allowed scheme for certificate host */
    const ALLOWED_HOST = 's3.amazonaws.com';

    /** allowed scheme for certificate port */
    const ALLOWED_PORT = '443';

    /** allowed scheme for certificate path */
    const ALLOWED_PATH = '/echo.api';

    /** host for amazon echo API */
    const ECHO_API_AMAZON_COM = 'echo-api.amazon.com';

    /** @var AlexaRequestInterface */
    private $alexaRequest;

    /** @var CertificateLoaderInterface */
    private $certificateLoader;

    /** @var string */
    private $certificateUrl;

    /** @var array */
    private $parsedCertificate;

    /** @var string */
    private $rawCertificate;

    /** @var string */
    private $signature;

    /** @var boolean */
    private $validateSignatureFlag = true;

    /**
     * CertificateValidator constructor.
     *
     * @param string                     $certificateUrl
     * @param string                     $signature
     * @param AlexaRequestInterface      $alexaRequest
     * @param CertificateLoaderInterface $certificateLoader
     * @param bool                       $validateSignatureFlag
     */
    public function __construct(
        string $certificateUrl,
        string $signature,
        AlexaRequestInterface $alexaRequest,
        CertificateLoaderInterface $certificateLoader,
        bool $validateSignatureFlag = true
    ) {
        $this->certificateUrl        = $certificateUrl;
        $this->signature             = $signature;
        $this->alexaRequest          = $alexaRequest;
        $this->certificateLoader     = $certificateLoader;
        $this->validateSignatureFlag = $validateSignatureFlag;
    }

    /**
     * @return string
     */
    public function getCertificateUrl(): string
    {
        return $this->certificateUrl;
    }

    /**
     * @return string
     */
    public function getSignature(): string
    {
        return $this->signature;
    }

    /**
     * @return AlexaRequestInterface
     */
    public function getAlexaRequest(): AlexaRequestInterface
    {
        return $this->alexaRequest;
    }

    /**
     * @throws BadRequest
     */
    public function validate()
    {
        $this->validateRequestTimestamp();
        $this->validateCertificateUrl();
        $this->validateCertificateParams();
        $this->validateRequestSignature();
    }

    /**
     * Validate the request timestamp
     *
     * @throws BadRequest
     */
    private function validateRequestTimestamp()
    {
        if (strtotime($this->alexaRequest->getRequest()->getTimestamp())) {
            $timestamp = $this->alexaRequest->getRequest()->getTimestamp();
        } else {
            $timestamp = '@' . substr($this->alexaRequest->getRequest()->getTimestamp(), 0, 10);
        }

        $currentTime = new DateTime();
        $requestTime = new DateTime($timestamp);

        $diff = $requestTime->getTimestamp() - $currentTime->getTimestamp();

        if ($diff >= self::MAX_TIMESTAMP_DIFFERENCE) {
            throw new BadRequest('Invalid timestamp');
        };
    }

    /**
     * Validate the certificate Url
     *
     * @throws BadRequest
     */
    private function validateCertificateUrl()
    {
        $urlNormalizer = new Normalizer($this->certificateUrl);

        $certificateUrl = new Uri($urlNormalizer->normalize());

        $allowedPorts = [self::ALLOWED_PORT, null];

        if ($certificateUrl->getScheme() !== self::ALLOWED_SCHEME) {
            throw new BadRequest('Invalid certificate url scheme');
        } elseif ($certificateUrl->getHost() !== self::ALLOWED_HOST) {
            throw new BadRequest('Invalid certificate url host');
        } elseif (!in_array($certificateUrl->getPort(), $allowedPorts)) {
            throw new BadRequest('Invalid certificate url port');
        } elseif (dirname($certificateUrl->getPath()) !== self::ALLOWED_PATH) {
            throw new BadRequest('Invalid certificate url path');
        }
    }

    /**
     * Validate the certificate
     *
     * @throws BadRequest
     */
    private function validateCertificateParams()
    {
        $this->loadCertificate();
        $this->parseCertificate();
        $this->validateCertificateDate();
        $this->validateCertificateSan();
    }

    /**
     *
     */
    private function loadCertificate()
    {
        $this->rawCertificate = $this->certificateLoader->load(
            $this->certificateUrl
        );
    }

    /**
     *
     */
    private function parseCertificate()
    {
        $this->parsedCertificate = openssl_x509_parse($this->rawCertificate);
    }

    /**
     * @throws BadRequest
     */
    private function validateCertificateDate()
    {
        $currentTime = new DateTime();

        $fromTime = new DateTime();
        $fromTime->setTimestamp($this->parsedCertificate['validFrom_time_t']);

        $toTime = new DateTime();
        $toTime->setTimestamp($this->parsedCertificate['validTo_time_t']);

        if ($currentTime <= $fromTime) {
            throw new BadRequest('Invalid certificate from date');
        } elseif ($currentTime >= $toTime) {
            throw new BadRequest('Invalid certificate to date');
        }
    }

    /**
     * @throws BadRequest
     */
    private function validateCertificateSan()
    {
        $check = strpos(
            $this->parsedCertificate['extensions']['subjectAltName'],
            self::ECHO_API_AMAZON_COM
        );

        if ($check === false) {
            throw new BadRequest('Invalid certificate SAN');
        }
    }

    /**
     * @throws BadRequest
     */
    private function validateRequestSignature()
    {
        if (!$this->validateSignatureFlag) {
            return true;
        }

        $certKey = openssl_pkey_get_public($this->rawCertificate);

        $valid = openssl_verify(
            $this->alexaRequest->getRawRequestData(),
            base64_decode($this->signature),
            $certKey,
            'sha1WithRSAEncryption'
        );

        if (!$valid) {
            throw new BadRequest('Invalid request signature');
        }
    }
}
