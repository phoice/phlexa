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
    private $smallImageUrl;

    /** @var string */
    private $largeImageUrl;

    /** @var string */
    private $backgroundImageUrl;

    /** @var string */
    private $backgroundImageTitle;

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
    public function getSmallImageUrl(): string
    {
        return $this->smallImageUrl;
    }

    /**
     * @param string $smallImageUrl
     */
    public function setSmallImageUrl(string $smallImageUrl): void
    {
        $this->smallImageUrl = $smallImageUrl;
    }

    /**
     * @return string
     */
    public function getLargeImageUrl(): string
    {
        return $this->largeImageUrl;
    }

    /**
     * @param string $largeImageUrl
     */
    public function setLargeImageUrl(string $largeImageUrl): void
    {
        $this->largeImageUrl = $largeImageUrl;
    }

    /**
     * @return string
     */
    public function getBackgroundImageUrl(): string
    {
        return $this->backgroundImageUrl;
    }

    /**
     * @param string $backgroundImageUrl
     */
    public function setBackgroundImageUrl(string $backgroundImageUrl): void
    {
        $this->backgroundImageUrl = $backgroundImageUrl;
    }

    /**
     * @return string
     */
    public function getBackgroundImageTitle(): string
    {
        return $this->backgroundImageTitle;
    }

    /**
     * @param string $backgroundImageTitle
     */
    public function setBackgroundImageTitle(string $backgroundImageTitle): void
    {
        $this->backgroundImageTitle = $backgroundImageTitle;
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
