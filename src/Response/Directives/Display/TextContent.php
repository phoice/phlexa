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

namespace Phlexa\Response\Directives\Display;

/**
 * Class TextContent
 *
 * @package Phlexa\Response\Directives\Display
 */
class TextContent
{
    /** All back button types */
    public const TYPE_PLAIN_TEXT = 'PlainText';
    public const TYPE_RICH_TEXT  = 'RichText';

    /** Line break for display */
    public const BREAK_DISPLAY = '<br/>';

    /** Allowed template types */
    public const ALLOWED_TYPES = [self::TYPE_PLAIN_TEXT, self::TYPE_RICH_TEXT];

    /** @var string */
    private $largeText;

    /** @var string */
    private $primaryType = self::TYPE_PLAIN_TEXT;

    /** @var string */
    private $mediumText;

    /** @var string */
    private $secondaryType = self::TYPE_PLAIN_TEXT;

    /** @var string */
    private $shortText;

    /** @var string */
    private $tertiaryType = self::TYPE_PLAIN_TEXT;

    /**
     * TextContent constructor.
     *
     * @param string      $largeText
     * @param string|null $primaryType
     * @param string|null $mediumText
     * @param string|null $secondaryType
     * @param string|null $shortText
     * @param string|null $tertiaryType
     */
    public function __construct(
        string $largeText,
        string $primaryType = null,
        string $mediumText = null,
        string $secondaryType = null,
        string $shortText = null,
        string $tertiaryType = null
    ) {
        $this->largeText     = $largeText;
        $this->primaryType   = $this->checkType($primaryType);
        $this->mediumText    = $mediumText;
        $this->secondaryType = $this->checkType($secondaryType);
        $this->shortText     = $shortText;
        $this->tertiaryType  = $this->checkType($tertiaryType);
    }

    /**
     * @param string $type
     *
     * @return string
     */
    private function checkType($type): string
    {
        if (!in_array($type, self::ALLOWED_TYPES)) {
            $type = self::TYPE_PLAIN_TEXT;
        }

        return $type;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $data = [
            'largeText'  => [
                'text' => $this->largeText,
                'type' => $this->primaryType,
            ],
            'mediumText' => [
                'text' => $this->mediumText ?? '',
                'type' => $this->secondaryType,
            ],
            'shortText'  => [
                'text' => $this->shortText ?? '',
                'type' => $this->tertiaryType,
            ],
        ];

        return $data;
    }
}
