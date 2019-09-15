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
 * Class SkillConfiguration
 *
 * @package Phlexa\Configuration
 */
class SkillConfiguration implements SkillConfigurationInterface
{
    /** @var string */
    private $name;

    /** @var string */
    private $applicationId;

    /** @var string */
    private $skillTitle;

    /** @var string */
    private $applicationClass;

    /** @var string */
    private $textHelperClass;

    /** @var array */
    private $sessionDefaults = [];

    /** @var array */
    private $intents = [];

    /** @var array */
    private $texts = [];

    /** @var string */
    private $host;

    /** @var string|null */
    private $smallIconImage;

    /** @var string|null */
    private $largeIconImage;

    /** @var string|null */
    private $smallFrontImage;

    /** @var string|null */
    private $largeFrontImage;

    /** @var string|null */
    private $roundBackgroundImage;

    /** @var string|null */
    private $smallBackgroundImage;

    /** @var string|null */
    private $mediumBackgroundImage;

    /** @var string|null */
    private $largeBackgroundImage;

    /** @var string|null */
    private $extraLargeBackgroundImage;

    /** @var string */
    private $imageTitle;

    /** @var array */
    private $aplDocuments = [];

    /** @var array */
    private $customData = [];

    /**
     * @param array $config
     *
     * @return void
     */
    public function setConfig(array $config): void
    {
        foreach ($config as $key => $value) {
            $setMethod = 'set' . ucfirst($key);

            if (method_exists($this, $setMethod)) {
                $this->$setMethod($value);
            }
        }
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getApplicationId(): string
    {
        return $this->applicationId;
    }

    /**
     * @param string $applicationId
     */
    public function setApplicationId(string $applicationId): void
    {
        $this->applicationId = $applicationId;
    }

    /**
     * @return string
     */
    public function getSkillTitle(): string
    {
        return $this->skillTitle;
    }

    /**
     * @param string $skillTitle
     */
    public function setSkillTitle(string $skillTitle): void
    {
        $this->skillTitle = $skillTitle;
    }

    /**
     * @return string
     */
    public function getApplicationClass(): string
    {
        return $this->applicationClass;
    }

    /**
     * @param string $applicationClass
     */
    public function setApplicationClass(string $applicationClass): void
    {
        $this->applicationClass = $applicationClass;
    }

    /**
     * @return string
     */
    public function getTextHelperClass(): string
    {
        return $this->textHelperClass;
    }

    /**
     * @param string $textHelperClass
     */
    public function setTextHelperClass(string $textHelperClass): void
    {
        $this->textHelperClass = $textHelperClass;
    }

    /**
     * @return array
     */
    public function getSessionDefaults(): array
    {
        return $this->sessionDefaults;
    }

    /**
     * @param array $sessionDefaults
     */
    public function setSessionDefaults(array $sessionDefaults): void
    {
        $this->sessionDefaults = $sessionDefaults;
    }

    /**
     * @return array
     */
    public function getIntents(): array
    {
        return $this->intents;
    }

    /**
     * @param array $intents
     */
    public function setIntents(array $intents): void
    {
        $this->intents = $intents;
    }

    /**
     * @return array
     */
    public function getTexts(): array
    {
        return $this->texts;
    }

    /**
     * @param array $texts
     */
    public function setTexts(array $texts): void
    {
        $this->texts = $texts;
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * @param string $host
     */
    public function setHost(string $host): void
    {
        $this->host = $host;
    }

    /**
     * @return string
     */
    public function getSmallIconImage(): string
    {
        return $this->smallIconImage;
    }

    /**
     * @param string $smallIconImage
     */
    public function setSmallIconImage(string $smallIconImage): void
    {
        $this->smallIconImage = $smallIconImage;
    }

    /**
     * @return string
     */
    public function getLargeIconImage(): string
    {
        return $this->largeIconImage;
    }

    /**
     * @param string $largeIconImage
     */
    public function setLargeIconImage(string $largeIconImage): void
    {
        $this->largeIconImage = $largeIconImage;
    }

    /**
     * @return string
     */
    public function getSmallFrontImage(): string
    {
        return $this->smallFrontImage;
    }

    /**
     * @param string $smallFrontImage
     */
    public function setSmallFrontImage(string $smallFrontImage): void
    {
        $this->smallFrontImage = $smallFrontImage;
    }

    /**
     * @return string
     */
    public function getLargeFrontImage(): string
    {
        return $this->largeFrontImage;
    }

    /**
     * @param string $largeFrontImage
     */
    public function setLargeFrontImage(string $largeFrontImage): void
    {
        $this->largeFrontImage = $largeFrontImage;
    }

    /**
     * @return string|null
     */
    public function getRoundBackgroundImage(): ?string
    {
        return $this->roundBackgroundImage;
    }

    /**
     * @param string|null $roundBackgroundImage
     */
    public function setRoundBackgroundImage(?string $roundBackgroundImage): void
    {
        $this->roundBackgroundImage = $roundBackgroundImage;
    }

    /**
     * @return string|null
     */
    public function getSmallBackgroundImage(): ?string
    {
        return $this->smallBackgroundImage;
    }

    /**
     * @param string|null $smallBackgroundImage
     */
    public function setSmallBackgroundImage(?string $smallBackgroundImage): void
    {
        $this->smallBackgroundImage = $smallBackgroundImage;
    }

    /**
     * @return string
     */
    public function getMediumBackgroundImage(): string
    {
        return $this->mediumBackgroundImage;
    }

    /**
     * @param string $mediumBackgroundImage
     */
    public function setMediumBackgroundImage(string $mediumBackgroundImage): void
    {
        $this->mediumBackgroundImage = $mediumBackgroundImage;
    }

    /**
     * @return string|null
     */
    public function getLargeBackgroundImage(): ?string
    {
        return $this->largeBackgroundImage;
    }

    /**
     * @param string|null $largeBackgroundImage
     */
    public function setLargeBackgroundImage(?string $largeBackgroundImage): void
    {
        $this->largeBackgroundImage = $largeBackgroundImage;
    }

    /**
     * @return string|null
     */
    public function getExtraLargeBackgroundImage(): ?string
    {
        return $this->extraLargeBackgroundImage;
    }

    /**
     * @param string|null $extraLargeBackgroundImage
     */
    public function setExtraLargeBackgroundImage(?string $extraLargeBackgroundImage): void
    {
        $this->extraLargeBackgroundImage = $extraLargeBackgroundImage;
    }

    /**
     * @return string
     */
    public function getImageTitle(): string
    {
        return $this->imageTitle;
    }

    /**
     * @param string $imageTitle
     */
    public function setImageTitle(string $imageTitle): void
    {
        $this->imageTitle = $imageTitle;
    }

    /**
     * @return array
     */
    public function getAplDocuments(): array
    {
        return $this->aplDocuments;
    }

    /**
     * @param array $aplDocuments
     */
    public function setAplDocuments(array $aplDocuments): void
    {
        $this->aplDocuments = $aplDocuments;
    }

    /**
     * @return array
     */
    public function getCustomData(): array
    {
        return $this->customData;
    }

    /**
     * @param array $customData
     */
    public function setCustomData(array $customData): void
    {
        $this->customData = $customData;
    }
}
