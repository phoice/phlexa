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

namespace Phlexa\Request\Certificate;

use Curl\Curl;

/**
 * Class CertificateLoader
 *
 * @package Phlexa\Request\Certificate
 */
class CertificateLoader implements CertificateLoaderInterface
{
    /** @var string */
    private $cacheDir = '/tmp';

    /** @var bool */
    private $cacheFlag = false;

    /**
     * CertificateLoader constructor.
     *
     * @param bool   $cacheFlag
     * @param string $cacheDir
     */
    public function __construct(bool $cacheFlag = false, string $cacheDir = null)
    {
        $this->cacheFlag = $cacheFlag;
        $this->cacheDir  = $cacheDir;
    }

    /**
     * @param string $certificateUrl
     *
     * @return string
     * @throws \ErrorException
     */
    public function load(string $certificateUrl): string
    {
        if (!$this->cacheFlag) {
            return $this->fetchCertificate($certificateUrl);
        }

        if ($certificate = $this->loadCertificateFromCache($certificateUrl)) {
            return $certificate;
        }

        $certificate = $this->fetchCertificate($certificateUrl);

        $this->cacheCertificate($certificateUrl, $certificate);

        return $certificate;
    }

    /**
     * @param string $certificateUrl
     *
     * @return string
     * @throws \ErrorException
     */
    private function fetchCertificate(string $certificateUrl): string
    {
        $curl = new Curl();
        $curl->setOpt(CURLOPT_RETURNTRANSFER, true);
        $curl->get($certificateUrl);

        return $curl->response;
    }

    /**
     * @param string $certificateUrl
     *
     * @return bool|string
     */
    private function loadCertificateFromCache(string $certificateUrl)
    {
        $cacheFileName = $this->getCacheFileName($certificateUrl);

        if (!file_exists($cacheFileName)) {
            return false;
        }

        return file_get_contents($cacheFileName);
    }

    /**
     * @param string $certificateUrl
     * @param string $certificate
     */
    private function cacheCertificate(
        string $certificateUrl,
        string $certificate
    ): void {
        $cacheFileName = $this->getCacheFileName($certificateUrl);

        file_put_contents($cacheFileName, $certificate);
    }

    /**
     * @param string $certificateUrl
     *
     * @return string
     */
    private function getCacheFileName(string $certificateUrl): string
    {
        return $this->cacheDir . '/' . basename($certificateUrl);
    }
}
