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

trait OptionalPropertiesTrait
{
    /** @var string|null */
    private $description;

    /** @var int */
    private $delay = 0;

    /** @var bool */
    private $when = true;

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @param int $delay
     */
    public function setDelay(int $delay): void
    {
        $this->delay = $delay;
    }

    /**
     * @param bool $when
     */
    public function setWhen(bool $when): void
    {
        $this->when = $when;
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function addOptionalFields(array $data): array
    {
        if ($this->description) {
            $data['description'] = $this->description;
        }

        if ($this->delay) {
            $data['delay'] = $this->delay;
        }

        if ($this->when) {
            $data['when'] = $this->when ? 'true' : 'false';
        }

        return $data;
    }
}
