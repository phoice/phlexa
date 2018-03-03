<?php
/**
 * Build voice applications for Amazon Alexa with phlexa and PHP
 *
 * @author     Ralf Eggert <ralf@travello.audio>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/phoice/phlexa
 * @link       https://www.phoice.tech/
 *
 */

namespace Phlexa\Response\Directives\AudioPlayer;

use Phlexa\Response\Directives\DirectivesInterface;

/**
 * Class Stop
 *
 * @package Phlexa\Response\Directives\AudioPlayer
 */
class Stop implements DirectivesInterface
{
    /** @var string */
    private $type = 'AudioPlayer.Stop';

    /**
     * Get the directive type
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Render the directives object to an array
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'type' => $this->type,
        ];
    }
}
