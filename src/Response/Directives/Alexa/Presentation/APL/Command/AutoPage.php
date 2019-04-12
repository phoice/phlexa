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
 * Class AutoPage
 *
 * @package Phlexa\Response\Directives\Alexa\Presentation\APL\Command
 */
class AutoPage implements CommandInterface
{
    use OptionalPropertiesTrait;

    /** Type of command */
    public const COMMAND_TYPE = 'AutoPage';

    /** @var string */
    private $componentId;

    /** @var int|null */
    private $count;

    /** @var int|null */
    private $duration;

    /**
     * AutoPage constructor.
     *
     * @param string $componentId
     */
    public function __construct(string $componentId)
    {
        $this->componentId = $componentId;
    }

    /**
     * @param int $count
     */
    public function setCount(int $count): void
    {
        $this->count = $count;
    }

    /**
     * @param int $duration
     */
    public function setDuration(int $duration): void
    {
        $this->duration = $duration;
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

        if ($this->count) {
            $data['count'] = $this->count;
        }

        if ($this->duration) {
            $data['duration'] = $this->duration;
        }

        $data = $this->addOptionalFields($data);

        return $data;
    }
}
