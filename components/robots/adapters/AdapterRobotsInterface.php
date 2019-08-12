<?php

namespace app\components\robots\adapters;

/**
 * Interface AdapterRobotsInterface
 *
 * @package app\components\robots\adapters
 */
interface AdapterRobotsInterface
{
    /**
     * @param string $path
     * @param array $dirs
     *
     * @return boolean
     */
    public function render($path, array $dirs): bool;
}