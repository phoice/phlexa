<?php


namespace Phlexa\Response\Directives\Alexa\Presentation\APL\Command;

use Phlexa\Response\Directives\Alexa\Presentation\APL\CommandInterface;

class ControlMedia implements CommandInterface
{
    use OptionalPropertiesTrait;

    /** Type of command */
    public const COMMAND_TYPE = 'ControlMedia';

    /** @var array */
    private $arguments = [];

    /** @var array */
    private $components = [];

    /** @var string */
    private $command;

    /** @var string */
    private $componentId;

    /**
     * SendEvent constructor.
     *
     * @param string $command
     * @param string $componentId
     */
    public function __construct(string $command, string $componentId)
    {
        $this->command      = $command;
        $this->componentId = $componentId;
    }


    /**
     * @param array $arguments
     */
    public function setArguments(array $arguments): void
    {
        $this->arguments = $arguments;
    }

    /**
     * @param array $components
     */
    public function setComponents(array $components): void
    {
        $this->components = $components;
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
            'command'     => $this->command,
        ];

        foreach ($this->arguments as $argument) {
            $data['arguments'][] = $argument;
        }

        foreach ($this->components as $component) {
            $data['components'][] = $component;
        }

        $data = $this->addOptionalFields($data);

        return $data;
    }
}
