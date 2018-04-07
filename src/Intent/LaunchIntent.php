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

use Phlexa\Response\AlexaResponse;
use Phlexa\Response\Card\Standard;
use Phlexa\Response\Directives\Display\RenderTemplate;
use Phlexa\Response\Directives\Display\TextContent;
use Phlexa\Response\OutputSpeech\SSML;

/**
 * Class LaunchIntent
 *
 * @package Phlexa\Intent
 */
class LaunchIntent extends AbstractIntent
{
    public const NAME = 'AMAZON.LaunchIntent';

    /**
     * @return AlexaResponse
     */
    public function handle(): AlexaResponse
    {
        $smallImageUrl = $this->getSkillConfiguration()->getSmallImageUrl();
        $largeImageUrl = $this->getSkillConfiguration()->getLargeImageUrl();

        $title   = $this->getTextHelper()->getLaunchTitle();
        $message = $this->getTextHelper()->getLaunchMessage();

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

            $this->addBodyTemplateDirective(RenderTemplate::TYPE_BODY_TEMPLATE_6, $textContent, 'launch');
        } else {
            $this->getAlexaResponse()->setCard(
                new Standard($title, $message, $smallImageUrl, $largeImageUrl)
            );
        }

        $this->getAlexaResponse()->setReprompt(
            new SSML($this->getTextHelper()->getRepromptMessage())
        );

        return $this->getAlexaResponse();
    }
}
