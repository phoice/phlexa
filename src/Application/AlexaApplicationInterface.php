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

namespace Phlexa\Application;

use Phlexa\Request\Exception\BadRequest;

/**
 * Interface AlexaApplicationInterface
 *
 * @package Phlexa\Application
 */
interface AlexaApplicationInterface
{
    /**
     * Execute the application
     *
     * @return array
     * @throws BadRequest
     */
    public function execute(): array;
}
