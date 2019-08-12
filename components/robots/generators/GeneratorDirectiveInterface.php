<?php

namespace app\components\robots\generators;
/**
 * Interface GeneratorRobotsTxtInterface
 *
 * @package app\components\robots\generators
 */
interface GeneratorDirectiveInterface
{
    /**
     * @param string $data
     *
     * @return string
     */
    public function generate($data): string;
}