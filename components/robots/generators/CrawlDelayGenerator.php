<?php

namespace app\components\robots\generators;
/**
 * Class CrawlDelayGenerator
 *
 * @package app\components\robots\generators
 */
class CrawlDelayGenerator implements GeneratorDirectiveInterface
{
    /**
     * @param string $data
     *
     * @return string
     */
    public function generate($data): string
    {
        $result = !empty($data) ? 'Crawl-delay: ' . $data : '';

        return $result;
    }
}