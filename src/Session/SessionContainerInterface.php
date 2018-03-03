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

namespace Phlexa\Session;

use Phlexa\Request\AlexaRequest;

/**
 * Class SessionContainer
 *
 * @package Phlexa\Session
 */
interface SessionContainerInterface
{
    /**
     * Init the session attributes from alexa request
     *
     * @param AlexaRequest $alexaRequest
     */
    public function initAttributes(AlexaRequest $alexaRequest);

    /**
     * Reset the attributes values
     */
    public function resetAttributes();

    /**
     * Clear the attributes
     */
    public function clearAttributes();

    /**
     * Set session attribute
     *
     * @param string       $attributeKey
     * @param string|array $attributeValue
     */
    public function setAttribute(string $attributeKey, $attributeValue);

    /**
     * Append session attribute
     *
     * @param string $attributeKey
     * @param string $attributeValue
     */
    public function appendAttribute(string $attributeKey, string $attributeValue);

    /**
     * Remove session attribute
     *
     * @param string $attributeKey
     */
    public function removeAttribute(string $attributeKey);

    /**
     * @return array
     */
    public function getAttributes(): array;

    /**
     * @param string $attributeKey
     *
     * @return mixed
     */
    public function getAttribute(string $attributeKey);
}
