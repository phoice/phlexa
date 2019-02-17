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

namespace Phlexa\Intent;

use Phlexa\Configuration\SkillConfigurationInterface;
use Phlexa\Content\BodyContainer;
use Phlexa\Request\AlexaRequest;
use Phlexa\Response\AlexaResponse;
use Phlexa\Response\Card\Standard;
use Phlexa\Response\Directives\Alexa\Presentation\APL\RenderDocument;
use Phlexa\Response\Directives\Display\Image;
use Phlexa\Response\Directives\Display\RenderTemplate;
use Phlexa\Response\Directives\Display\TextContent;
use Phlexa\Response\OutputSpeech\SSML;
use Phlexa\TextHelper\TextHelperInterface;

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
    protected function isAplSupported(): bool
    {
        return $this->checkInterface('Alexa.Presentation.APL');
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
     *
     * @deprecated use renderBodyContainer() method instead
     */
    protected function addBodyTemplateDirective(
        string $template,
        TextContent $textContent,
        string $token,
        string $smallImageUrl = null,
        string $largeImageUrl = null
    ): void {
        $skillTitle           = $this->getSkillConfiguration()->getSkillTitle();
        $backgroundImageUrl   = $this->getSkillConfiguration()->getMediumBackgroundImage();
        $backgroundImageTitle = $this->getSkillConfiguration()->getImageTitle();

        $backgroundImage = new Image($backgroundImageTitle);
        $backgroundImage->setUrlLarge($backgroundImageUrl);

        $displayDirective = new RenderTemplate($template, $token, $textContent);
        $displayDirective->setTitle($skillTitle);
        $displayDirective->setBackgroundImage($backgroundImage);

        if (in_array($template, [RenderTemplate::TYPE_BODY_TEMPLATE_2, RenderTemplate::TYPE_BODY_TEMPLATE_3], true)) {
            $smallImageUrl = $smallImageUrl ?? $this->getSkillConfiguration()->getSmallFrontImage();
            $largeImageUrl = $largeImageUrl ?? $this->getSkillConfiguration()->getLargeFrontImage();

            $image = new Image($skillTitle);
            $image->setUrlSmall($smallImageUrl);
            $image->setUrlLarge($largeImageUrl);

            $displayDirective->setImage($image);
        }

        $this->getAlexaResponse()->addDirective($displayDirective);
    }

    /**
     * @param BodyContainer $container
     */
    protected function renderBodyContainer(BodyContainer $container): void
    {
        if ($container->hasOutputSpeech()) {
            $this->getAlexaResponse()->setOutputSpeech(
                new SSML($container->getOutputSpeech())
            );
        }

        if ($container->hasRepromptSpeech()) {
            $this->getAlexaResponse()->setReprompt(
                new SSML($container->getRepromptSpeech())
            );
        }

        if ($container->hasApl() && $container->hasAplDocument() && $this->isAplSupported()) {
            $this->renderAplTemplate($container);
        } elseif ($container->hasDisplay() && $container->hasDisplayTemplate() && $this->isDisplaySupported()) {
            $this->renderDisplayTemplate($container);
        } elseif ($container->hasCard()) {
            $this->renderCard($container);
        }
    }

    /**
     * @param BodyContainer $container
     */
    protected function renderCard(BodyContainer $container): void
    {
        $displayTitle = $container->getDisplayTitle();
        $displayText  = $container->getDisplayPrimaryText();

        $smallImageUrl = $container->hasSmallFrontImage()
            ? $container->getSmallFrontImage()
            : $this->getSkillConfiguration()->getSmallFrontImage();

        $largeImageUrl = $container->hasLargeFrontImage()
            ? $container->getLargeFrontImage()
            : $this->getSkillConfiguration()->getLargeFrontImage();

        $this->getAlexaResponse()->setCard(
            new Standard($displayTitle, $displayText, $smallImageUrl, $largeImageUrl)
        );
    }

    /**
     * @param BodyContainer $container
     */
    protected function renderDisplayTemplate(BodyContainer $container): void
    {
        $token = $container->hasToken() ? $container->getToken() : 'token';

        $textContent = $this->renderTextContentForDisplay($container);

        $template = $container->hasDisplayTemplate()
            ? $container->getDisplayTemplate()
            : RenderTemplate::TYPE_BODY_TEMPLATE_6;

        $imageTitle = $container->hasImageTitle()
            ? $container->getImageTitle()
            : $this->getSkillConfiguration()->getSkillTitle();

        $backgroundImageUrl = $container->hasMediumBackgroundImage()
            ? $container->getMediumBackgroundImage()
            : $this->getSkillConfiguration()->getMediumBackgroundImage();

        $backgroundImage = new Image($imageTitle);
        $backgroundImage->setUrlLarge($backgroundImageUrl);

        $displayDirective = new RenderTemplate($template, $token, $textContent);
        $displayDirective->setTitle($imageTitle);
        $displayDirective->setBackgroundImage($backgroundImage);

        if (in_array(
            $template, [RenderTemplate::TYPE_BODY_TEMPLATE_2, RenderTemplate::TYPE_BODY_TEMPLATE_3], true
        )) {
            $smallImageUrl = $container->hasSmallFrontImage()
                ? $container->getSmallFrontImage()
                : $this->getSkillConfiguration()->getSmallFrontImage();

            $largeImageUrl = $container->hasLargeFrontImage()
                ? $container->getLargeFrontImage()
                : $this->getSkillConfiguration()->getLargeFrontImage();

            $image = new Image($imageTitle);
            $image->setUrlSmall($smallImageUrl);
            $image->setUrlLarge($largeImageUrl);

            $displayDirective->setImage($image);
        }

        $this->getAlexaResponse()->addDirective($displayDirective);
    }

    /**
     * @param BodyContainer $container
     *
     * @return TextContent
     */
    protected function renderTextContentForDisplay(BodyContainer $container): TextContent
    {
        $displayTitle = '<font size="7"><b>' . $container->getDisplayTitle() . '</b></font>';

        $displayPrimaryText = $container->hasDisplayPrimaryText()
            ? '<font size="3">' . $container->getDisplayPrimaryText() . '</font>'
            : null;

        $displaySecondaryText = $container->hasDisplaySecondaryText()
            ? '<font size="2">' . $container->getDisplaySecondaryText() . '</font>'
            : null;

        if ($displaySecondaryText) {
            $textContent = new TextContent(
                $displayTitle,
                TextContent::TYPE_RICH_TEXT,
                $displayPrimaryText,
                TextContent::TYPE_RICH_TEXT,
                $displaySecondaryText,
                TextContent::TYPE_RICH_TEXT
            );
        } elseif ($displayPrimaryText) {
            $textContent = new TextContent(
                $displayTitle,
                TextContent::TYPE_RICH_TEXT,
                $displayPrimaryText,
                TextContent::TYPE_RICH_TEXT
            );
        } else {
            $textContent = new TextContent(
                $displayTitle,
                TextContent::TYPE_RICH_TEXT
            );
        }

        return $textContent;
    }

    /**
     * @param BodyContainer $container
     */
    protected function renderAplTemplate(BodyContainer $container): void
    {
        $token = $container->hasToken() ? $container->getToken() : 'token';

        $datasources = [
            'content' => [
                'imageContent' => [
                    'logoIcon'                  => $container->getLogoIcon() ?? null,
                    'imageTitle'                => $container->getImageTitle() ?? null,
                    'smallFrontImage'           => $container->getSmallFrontImage() ?? null,
                    'largeFrontImage'           => $container->getLargeFrontImage() ?? null,
                    'smallBackgroundImage'      => $container->getSmallBackgroundImage() ?? null,
                    'mediumBackgroundImage'     => $container->getMediumBackgroundImage() ?? null,
                    'largeBackgroundImage'      => $container->getLargeBackgroundImage() ?? null,
                    'extraLargeBackgroundImage' => $container->getExtraLargeBackgroundImage() ?? null,
                ],
                'textContent'  => [
                    'title'         => $container->getDisplayTitle() ?? null,
                    'primaryText'   => $container->getDisplayPrimaryText() ?? null,
                    'secondaryText' => $container->getDisplaySecondaryText() ?? null,
                    'hintText'      => $container->getHintText() ?? null,
                ],
            ],
        ];

        $renderDocument = new RenderDocument($container->getAplDocument(), $token, $datasources);

        $this->getAlexaResponse()->addDirective($renderDocument);
    }
}
