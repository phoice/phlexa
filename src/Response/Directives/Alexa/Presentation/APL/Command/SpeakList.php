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
 * Class SpeakList
 *
 * @package Phlexa\Response\Directives\Alexa\Presentation\APL\Command
 */
class SpeakList implements CommandInterface
{
    use OptionalPropertiesTrait;

    /** Type of command */
    public const COMMAND_TYPE = 'SpeakList';

    /** @var string */
    private $componentId;

    /** @var string */
    private $count;

    /** @var string */
    private $start;

    /** @var int|null */
    private $minimumDwellTime;

    /** @var string|null */
    private $align;

    /**
     * SpeakList constructor.
     *
     * @param string $componentId
     * @param string $count
     * @param string $start
     */
    public function __construct(string $componentId, string $count, string $start)
    {
        $this->componentId = $componentId;
        $this->count       = $count;
        $this->start       = $start;
    }

    /**
     * @param int $minimumDwellTime
     */
    public function setMinimumDwellTime(int $minimumDwellTime): void
    {
        $this->minimumDwellTime = $minimumDwellTime;
    }

    /**
     * @param string $align
     */
    public function setAlign(string $align): void
    {
        $this->align = $align;
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
            'count' => $this->count,
            'start' => $this->start,
        ];

        if ($this->minimumDwellTime) {
            $data['minimumDwellTime'] = $this->minimumDwellTime;
        }

        if ($this->align) {
            $data['align'] = $this->align;
        }

        $data = $this->addOptionalFields($data);

        return $data;
    }
}
