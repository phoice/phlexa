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

namespace Phlexa\Application;

use Psr\Container\ContainerInterface;
use Phlexa\Intent\HelpIntent;
use Phlexa\Intent\IntentInterface;
use Phlexa\Request\AlexaRequestInterface;
use Phlexa\Request\Exception\BadRequest;
use Phlexa\Request\RequestType\IntentRequestType;
use Phlexa\Response\AlexaResponseInterface;

/**
 * Class AlexaApplication
 *
 * @package Phlexa\Application
 */
class AlexaApplication implements AlexaApplicationInterface
{
    /** @var AlexaRequestInterface */
    protected $alexaRequest;

    /** @var AlexaResponseInterface */
    protected $alexaResponse;

    /** @var ContainerInterface */
    protected $intentManager;

    /**
     * AlexaApplication constructor.
     *
     * @param AlexaRequestInterface  $alexaRequest
     * @param AlexaResponseInterface $alexaResponse
     * @param ContainerInterface     $intentManager
     */
    public function __construct(
        AlexaRequestInterface $alexaRequest,
        AlexaResponseInterface $alexaResponse,
        ContainerInterface $intentManager
    ) {
        $this->alexaRequest  = $alexaRequest;
        $this->alexaResponse = $alexaResponse;
        $this->intentManager = $intentManager;
    }

    /**
     * Execute the application
     *
     * @return array
     * @throws BadRequest
     */
    public function execute(): array
    {
        $this->handleRequest();

        return $this->returnResponse();
    }

    /**
     * Handle the request for all request types
     *
     * @return bool
     */
    protected function handleRequest(): bool
    {
        if (get_class($this->alexaRequest->getRequest()) === IntentRequestType::class) {
            /** @var IntentRequestType $intentRequest */
            $intentRequest = $this->alexaRequest->getRequest();

            $intentName = $intentRequest->getIntent()->getName();
        } else {
            $intentName = $this->alexaRequest->getRequest()->getType();
        }

        if ($this->intentManager->has($intentName)) {
            /** @var IntentInterface $intent */
            $intent = $this->intentManager->get($intentName);
        } else {
            /** @var IntentInterface $intent */
            $intent = $this->intentManager->get(HelpIntent::NAME);
        }

        $intent->handle();

        return true;
    }

    /**
     * Return the rendered alexa response
     *
     * @return array
     */
    protected function returnResponse(): array
    {
        return $this->alexaResponse->toArray();
    }
}
