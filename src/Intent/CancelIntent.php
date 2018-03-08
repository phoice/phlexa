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

use Phlexa\Response\AlexaResponse;
use Phlexa\Response\Card\Standard;
use Phlexa\Response\Directives\Display\RenderTemplate;
use Phlexa\Response\Directives\Display\TextContent;
use Phlexa\Response\OutputSpeech\SSML;

/**
 * Class CancelIntent
 *
 * @package Phlexa\Intent
 */
class CancelIntent extends AbstractIntent
{
    public const NAME = 'AMAZON.CancelIntent';

    /**
     * @return AlexaResponse
     */
    public function handle(): AlexaResponse
    {
        $smallImageUrl = $this->getSkillConfiguration()->getSmallImageUrl();
        $largeImageUrl = $this->getSkillConfiguration()->getLargeImageUrl();

        $title   = $this->getTextHelper()->getCancelTitle();
        $message = $this->getTextHelper()->getCancelMessage();

        $this->getAlexaResponse()->setOutputSpeech(
            new SSML($message)
        );

        if ($this->isDisplaySupported()) {
            $textContent = new TextContent(
                '<font size="7"><b>' . $title . '</b></font>',
                TextContent::TYPE_RICH_TEXT,
                '<font size="3">' . $message . '</font>',
                TextContent::TYPE_RICH_TEXT
            );

            $this->addBodyTemplateDirective(RenderTemplate::TYPE_BODY_TEMPLATE_6, $textContent, 'cancel');
        } else {
            $this->getAlexaResponse()->setCard(
                new Standard($title, $message, $smallImageUrl, $largeImageUrl)
            );
        }

        $this->getAlexaResponse()->endSession();

        $this->getAlexaResponse()->getSessionContainer()->clearAttributes();

        return $this->getAlexaResponse();
    }
}
