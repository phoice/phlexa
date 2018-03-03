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

namespace Phlexa\Intent;

use Phlexa\Configuration\SkillConfigurationInterface;
use Phlexa\TextHelper\TextHelperInterface;
use Phlexa\Request\AlexaRequest;
use Phlexa\Response\AlexaResponse;

/**
 * Class AbstractIntent
 *
 * @package Phlexa\Intent
 */
abstract class AbstractIntent implements IntentInterface
{
    /** @var AlexaRequest */
    private $alexaRequest;

    /** @var AlexaResponse */
    private $alexaResponse;

    /** @var TextHelperInterface */
    private $textHelper;

    /** @var SkillConfigurationInterface */
    private $skillConfiguration;

    /**
     * AbstractIntent constructor.
     *
     * @param AlexaRequest                $alexaRequest
     * @param AlexaResponse               $alexaResponse
     * @param TextHelperInterface         $textHelper
     * @param SkillConfigurationInterface $skillConfiguration
     */
    public function __construct(
        AlexaRequest $alexaRequest,
        AlexaResponse $alexaResponse,
        TextHelperInterface $textHelper,
        SkillConfigurationInterface $skillConfiguration
    ) {
        $this->setAlexaRequest($alexaRequest);
        $this->setAlexaResponse($alexaResponse);
        $this->setTextHelper($textHelper);
        $this->setSkillConfiguration($skillConfiguration);
    }

    /**
     * @param AlexaRequest $alexaRequest
     */
    private function setAlexaRequest(AlexaRequest $alexaRequest)
    {
        $this->alexaRequest = $alexaRequest;
    }

    /**
     * @return AlexaRequest
     */
    protected function getAlexaRequest(): AlexaRequest
    {
        return $this->alexaRequest;
    }

    /**
     * @param AlexaResponse $alexaResponse
     */
    private function setAlexaResponse(AlexaResponse $alexaResponse)
    {
        $this->alexaResponse = $alexaResponse;
    }

    /**
     * @return AlexaResponse
     */
    protected function getAlexaResponse(): AlexaResponse
    {
        return $this->alexaResponse;
    }

    /**
     * @param TextHelperInterface $textHelper
     */
    private function setTextHelper(TextHelperInterface $textHelper)
    {
        $this->textHelper = $textHelper;
    }

    /**
     * @return TextHelperInterface
     */
    protected function getTextHelper(): TextHelperInterface
    {
        return $this->textHelper;
    }

    /**
     * @param SkillConfigurationInterface $skillConfiguration
     */
    private function setSkillConfiguration(SkillConfigurationInterface $skillConfiguration)
    {
        $this->skillConfiguration = $skillConfiguration;
    }

    /**
     * @return SkillConfigurationInterface
     */
    protected function getSkillConfiguration(): SkillConfigurationInterface
    {
        return $this->skillConfiguration;
    }
}
