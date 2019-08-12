<?php

namespace app\components\robots\generators;
/**
 * Class CleanParamGenerator
 *
 * @package app\components\robots\generators
 */
class CleanParamGenerator implements GeneratorDirectiveInterface
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
            $cleanParam = explode(PHP_EOL, $data);
            foreach ($cleanParam as $item) {
                $result .= 'Clean-param: ' . $item . PHP_EOL;
            }
        }

        return $result;
    }
}