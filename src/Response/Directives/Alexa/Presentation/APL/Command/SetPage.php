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
 * Class SetPage
 *
 * @package Phlexa\Response\Directives\Alexa\Presentation\APL\Command
 */
class SetPage implements CommandInterface
{
    use OptionalPropertiesTrait;

    /** Type of command */
    public const COMMAND_TYPE = 'SetPage';

    /** @var string */
    private $componentId;

    /** @var int */
    private $value;

    /** @var string|null */
    private $position;

    /**
     * SetPage constructor.
     *
     * @param string $componentId
     * @param int    $value
     */
    public function __construct(string $componentId, int $value)
    {
        $this->componentId = $componentId;
        $this->value       = $value;
    }

    /**
     * @param string $position
     */
    public function setPosition(string $position): void
    {
        $this->position = $position;
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
            'value'       => $this->value,
        ];

        if ($this->position) {
            $data['position'] = $this->position;
        }

        $data = $this->addOptionalFields($data);

        return $data;
    }
}
