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
 * Class ScrollToIndex
 *
 * @package Phlexa\Response\Directives\Alexa\Presentation\APL\Command
 */
class ScrollToIndex implements CommandInterface
{
    use OptionalPropertiesTrait;

    /** Type of command */
    public const COMMAND_TYPE = 'ScrollToIndex';

    /** @var string */
    private $componentId;

    /** @var int */
    private $index;

    /** @var string|null */
    private $align;

    /**
     * ScrollToIndex constructor.
     *
     * @param string $componentId
     * @param int    $index
     */
    public function __construct(string $componentId, int $index)
    {
        $this->componentId = $componentId;
        $this->index       = $index;
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
            'index'       => $this->index,
        ];

        if ($this->align) {
            $data['align'] = $this->align;
        }

        $data = $this->addOptionalFields($data);

        return $data;
    }
}
