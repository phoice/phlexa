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

use Phlexa\Content\BodyContainer;
use Phlexa\Response\AlexaResponse;
use Phlexa\Response\Directives\Alexa\Presentation\APL\Document\APL;
use Phlexa\Response\Directives\Display\RenderTemplate;

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
        $content = [
            'output_speech'                => $this->getTextHelper()->getLaunchMessage(),
            'reprompt_speech'              => $this->getTextHelper()->getRepromptMessage(),
            'token'                        => 'launch',
            'display_template'             => RenderTemplate::TYPE_BODY_TEMPLATE_6,
            'apl_document'                 => APL::createFromString(
                $this->getSkillConfiguration()->getNormalBodyAplDocument()
            ),
            'display_title'                => $this->getTextHelper()->getLaunchTitle(),
            'display_primary_text'         => $this->getTextHelper()->getLaunchMessage(),
            'image_title'                  => $this->getTextHelper()->getLaunchTitle(),
            'small_front_image'            => $this->getSkillConfiguration()->getSmallFrontImage(),
            'large_front_image'            => $this->getSkillConfiguration()->getLargeFrontImage(),
            'small_background_image'       => $this->getSkillConfiguration()->getSmallBackgroundImage(),
            'medium_background_image'      => $this->getSkillConfiguration()->getMediumBackgroundImage(),
            'large_background_image'       => $this->getSkillConfiguration()->getLargeBackgroundImage(),
            'extra_large_background_image' => $this->getSkillConfiguration()->getExtraLargeBackgroundImage(),
            'card'                         => true,
            'display'                      => true,
            'apl'                          => true,
        ];

        $this->renderBodyContainer(new BodyContainer($content));

        return $this->getAlexaResponse();
    }
}
