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
use Phlexa\Content\ImageContainer;
use Phlexa\Response\AlexaResponse;
use Phlexa\Response\Directives\Alexa\Presentation\APL\Document\APL;
use Phlexa\Response\Directives\Display\RenderTemplate;

/**
 * Class HelpIntent
 *
 * @package Phlexa\Intent
 */
class HelpIntent extends AbstractIntent
{
    public const NAME = 'AMAZON.HelpIntent';

    /**
     * @return AlexaResponse
     */
    public function handle(): AlexaResponse
    {
        $content = [
            'output_speech'      => $this->getTextHelper()->getHelpMessage(),
            'reprompt_speech'    => $this->getTextHelper()->getRepromptMessage(),
            'token'              => 'help',
            'display_template'   => RenderTemplate::TYPE_BODY_TEMPLATE_6,
            'apl_document'       => APL::createFromString(
                $this->getSkillConfiguration()->getAplDocuments()['normal-body']
            ),
            'display_title'      => $this->getTextHelper()->getHelpTitle(),
            'display_large_text' => $this->getTextHelper()->getHelpMessage(),
            'hint_text'          => $this->getTextHelper()->getHintText(),
            'logo_icon'          => $this->getSkillConfiguration()->getSmallIconImage(),
            'image'              => new ImageContainer(
                [
                    'image_id'                     => 'imageDefault',
                    'image_title'                  => $this->getTextHelper()->getHelpTitle(),
                    'small_front_image'            => $this->getSkillConfiguration()->getSmallFrontImage(),
                    'large_front_image'            => $this->getSkillConfiguration()->getLargeFrontImage(),
                    'round_background_image'       => $this->getSkillConfiguration()->getRoundBackgroundImage(),
                    'small_background_image'       => $this->getSkillConfiguration()->getSmallBackgroundImage(),
                    'medium_background_image'      => $this->getSkillConfiguration()->getMediumBackgroundImage(),
                    'large_background_image'       => $this->getSkillConfiguration()->getLargeBackgroundImage(),
                    'extra_large_background_image' => $this->getSkillConfiguration()->getExtraLargeBackgroundImage(),
                ]
            ),
            'card'               => true,
            'display'            => true,
            'apl'                => true,
        ];

        $this->renderBodyContainer(new BodyContainer($content));

        return $this->getAlexaResponse();
    }
}
