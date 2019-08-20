<?php

namespace app\components\redirect\adapters;

interface SourceAdapterInterface
{
    /**
     * Return data for redirect
     *
     * @return array
     */
    public function find(): array;
}