<?php
declare(strict_types=1);

namespace Phlexa\Request\RequestType\UserEvent;

/**
 * Interface UserEventInterface
 *
 * @package Phlexa\Request\RequestType\UserEvent
 */
interface UserEventInterface
{
    /**
     * @return array
     */
    public function getArguments(): array;

    /**
     * @return string
     */
    public function getToken(): string;

    /**
     * @return array
     */
    public function getComponents():array;

    /**
     * @param string $key
     *
     * @return string
     */
    public function getComponentValue(string $key): string;

    /**
     * @param string $key
     *
     * @return bool
     */
    public function hasValidComponentValue(string $key):bool;
}