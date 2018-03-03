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

namespace Phlexa\Response;

use Phlexa\Response\Card\CardInterface;
use Phlexa\Response\Directives\DirectivesInterface;
use Phlexa\Response\OutputSpeech\OutputSpeechInterface;
use Phlexa\Session\SessionContainer;

/**
 * Class AlexaResponse
 *
 * @package Phlexa\Response
 */
class AlexaResponse implements AlexaResponseInterface
{
    /** @var CardInterface */
    private $card;

    /** @var DirectivesInterface[] */
    private $directives = [];

    /** @var OutputSpeechInterface */
    private $outputSpeech;

    /** @var OutputSpeechInterface */
    private $reprompt;

    /** @var SessionContainer */
    private $sessionContainer;

    /** @var bool */
    private $shouldEndSession = false;

    /** @var bool */
    private $isEmpty = false;

    /** @var string */
    private $version = '1.0';

    /**
     * Add a directive
     *
     * @param DirectivesInterface $directive
     */
    public function addDirective(DirectivesInterface $directive)
    {
        $this->directives[$directive->getType()] = $directive;
    }

    /**
     * Set the output speech
     *
     * @param OutputSpeechInterface $outputSpeech
     */
    public function setOutputSpeech(OutputSpeechInterface $outputSpeech)
    {
        $this->outputSpeech = $outputSpeech;
    }

    /**
     * Set the card
     *
     * @param CardInterface $card
     */
    public function setCard(CardInterface $card)
    {
        $this->card = $card;
    }

    /**
     * Set the reprompt
     *
     * @param OutputSpeechInterface $reprompt
     */
    public function setReprompt(OutputSpeechInterface $reprompt)
    {
        $this->reprompt = $reprompt;
    }

    /**
     * @param SessionContainer $sessionContainer
     */
    public function setSessionContainer(SessionContainer $sessionContainer)
    {
        $this->sessionContainer = $sessionContainer;
    }

    /**
     * End the current session
     */
    public function endSession()
    {
        $this->shouldEndSession = true;
    }

    /**
     * @param bool $isEmpty
     */
    public function setIsEmpty(bool $isEmpty)
    {
        $this->isEmpty = $isEmpty;
    }

    /**
     * @return bool
     */
    public function isEmpty(): bool
    {
        return $this->isEmpty;
    }

    /**
     * @return SessionContainer
     */
    public function getSessionContainer(): SessionContainer
    {
        return $this->sessionContainer;
    }

    /**
     * Render the response object to an array
     *
     * @return array
     */
    public function toArray(): array
    {
        if ($this->isEmpty()) {
            return [];
        }

        $response = [];

        if ($this->outputSpeech) {
            $response['outputSpeech'] = $this->outputSpeech->toArray();
        }

        if ($this->card) {
            $response['card'] = $this->card->toArray();
        }

        if ($this->reprompt) {
            $response['reprompt'] = [
                'outputSpeech' => $this->reprompt->toArray()
            ];
        }

        if (count($this->directives) > 0) {
            $response['directives'] = [];

            foreach ($this->directives as $directive) {
                $response['directives'][] = $directive->toArray();
            }
        }

        $response['shouldEndSession'] = $this->shouldEndSession;

        return [
            'version'           => $this->version,
            'sessionAttributes' => $this->sessionContainer ? $this->sessionContainer->getAttributes() : [],
            'response'          => $response,
        ];
    }
}
