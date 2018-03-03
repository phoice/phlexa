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

namespace Phlexa\Response\Directives\Display;

/**
 * Class TextContent
 *
 * @package Phlexa\Response\Directives\Display
 */
class TextContent
{
    /** All back button types */
    const TYPE_PLAIN_TEXT = 'PlainText';
    const TYPE_RICH_TEXT = 'RichText';

    /** Allowed template types */
    const ALLOWED_TYPES = [self::TYPE_PLAIN_TEXT, self::TYPE_RICH_TEXT];

    /** @var string */
    private $primaryText;

    /** @var string */
    private $primaryType = self::TYPE_PLAIN_TEXT;

    /** @var string */
    private $secondaryText;

    /** @var string */
    private $secondaryType = self::TYPE_PLAIN_TEXT;

    /** @var string */
    private $tertiaryText;

    /** @var string */
    private $tertiaryType = self::TYPE_PLAIN_TEXT;

    /**
     * TextContent constructor.
     *
     * @param string      $primaryText
     * @param string|null $primaryType
     * @param string|null $secondaryText
     * @param string|null $secondaryType
     * @param string|null $tertiaryText
     * @param string|null $tertiaryType
     */
    public function __construct(
        string $primaryText,
        string $primaryType = null,
        string $secondaryText = null,
        string $secondaryType = null,
        string $tertiaryText = null,
        string $tertiaryType = null
    ) {
        $this->primaryText   = $primaryText;
        $this->primaryType   = $this->checkType($primaryType);
        $this->secondaryText = $secondaryText;
        $this->secondaryType = $this->checkType($secondaryType);
        $this->tertiaryText  = $tertiaryText;
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
            'primaryText'   => [
                'text' => $this->primaryText,
                'type' => $this->primaryType,
            ],
            'secondaryText' => [
                'text' => $this->secondaryText ?? '',
                'type' => $this->secondaryType,
            ],
            'tertiaryText'  => [
                'text' => $this->tertiaryText ?? '',
                'type' => $this->tertiaryType,
            ],
        ];

        return $data;
    }
}
