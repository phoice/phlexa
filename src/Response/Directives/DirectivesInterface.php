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

namespace Phlexa\Response\Directives;

/**
 * Interface DirectivesInterface
 *
 * @package Phlexa\Response\Directives
 */
interface DirectivesInterface
{
    /**
     * Get the directive type
     *
     * @return string
     */
    public function getType(): string;

    /**
     * Render the directives object to an array
     *
     * @return array
     */
    public function toArray(): array;
}
