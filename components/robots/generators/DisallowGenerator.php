<?php

namespace app\components\robots\generators;
/**
 * Class DisallowGenerator
 *
 * @package app\components\robots\generators
 */
class DisallowGenerator implements GeneratorDirectiveInterface
{
    /**
     * @param string $data
     *
     * @return string
     */
    public function generate($data): string
    {
        $result = '';

        if (!empty($data)) {
            $disallow = explode(PHP_EOL, $data);
            foreach ($disallow as $item) {
                $result .= 'Disallow: ' . $item . PHP_EOL;
            }

            return $result;
        }
    }
}