<?php

namespace app\components\robots;

interface RobotsTxtInterface
{
    /**
     * @return string
     */
    public function render(): string;
    /**
     * @return boolean
     */
    public function save(): bool;
    /**
     * @return array
     */
    public function check(): array;
}