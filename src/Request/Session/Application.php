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

namespace Phlexa\Request\Session;

/**
 * Class Application
 *
 * @package Phlexa\Request\Session
 */
class Application implements ApplicationInterface
{
    /** @var string */
    private $applicationId;

    /**
     * Application constructor.
     *
     * @param string $applicationId
     */
    public function __construct(string $applicationId)
    {
        $this->applicationId = $applicationId;
    }

    /**
     * @return string
     */
    public function getApplicationId(): string
    {
        return $this->applicationId;
    }
}
