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

namespace Phlexa\Content;

use Phlexa\Response\Directives\Alexa\Presentation\APL\Document\APL;

/**
 * Class BodyContainer
 *
 * @package Phlexa\Content
 */
class BodyContainer
{
    /** @var string|null */
    private $outputSpeech;

    /** @var string|null */
    private $repromptSpeech;

    /** @var string|null */
    private $token;

    /** @var string|null */
    private $displayTemplate;

    /** @var APL|null */
    private $aplDocument;

    /** @var string|null */
    private $displayTitle;

    /** @var string|null */
    private $displayLargeText;

    /** @var string|null */
    private $displayMediumText;

    /** @var string|null */
    private $hintText;

    /** @var string|null */
    private $logoIcon;

    /** @var string|null */
    private $imageTitle;

    /** @var string|null */
    private $smallFrontImage;

    /** @var string|null */
    private $largeFrontImage;

    /** @var string|null */
    private $smallBackgroundImage;

    /** @var string|null */
    private $mediumBackgroundImage;

    /** @var string|null */
    private $largeBackgroundImage;

    /** @var string|null */
    private $extraLargeBackgroundImage;

    /** @var bool */
    private $card = false;

    /** @var bool */
    private $display = false;

    /** @var bool */
    private $apl = false;

    /**
     * BodyContainer constructor.
     *
     * @param array $content
     */
    public function __construct(array $content = [])
    {
        foreach ($content as $key => $value) {
            $setMethod = 'set' . str_replace('_', '', ucwords($key, '_'));

            if (method_exists($this, $setMethod)) {
                $this->$setMethod($value);
            }
        }
    }

    /**
     * @return string|null
     */
    public function getOutputSpeech(): ?string
    {
        return $this->outputSpeech;
    }

    /**
     * @param string|null $outputSpeech
     */
    public function setOutputSpeech(?string $outputSpeech): void
    {
        $this->outputSpeech = $outputSpeech;
    }

    /**
     * @return bool
     */
    public function hasOutputSpeech(): bool
    {
        return null !== $this->outputSpeech;
    }

    /**
     * @return string|null
     */
    public function getRepromptSpeech(): ?string
    {
        return $this->repromptSpeech;
    }

    /**
     * @param string|null $repromptSpeech
     */
    public function setRepromptSpeech(?string $repromptSpeech): void
    {
        $this->repromptSpeech = $repromptSpeech;
    }

    /**
     * @return bool
     */
    public function hasRepromptSpeech(): bool
    {
        return null !== $this->repromptSpeech;
    }

    /**
     * @return string|null
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * @param string|null $token
     */
    public function setToken(?string $token): void
    {
        $this->token = $token;
    }

    /**
     * @return bool
     */
    public function hasToken(): bool
    {
        return null !== $this->token;
    }

    /**
     * @return string|null
     */
    public function getDisplayTemplate(): ?string
    {
        return $this->displayTemplate;
    }

    /**
     * @param string|null $displayTemplate
     */
    public function setDisplayTemplate(?string $displayTemplate): void
    {
        $this->displayTemplate = $displayTemplate;
    }

    /**
     * @return bool
     */
    public function hasDisplayTemplate(): bool
    {
        return null !== $this->displayTemplate;
    }

    /**
     * @return APL|null
     */
    public function getAplDocument(): ?APL
    {
        return $this->aplDocument;
    }

    /**
     * @param APL|null $aplDocument
     */
    public function setAplDocument(?APL $aplDocument): void
    {
        $this->aplDocument = $aplDocument;
    }

    /**
     * @return bool
     */
    public function hasAplDocument(): bool
    {
        return null !== $this->aplDocument;
    }

    /**
     * @return string|null
     */
    public function getDisplayTitle(): ?string
    {
        return $this->displayTitle;
    }

    /**
     * @param string|null $displayTitle
     */
    public function setDisplayTitle(?string $displayTitle): void
    {
        $this->displayTitle = $displayTitle;
    }

    /**
     * @return bool
     */
    public function hasDisplayTitle(): bool
    {
        return null !== $this->displayTitle;
    }

    /**
     * @return string|null
     */
    public function getDisplayLargeText(): ?string
    {
        return $this->displayLargeText;
    }

    /**
     * @param string|null $displayLargeText
     */
    public function setDisplayLargeText(?string $displayLargeText): void
    {
        $this->displayLargeText = $displayLargeText;
    }

    /**
     * @return bool
     */
    public function hasDisplayLargeText(): bool
    {
        return null !== $this->displayLargeText;
    }

    /**
     * @return string|null
     */
    public function getDisplayMediumText(): ?string
    {
        return $this->displayMediumText;
    }

    /**
     * @param string|null $displayMediumText
     */
    public function setDisplayMediumText(?string $displayMediumText): void
    {
        $this->displayMediumText = $displayMediumText;
    }

    /**
     * @return bool
     */
    public function hasDisplayMediumText(): bool
    {
        return null !== $this->displayMediumText;
    }

    /**
     * @return string|null
     */
    public function getHintText(): ?string
    {
        return $this->hintText;
    }

    /**
     * @param string|null $hintText
     */
    public function setHintText(?string $hintText): void
    {
        $this->hintText = $hintText;
    }

    /**
     * @return bool
     */
    public function hasHintText(): bool
    {
        return null !== $this->hintText;
    }

    /**
     * @return string|null
     */
    public function getLogoIcon(): ?string
    {
        return $this->logoIcon;
    }

    /**
     * @param string|null $logoIcon
     */
    public function setLogoIcon(?string $logoIcon): void
    {
        $this->logoIcon = $logoIcon;
    }

    /**
     * @return bool
     */
    public function hasLogoIcon(): bool
    {
        return null !== $this->logoIcon;
    }

    /**
     * @return string|null
     */
    public function getImageTitle(): ?string
    {
        return $this->imageTitle;
    }

    /**
     * @param string|null $imageTitle
     */
    public function setImageTitle(?string $imageTitle): void
    {
        $this->imageTitle = $imageTitle;
    }

    /**
     * @return bool
     */
    public function hasImageTitle(): bool
    {
        return null !== $this->imageTitle;
    }

    /**
     * @return string|null
     */
    public function getSmallFrontImage(): ?string
    {
        return $this->smallFrontImage;
    }

    /**
     * @param string|null $smallFrontImage
     */
    public function setSmallFrontImage(?string $smallFrontImage): void
    {
        $this->smallFrontImage = $smallFrontImage;
    }

    /**
     * @return bool
     */
    public function hasSmallFrontImage(): bool
    {
        return null !== $this->smallFrontImage;
    }

    /**
     * @return string|null
     */
    public function getLargeFrontImage(): ?string
    {
        return $this->largeFrontImage;
    }

    /**
     * @param string|null $largeFrontImage
     */
    public function setLargeFrontImage(?string $largeFrontImage): void
    {
        $this->largeFrontImage = $largeFrontImage;
    }

    /**
     * @return bool
     */
    public function hasLargeFrontImage(): bool
    {
        return null !== $this->largeFrontImage;
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
     * @return bool
     */
    public function hasSmallBackgroundImage(): bool
    {
        return null !== $this->smallBackgroundImage;
    }

    /**
     * @return string|null
     */
    public function getMediumBackgroundImage(): ?string
    {
        return $this->mediumBackgroundImage;
    }

    /**
     * @param string|null $mediumBackgroundImage
     */
    public function setMediumBackgroundImage(?string $mediumBackgroundImage): void
    {
        $this->mediumBackgroundImage = $mediumBackgroundImage;
    }

    /**
     * @return bool
     */
    public function hasMediumBackgroundImage(): bool
    {
        return null !== $this->mediumBackgroundImage;
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
     * @return bool
     */
    public function hasLargeBackgroundImage(): bool
    {
        return null !== $this->largeBackgroundImage;
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
     * @return bool
     */
    public function hasExtraLargeBackgroundImage(): bool
    {
        return null !== $this->extraLargeBackgroundImage;
    }

    /**
     * @param bool $card
     */
    public function setCard(bool $card): void
    {
        $this->card = $card;
    }

    /**
     * @return bool
     */
    public function hasCard(): bool
    {
        return $this->card;
    }

    /**
     * @param bool $display
     */
    public function setDisplay(bool $display): void
    {
        $this->display = $display;
    }

    /**
     * @return bool
     */
    public function hasDisplay(): bool
    {
        return $this->display;
    }

    /**
     * @param bool $apl
     */
    public function setApl(bool $apl): void
    {
        $this->apl = $apl;
    }

    /**
     * @return bool
     */
    public function hasApl(): bool
    {
        return $this->apl;
    }
}
