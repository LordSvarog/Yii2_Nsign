<?php

namespace app\components\robots\adapters;

/**
 * Interface AdapterInterface
 *
 * @package app\components\robots\adapters
 */
interface AdapterRobotsInterface
{
    /**
     * @param $data
     *
     * @return string
     */
    public function render($data): string;
}