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

namespace Phlexa\Request;

use Phlexa\Request\Context\ContextInterface;
use Phlexa\Request\Exception\BadRequest;
use Phlexa\Request\RequestType\RequestTypeInterface;
use Phlexa\Request\Session\SessionInterface;

/**
 * Interface AlexaRequest
 *
 * @package Phlexa\Request
 */
interface AlexaRequestInterface
{
    /**
     * @param string $applicationId
     *
     * @throws BadRequest
     */
    public function checkApplication(string $applicationId);

    /**
     * @return string
     */
    public function getVersion(): string;

    /**
     * @return RequestTypeInterface
     */
    public function getRequest(): RequestTypeInterface;

    /**
     * @return SessionInterface
     */
    public function getSession();

    /**
     * @return ContextInterface|null
     */
    public function getContext();

    /**
     * @return string
     */
    public function getRawRequestData(): string;
}
