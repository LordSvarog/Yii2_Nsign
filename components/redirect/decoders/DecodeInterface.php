<?php

namespace app\components\redirect\decoders;

interface DecodeInterface
{
    /**
     * @return array
     */
    public function decode(): array;
}