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
    public function setConfig(array $config): void;

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
    public function getHost(): string;

    /**
     * @param string $host
     */
    public function setHost(string $host): void;

    /**
     * @return string
     */
    public function getSmallFrontImage(): string;

    /**
     * @param string $smallFrontImage
     */
    public function setSmallFrontImage(string $smallFrontImage);

    /**
     * @return string
     */
    public function getLargeFrontImage(): string;

    /**
     * @param string $largeFrontImage
     */
    public function setLargeFrontImage(string $largeFrontImage);

    /**
     * @return string|null
     */
    public function getSmallBackgroundImage(): ?string;

    /**
     * @param string|null $smallBackgroundImage
     */
    public function setSmallBackgroundImage(?string $smallBackgroundImage): void;

    /**
     * @return string
     */
    public function getMediumBackgroundImage(): string;

    /**
     * @param string $mediumBackgroundImage
     */
    public function setMediumBackgroundImage(string $mediumBackgroundImage);

    /**
     * @return string|null
     */
    public function getLargeBackgroundImage(): ?string;

    /**
     * @param string|null $largeBackgroundImage
     */
    public function setLargeBackgroundImage(?string $largeBackgroundImage): void;

    /**
     * @return string|null
     */
    public function getExtraLargeBackgroundImage(): ?string;

    /**
     * @param string|null $extraLargeBackgroundImage
     */
    public function setExtraLargeBackgroundImage(?string $extraLargeBackgroundImage): void;

    /**
     * @return string
     */
    public function getImageTitle(): string;

    /**
     * @param string $backgroundImageTitle
     */
    public function setImageTitle(string $backgroundImageTitle);

    /**
     * @return string|null
     */
    public function getNormalBodyAplDocument(): ?string;

    /**
     * @param string|null $normalBodyAplDocument
     */
    public function setNormalBodyAplDocument(?string $normalBodyAplDocument): void;

    /**
     * @return array
     */
    public function getCustomData(): array;

    /**
     * @param array $customData
     */
    public function setCustomData(array $customData);
}
