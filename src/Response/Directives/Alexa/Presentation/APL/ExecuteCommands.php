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

namespace Phlexa\Response\Directives\Alexa\Presentation\APL;

use Phlexa\Response\Directives\DirectivesInterface;

/**
 * Class ExecuteCommands
 *
 * @package Phlexa\Response\Directives\Alexa\Presentation\APL
 */
class ExecuteCommands implements DirectivesInterface
{
    /** Type of directive */
    public const DIRECTIVE_TYPE = 'Alexa.Presentation.APL.ExecuteCommands';

    /** @var string */
    private $token;

    /** @var CommandInterface[] */
    private $commands = [];

    /**
     * ExecuteCommands constructor.
     *
     * @param string $token
     * @param array  $commands
     */
    public function __construct(string $token, array $commands)
    {
        $this->token    = $token;
        $this->commands = $commands;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return self::DIRECTIVE_TYPE;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $data = [
            'type'     => $this->getType(),
            'token'    => $this->token,
            'commands' => [],
        ];

        foreach ($this->commands as $command) {
            if (!$command instanceof CommandInterface) {
                continue;
            }

            $data['commands'][] = $command->toArray();
        }

        return $data;
    }
}
