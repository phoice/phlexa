<?php


namespace Phlexa\Request\Context;


/**
 * Interface ExtensionsInterface
 *
 * @package Phlexa\Request\Context
 */
interface ExtensionsInterface
{
    /**
     * @return array
     */
    public function getAvailable(): array;
}