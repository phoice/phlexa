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

namespace Phlexa\Request\RequestType\UserEvent;

use function count;

class UserEvent implements UserEventInterface
{
    /** @var array */
    private $arguments;

    /** @var string */
    private $token;

    /** @var array */
    private $components;

    /**
     * UserEvent constructor.
     *
     * @param array  $arguments
     * @param string $token
     * @param array  $components
     */
    public function __construct(array $arguments, string $token, array $components)
    {
        $this->arguments  = $arguments;
        $this->token      = $token;
        $this->components = $components;
    }


    /**
     * @return array
     */
    public function getArguments(): array
    {
        return $this->arguments;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @return array
     */
    public function getComponents():array
    {
        return $this->components;
    }

    /**
     * @param string $key
     *
     * @return string
     */
    public function getComponentValue(string $key): string
    {
        return $this->components[$key];
    }

    /**
     * @param string $key
     *
     * @return bool
     */
    public function hasValidComponentValue(string $key):bool
    {
        return isset($this->components[$key]);
    }
}
