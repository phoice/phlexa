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
use Phlexa\Response\Directives\Display\Image;
use Phlexa\Response\Directives\Display\RenderTemplate;
use Phlexa\Response\Directives\Display\TextContent;
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
    private function setAlexaRequest(AlexaRequest $alexaRequest): void
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
    private function setAlexaResponse(AlexaResponse $alexaResponse): void
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
    private function setTextHelper(TextHelperInterface $textHelper): void
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
    private function setSkillConfiguration(SkillConfigurationInterface $skillConfiguration): void
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

    /**
     * @return bool
     */
    protected function isAudioPlayerSupported(): bool
    {
        return $this->checkInterface('AudioPlayer');
    }

    /**
     * @return bool
     */
    protected function isDisplaySupported(): bool
    {
        return $this->checkInterface('Display');
    }

    /**
     * @return bool
     */
    protected function isVideoAppSupported(): bool
    {
        return $this->checkInterface('VideoApp');
    }

    /**
     * @param $interface
     *
     * @return bool
     */
    private function checkInterface($interface): bool
    {
        $context = $this->getAlexaRequest()->getContext();

        if (!$context) {
            return false;
        }

        if (!$context->getSystem()) {
            return false;
        }

        if (!$context->getSystem()->getDevice()) {
            return false;
        }

        $supportedInterfaces = $context->getSystem()->getDevice()->getSupportedInterfaces();

        if (!$supportedInterfaces) {
            return false;
        }

        return isset($supportedInterfaces[$interface]);
    }

    /**
     * @param string      $template
     * @param TextContent $textContent
     * @param string      $token
     * @param string|null $smallImageUrl
     * @param string|null $largeImageUrl
     */
    protected function addBodyTemplateDirective(
        string $template,
        TextContent $textContent,
        string $token,
        string $smallImageUrl = null,
        string $largeImageUrl = null
    ): void {
        $skillTitle           = $this->getSkillConfiguration()->getSkillTitle();
        $backgroundImageUrl   = $this->getSkillConfiguration()->getBackgroundImageUrl();
        $backgroundImageTitle = $this->getSkillConfiguration()->getBackgroundImageTitle();

        $backgroundImage = new Image($backgroundImageTitle);
        $backgroundImage->setUrlLarge($backgroundImageUrl);

        $displayDirective = new RenderTemplate($template, $token, $textContent);
        $displayDirective->setTitle($skillTitle);
        $displayDirective->setBackgroundImage($backgroundImage);

        if (in_array($template, [RenderTemplate::TYPE_BODY_TEMPLATE_2, RenderTemplate::TYPE_BODY_TEMPLATE_3], true)) {
            $smallImageUrl = $smallImageUrl ?? $this->getSkillConfiguration()->getSmallImageUrl();
            $largeImageUrl = $largeImageUrl ?? $this->getSkillConfiguration()->getLargeImageUrl();

            $image = new Image($skillTitle);
            $image->setUrlSmall($smallImageUrl);
            $image->setUrlLarge($largeImageUrl);

            $displayDirective->setImage($image);
        }

        $this->getAlexaResponse()->addDirective($displayDirective);
    }
}
