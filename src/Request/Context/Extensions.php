<?php


namespace Phlexa\Request\Context;

/**
 * Class Extensions
 *
 * @package Phlexa\Request\Context
 */
class Extensions implements ExtensionsInterface
{
    /** @var array */
    private $available;

    /**
     * Extensions constructor.
     *
     * @param array $available
     */
    public function __construct(array $available)
    {
        $this->available = $available;
    }


    /**
     * @return array
     */
    public function getAvailable(): array
    {
        return $this->available;
    }

    /**
     * @param array $available
     */
    public function setAvailable(array $available): void
    {
        $this->available = $available;
    }
}
