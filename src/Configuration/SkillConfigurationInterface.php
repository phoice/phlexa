<?php
/**
 * Build voice applications for Amazon Alexa with phlexa and PHP
 *
 * @author     Ralf Eggert <ralf@travello.audio>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/phoice/phlexa
 * @link       https://www.phoice.tech/
 *
 */

namespace Phlexa\Configuration;

/**
 * Interface SkillConfiguration
 *
 * @package Phlexa\Configuration
 */
interface SkillConfigurationInterface
{
    /**
     * @param array $config
     *
     * @return void
     */
    public function setConfig(array $config);

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param string $name
     */
    public function setName(string $name);

    /**
     * @return string
     */
    public function getApplicationId(): string;

    /**
     * @param string $applicationId
     */
    public function setApplicationId(string $applicationId);

    /**
     * @return string
     */
    public function getSkillTitle(): string;

    /**
     * @param string $skillTitle
     */
    public function setSkillTitle(string $skillTitle);

    /**
     * @return string
     */
    public function getApplicationClass(): string;

    /**
     * @param string $applicationClass
     */
    public function setApplicationClass(string $applicationClass);

    /**
     * @return string
     */
    public function getTextHelperClass(): string;

    /**
     * @param string $textHelperClass
     */
    public function setTextHelperClass(string $textHelperClass);

    /**
     * @return array
     */
    public function getSessionDefaults(): array;

    /**
     * @param array $sessionDefaults
     */
    public function setSessionDefaults(array $sessionDefaults);

    /**
     * @return array
     */
    public function getIntents(): array;

    /**
     * @param array $intents
     */
    public function setIntents(array $intents);

    /**
     * @return array
     */
    public function getTexts(): array;

    /**
     * @param array $texts
     */
    public function setTexts(array $texts);

    /**
     * @return string
     */
    public function getSmallImageUrl(): string;

    /**
     * @param string $smallImageUrl
     */
    public function setSmallImageUrl(string $smallImageUrl);

    /**
     * @return string
     */
    public function getLargeImageUrl(): string;

    /**
     * @param string $largeImageUrl
     */
    public function setLargeImageUrl(string $largeImageUrl);

    /**
     * @return string
     */
    public function getBackgroundImageUrl(): string;

    /**
     * @param string $backgroundImageUrl
     */
    public function setBackgroundImageUrl(string $backgroundImageUrl);

    /**
     * @return string
     */
    public function getBackgroundImageTitle(): string;

    /**
     * @param string $backgroundImageTitle
     */
    public function setBackgroundImageTitle(string $backgroundImageTitle);

    /**
     * @return array
     */
    public function getCustomData(): array;

    /**
     * @param array $customData
     */
    public function setCustomData(array $customData);
}
