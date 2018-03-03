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
 * Interface AlexaResponseInterface
 *
 * @package Phlexa\Response
 */
interface AlexaResponseInterface
{
    /**
     * Add a directive
     *
     * @param DirectivesInterface $directive
     */
    public function addDirective(DirectivesInterface $directive);

    /**
     * Set the output speech
     *
     * @param OutputSpeechInterface $outputSpeech
     */
    public function setOutputSpeech(OutputSpeechInterface $outputSpeech);

    /**
     * Set the card
     *
     * @param CardInterface $card
     */
    public function setCard(CardInterface $card);

    /**
     * Set the reprompt
     *
     * @param OutputSpeechInterface $reprompt
     */
    public function setReprompt(OutputSpeechInterface $reprompt);

    /**
     * @param SessionContainer $sessionContainer
     */
    public function setSessionContainer(SessionContainer $sessionContainer);

    /**
     * End the current session
     */
    public function endSession();

    /**
     * @param bool $isEmpty
     */
    public function setIsEmpty(bool $isEmpty);

    /**
     * @return bool
     */
    public function isEmpty(): bool;

    /**
     * @return SessionContainer
     */
    public function getSessionContainer(): SessionContainer;

    /**
     * Render the response object to an array
     *
     * @return array
     */
    public function toArray(): array;
}
