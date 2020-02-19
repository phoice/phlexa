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
use Phlexa\Content\ImageContainer;
use Phlexa\Content\ListContainer;
use Phlexa\Content\ListItemContainer;
use Phlexa\Content\SlideShowContainer;
use Phlexa\Request\AlexaRequest;
use Phlexa\Response\AlexaResponse;
use Phlexa\Response\Card\Standard;
use Phlexa\Response\Directives\Alexa\Presentation\APL\RenderDocument;
use Phlexa\Response\Directives\Display\Image;
use Phlexa\Response\Directives\Display\RenderTemplate;
use Phlexa\Response\Directives\Display\TextContent;
use Phlexa\Response\Directives\Hint\Hint;
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
            $this->renderAplBodyTemplate($container);
        } elseif ($container->hasDisplay() && $container->hasDisplayTemplate() && $this->isDisplaySupported()) {
            $this->renderDisplayTemplate($container);
        } elseif ($container->hasCard()) {
            $this->renderCard($container);
        }
    }

    /**
     * @param SlideShowContainer $container
     */
    protected function renderSlideShowContainer(SlideShowContainer $container): void
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
            $this->renderAplSlideShowTemplate($container);

            return;
        }

        $this->setRandomImageFromSlideShow($container);

        if ($container->hasDisplay() && $container->hasDisplayTemplate() && $this->isDisplaySupported()) {
            $this->renderDisplayTemplate($container);
        } elseif ($container->hasCard()) {
            $this->renderCard($container);
        }
    }

    /**
     * @param SlideShowContainer $container
     */
    protected function setRandomImageFromSlideShow(SlideShowContainer $container): void
    {
        $slideImages = $container->getSlideImages();

        /** @var ImageContainer $randomImage */
        $randomImage = $slideImages[array_rand($slideImages)];

        $container->setImage($randomImage);
        $container->setHintText($randomImage->getHintText());
        $container->setDisplayTitle($randomImage->getImageTitle());

        if ($this->isDisplaySupported() === false) {
            $container->setDisplayLargeText(
                $container->getDisplayLargeText() . Standard::BREAK_CARD .
                $this->getTextHelper()->getHintTextFull($randomImage->getHintText())
            );
        } else {
            $container->setDisplayLargeText($randomImage->getImageTitle());
        }
    }

    /**
     * @param ListContainer $container
     */
    protected function renderListContainer(ListContainer $container): void
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
            $this->renderAplListTemplate($container);

            return;
        }

        if ($container->hasDisplay() && $container->hasDisplayTemplate() && $this->isDisplaySupported()) {
            $container->setDisplayTemplate(RenderTemplate::TYPE_LIST_TEMPLATE_1);

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
        $cardTitle = $container->getDisplayTitle();

        $cardText = $container->hasCardText()
            ? $container->getCardText()
            : strip_tags($container->getDisplayLargeText());

        $smallImageUrl = $container->getImage()->hasSmallFrontImage()
            ? $container->getImage()->getSmallFrontImage()
            : $this->getSkillConfiguration()->getSmallFrontImage();

        $largeImageUrl = $container->getImage()->hasLargeFrontImage()
            ? $container->getImage()->getLargeFrontImage()
            : $this->getSkillConfiguration()->getLargeFrontImage();

        $this->getAlexaResponse()->setCard(
            new Standard($cardTitle, $cardText, $smallImageUrl, $largeImageUrl)
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

        $imageTitle = $container->getImage()->hasImageTitle()
            ? $container->getImage()->getImageTitle()
            : $this->getSkillConfiguration()->getSkillTitle();

        $backgroundImageUrl = $container->getImage()->hasMediumBackgroundImage()
            ? $container->getImage()->getMediumBackgroundImage()
            : $this->getSkillConfiguration()->getMediumBackgroundImage();

        $backgroundImage = new Image($imageTitle);
        $backgroundImage->setUrlLarge($backgroundImageUrl);

        $displayDirective = new RenderTemplate($template, $token, $textContent);
        $displayDirective->setTitle($imageTitle);
        $displayDirective->setBackgroundImage($backgroundImage);

        if (in_array(
            $template, [RenderTemplate::TYPE_BODY_TEMPLATE_2, RenderTemplate::TYPE_BODY_TEMPLATE_3], true
        )) {
            $smallImageUrl = $container->getImage()->hasSmallFrontImage()
                ? $container->getImage()->getSmallFrontImage()
                : $this->getSkillConfiguration()->getSmallFrontImage();

            $largeImageUrl = $container->getImage()->hasLargeFrontImage()
                ? $container->getImage()->getLargeFrontImage()
                : $this->getSkillConfiguration()->getLargeFrontImage();

            $image = new Image($imageTitle);
            $image->setUrlSmall($smallImageUrl);
            $image->setUrlLarge($largeImageUrl);

            $displayDirective->setImage($image);
        }

        $this->getAlexaResponse()->addDirective($displayDirective);

        if ($container->hasHintText()) {
            $this->getAlexaResponse()->addDirective(
                new Hint($container->getHintText())
            );
        }
    }

    /**
     * @param BodyContainer $container
     *
     * @return TextContent
     */
    protected function renderTextContentForDisplay(BodyContainer $container): TextContent
    {
        $displayTitle = '<font size="7"><b>' . $container->getDisplayTitle() . '</b></font>';

        $displayLargeText = $container->hasDisplayLargeText()
            ? '<font size="3">' . $container->getDisplayLargeText() . '</font>'
            : null;

        $displayMediumText = $container->hasDisplayMediumText()
            ? '<font size="2">' . $container->getDisplayMediumText() . '</font>'
            : null;

        if ($displayMediumText) {
            $textContent = new TextContent(
                $displayTitle,
                TextContent::TYPE_RICH_TEXT,
                $displayLargeText,
                TextContent::TYPE_RICH_TEXT,
                $displayMediumText,
                TextContent::TYPE_RICH_TEXT
            );
        } elseif ($displayLargeText) {
            $textContent = new TextContent(
                $displayTitle,
                TextContent::TYPE_RICH_TEXT,
                $displayLargeText,
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
    protected function renderAplBodyTemplate(BodyContainer $container): void
    {
        $token = $container->hasToken() ? $container->getToken() : 'token';

        $datasources = [
            'content' => [
                'imageContent'      => [
                    'logoIcon'                  => $container->getLogoIcon(),
                    'imageTitle'                => $container->getImage()->getImageTitle(),
                    'smallFrontImage'           => $container->getImage()->getSmallFrontImage(),
                    'largeFrontImage'           => $container->getImage()->getLargeFrontImage(),
                    'roundBackgroundImage'      => $container->getImage()->getRoundBackgroundImage(),
                    'smallBackgroundImage'      => $container->getImage()->getSmallBackgroundImage(),
                    'mediumBackgroundImage'     => $container->getImage()->getMediumBackgroundImage(),
                    'largeBackgroundImage'      => $container->getImage()->getLargeBackgroundImage(),
                    'extraLargeBackgroundImage' => $container->getImage()->getExtraLargeBackgroundImage(),
                ],
                'textContent'       => [
                    'title'      => $container->getDisplayTitle(),
                    'largeText'  => $container->getDisplayLargeText(),
                    'mediumText' => $container->getDisplayMediumText(),
                    'hintText'   => $container->getHintText()
                        ? $this->getTextHelper()->getHintTextFull($container->getHintText())
                        : null,
                ],
                'additionalContent' => $container->getAdditionalData(),
            ],
        ];

        $renderDocument = new RenderDocument($container->getAplDocument(), $token, $datasources);

        $this->getAlexaResponse()->addDirective($renderDocument);
    }

    /**
     * @param SlideShowContainer $container
     */
    protected function renderAplSlideShowTemplate(SlideShowContainer $container): void
    {
        $token = $container->hasToken() ? $container->getToken() : 'token';

        $datasources = [
            'content' => [
                'imageContent'     => [
                    'logoIcon' => $container->getLogoIcon(),
                ],
                'slideShowContent' => [],
            ],
        ];

        /** @var ImageContainer $image */
        foreach ($container->getSlideImages() as $image) {
            $datasources['content']['slideShowContent'][] = [
                'imageTitle'                => $image->getImageTitle(),
                'hintText'                  => $this->getTextHelper()->getHintTextFull($image->getHintText()),
                'smallFrontImage'           => $image->getSmallFrontImage(),
                'largeFrontImage'           => $image->getLargeFrontImage(),
                'roundBackgroundImage'      => $image->getRoundBackgroundImage(),
                'smallBackgroundImage'      => $image->getSmallBackgroundImage(),
                'mediumBackgroundImage'     => $image->getMediumBackgroundImage(),
                'largeBackgroundImage'      => $image->getLargeBackgroundImage(),
                'extraLargeBackgroundImage' => $image->getExtraLargeBackgroundImage(),
            ];
        }

        $renderDocument = new RenderDocument($container->getAplDocument(), $token, $datasources);

        $this->getAlexaResponse()->addDirective($renderDocument);
    }

    /**
     * @param ListContainer $container
     */
    protected function renderAplListTemplate(ListContainer $container)
    {
        $token = $container->hasToken() ? $container->getToken() : 'token';

        $datasources = [
            'content' => [
                'properties' => [
                    'imageContent' => [
                        'logoIcon' => $container->getLogoIcon(),
                    ],
                    'textContent'  => [
                        'title'    => $container->getDisplayTitle(),
                        'hintText' => $container->getHintText()
                    ],
                    'listContent'  => [],
                ]
            ],
        ];

        /** @var ListItemContainer $item */
        foreach ($container->getListItems() as $item) {
            $datasources['content']['properties']['listContent'][] = [
                'token'         => $item->getToken(),
                'title'         => $item->getTitle(),
                'text'          => $item->getText(),
                'path'          => $item->getImagePath(),
                'ordinalNumber' => $item->getOrdinalNumber(),
            ];
        }

        $renderDocument = new RenderDocument($container->getAplDocument(), $token, $datasources);

        $this->getAlexaResponse()->addDirective($renderDocument);
    }
}
