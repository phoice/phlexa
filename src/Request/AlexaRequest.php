<?php
/**
 * Build voice applications for Amazon Alexa with phlexa and PHP
 *
 * @author     Ralf Eggert <ralf@travello.audio>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/phoice/phlexa
 * @link       https://www.phoice.tech/
 *
 */

namespace Phlexa\Request;

use Phlexa\Request\Context\ContextInterface;
use Phlexa\Request\Exception\BadRequest;
use Phlexa\Request\RequestType\RequestTypeInterface;
use Phlexa\Request\Session\SessionInterface;

/**
 * Class AlexaRequest
 *
 * @package Phlexa\Request
 */
class AlexaRequest implements AlexaRequestInterface
{
    const NAME = 'AlexaRequest';
    const DEFAULT_VERSION = '1.0';

    /** @var string */
    private $version = '1.0';

    /** @var SessionInterface */
    private $session;

    /** @var RequestTypeInterface */
    private $request;

    /** @var ContextInterface */
    private $context;

    /** @var string */
    private $rawRequestData;

    /**
     * AlexaRequest constructor.
     *
     * @param string                $version
     * @param RequestTypeInterface  $request
     * @param SessionInterface|null $session
     * @param ContextInterface|null $context
     * @param string                $rawRequestData
     */
    public function __construct(
        string $version,
        RequestTypeInterface $request,
        SessionInterface $session = null,
        ContextInterface $context = null,
        string $rawRequestData
    ) {
        $this->version        = $version;
        $this->request        = $request;
        $this->session        = $session;
        $this->context        = $context;
        $this->rawRequestData = $rawRequestData;
    }

    /**
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * @return RequestTypeInterface
     */
    public function getRequest(): RequestTypeInterface
    {
        return $this->request;
    }

    /**
     * @return SessionInterface
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * @return ContextInterface|null
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * @return string
     */
    public function getRawRequestData(): string
    {
        return $this->rawRequestData;
    }

    /**
     * @param string $applicationId
     *
     * @throws BadRequest
     */
    public function checkApplication(string $applicationId)
    {
        if ($this->getSession()) {
            $requestApplicationId = $this->getSession()->getApplication()->getApplicationId();
        } elseif ($this->getContext()) {
            $requestApplicationId = $this->getContext()->getSystem()->getApplication()->getApplicationId();
        } else {
            throw new BadRequest('Application Id invalid');
        }

        if ($requestApplicationId != $applicationId) {
            throw new BadRequest('Application Id invalid');
        }
    }
}
