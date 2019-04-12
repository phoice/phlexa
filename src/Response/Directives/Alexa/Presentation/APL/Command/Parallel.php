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
 * Class Parallel
 *
 * @package Phlexa\Response\Directives\Alexa\Presentation\APL\Command
 */
class Parallel implements CommandInterface
{
    use OptionalPropertiesTrait;

    /** Type of command */
    public const COMMAND_TYPE = 'Parallel';

    /** @var CommandInterface[] */
    private $commands = [];

    /**
     * Parallel constructor.
     *
     * @param CommandInterface[] $commands
     */
    public function __construct(array $commands)
    {
        $this->commands = $commands;
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
            'type'     => $this->getType(),
            'commands' => [],
        ];

        foreach ($this->commands as $command) {
            if (!$command instanceof CommandInterface) {
                continue;
            }

            $data['commands'][] = $command->toArray();
        }

        $data = $this->addOptionalFields($data);

        return $data;
    }
}
