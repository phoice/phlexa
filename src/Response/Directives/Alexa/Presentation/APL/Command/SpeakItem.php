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

namespace Phlexa\Response\Directives\Alexa\Presentation\APL\Command;

use Phlexa\Response\Directives\Alexa\Presentation\APL\CommandInterface;

/**
 * Class SpeakItem
 *
 * @package Phlexa\Response\Directives\Alexa\Presentation\APL\Command
 */
class SpeakItem implements CommandInterface
{
    use OptionalPropertiesTrait;

    /** Type of command */
    public const COMMAND_TYPE = 'SpeakItem';

    /** @var string */
    private $componentId;

    /** @var string|null */
    private $align;

    /** @var string|null */
    private $highlightMode;

    /**
     * SpeakItem constructor.
     *
     * @param string $componentId
     */
    public function __construct(string $componentId)
    {
        $this->componentId = $componentId;
    }

    /**
     * @param string $align
     */
    public function setAlign(string $align): void
    {
        $this->align = $align;
    }

    /**
     * @param string $highlightMode
     */
    public function setHighlightMode(string $highlightMode): void
    {
        $this->highlightMode = $highlightMode;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return self::COMMAND_TYPE;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $data = [
            'type'        => $this->getType(),
            'componentId' => $this->componentId,
        ];

        if ($this->align) {
            $data['align'] = $this->align;
        }

        if ($this->highlightMode) {
            $data['highlightMode'] = $this->highlightMode;
        }

        $data = $this->addOptionalFields($data);

        return $data;
    }
}
