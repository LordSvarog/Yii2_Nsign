<?php

namespace app\components\robots\generators;
/**
 * Class AllowGenerator
 *
 * @package app\components\robots\generators
 */
class AllowGenerator implements GeneratorDirectiveInterface
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
            $allow = explode(PHP_EOL, $data);
            foreach ($allow as $item) {
                $result .= 'Allow: ' . $item . PHP_EOL;
            }
        }

        return $result;
    }
}