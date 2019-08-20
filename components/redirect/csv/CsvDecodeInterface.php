<?php

namespace app\components\redirect\csv;

interface CsvDecodeInterface
{
    /**
     * open stream from file .csv
     * @param $file
     *
     * @return bool|resource
     */
    public function open($file);
    /**
     * close stream from file .csv
     *
     * @param $pointer
     */
    public function close($pointer);
    /**
     * @param $pointer
     *
     * @return array|null
     */
    public function decode($pointer);
}