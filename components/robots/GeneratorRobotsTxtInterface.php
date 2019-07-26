<?php

namespace app\components\robots;
/**
 * Interface GeneratorRobotsTxtInterface
 *
 * @package app\components\robots
 */
interface GeneratorRobotsTxtInterface
{
    /**
     * @return string
     */
    public function render(): string;
}