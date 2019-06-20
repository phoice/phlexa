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
 * Class SetState
 *
 * @package Phlexa\Response\Directives\Alexa\Presentation\APL\Command
 */
class SetState implements CommandInterface
{
    use OptionalPropertiesTrait;

    /** Type of command */
    public const COMMAND_TYPE = 'SetState';

    /** @var string */
    private $state;

    /** @var bool */
    private $value;

    /** @var string|null */
    private $componentId;

    /**
     * SetState constructor.
     *
     * @param string $state
     * @param bool   $value
     */
    public function __construct(string $state, bool $value)
    {
        $this->state = $state;
        $this->value = $value;
    }

    /**
     * @param string $componentId
     */
    public function setComponentId(string $componentId): void
    {
        $this->componentId = $componentId;
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
            'type'  => $this->getType(),
            'state' => $this->state,
            'value' => $this->value,
        ];

        if ($this->componentId) {
            $data['componentId'] = $this->componentId;
        }

        $data = $this->addOptionalFields($data);

        return $data;
    }
}
