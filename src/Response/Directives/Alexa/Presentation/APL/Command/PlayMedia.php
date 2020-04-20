<?php


namespace Phlexa\Response\Directives\Alexa\Presentation\APL\Command;


use Phlexa\Response\Directives\Alexa\Presentation\APL\CommandInterface;

class PlayMedia implements CommandInterface
{
    use OptionalPropertiesTrait;

    /** Type of command */
    public const COMMAND_TYPE = 'PlayMedia';

    /** @var array */
    private $arguments = [];

    /** @var array */
    private $components = [];

    /** @var string */
    private $source;

    /** @var string */
    private $audioTrack;

    /** @var string */
    private $componentId;

    /**
     * SendEvent constructor.
     *
     * @param string $source
     * @param string $audioTrack
     * @param string $componentId
     */
    public function __construct(string $source, string $componentId, string $audioTrack = "foreground")
    {
        $this->source      = $source;
        $this->componentId = $componentId;
        $this->audioTrack  = $audioTrack;
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
            'type'       => $this->getType(),
            'componentId'=> $this->componentId,
            'source'     => $this->source,
            'audioTrack' => $this->audioTrack,
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