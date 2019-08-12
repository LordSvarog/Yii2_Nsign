<?php

namespace app\components\robots\generators;
/**
 * Interface GeneratorRobotsTxtInterface
 *
 * @package app\components\robots\generators
 */
interface GeneratorRobotsTxtInterface
{
    /**
     * @return string
     */
    public function create(): string;
}
