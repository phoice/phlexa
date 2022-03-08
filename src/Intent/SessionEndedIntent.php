<?php

namespace Phlexa\Intent;

use Phlexa\Content\BodyContainer;
use Phlexa\Content\ImageContainer;
use Phlexa\Response\AlexaResponse;
use Phlexa\Response\Directives\Alexa\Presentation\APL\Document\APL;
use Phlexa\Response\Directives\Display\RenderTemplate;

class SessionEndedIntent extends AbstractIntent
{
    public const NAME = "SessionEndedRequest";

    /**
     * @return AlexaResponse
     */
    public function handle(): AlexaResponse
    {
        $reason = $this->getAlexaRequest()->getRequest()->getReason();
        $error  = $this->getAlexaRequest()->getRequest()->getError();

        if ($reason == "ERROR") {
            if ($this->isErrorLogFlag() == true) {
                $microtime = explode('.', (string)microtime(true));

                $random = date('Y-m-d-H-i-s-') . $microtime[1];
                $endpoint = $this->getSkillConfiguration()->getSkillTitle();

                file_put_contents(
                    PROJECT_ROOT . '/data/' . $endpoint . '-SessionEndedRequest-' . $random . '.txt',
                    $error->getType() . ": " . $error->getMessage()
                );
            }
        }
        $content = [
            'output_speech'      => $this->getTextHelper()->getStopMessage(),
            'token'              => 'stop',
            'display_template'   => RenderTemplate::TYPE_BODY_TEMPLATE_6,
            'apl_document'       => APL::createFromString(
                $this->getSkillConfiguration()->getAplDocuments()['normal-body']
            ),
            'display_title'      => $this->getTextHelper()->getStopTitle(),
            'display_large_text' => $this->getTextHelper()->getStopMessage(),
            'logo_icon'          => $this->getSkillConfiguration()->getSmallIconImage(),
            'image'              => new ImageContainer(
                [
                    'image_id'                     => 'imageDefault',
                    'image_title'                  => $this->getTextHelper()->getStopTitle(),
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

        $this->getAlexaResponse()->endSession();

        $this->getAlexaResponse()->getSessionContainer()->clearAttributes();

        return $this->getAlexaResponse();
    }
}
