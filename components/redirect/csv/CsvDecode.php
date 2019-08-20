<?php

namespace app\components\redirect\csv;

class CsvDecode implements CsvDecodeInterface
{
    /**
     * open stream from file .csv
     * @param $file
     *
     * @return bool|resource
     */
    public function open($file)
    {
        return fopen($file, "r") ?? false;
    }
    /**
     * close stream from file .csv
     *
     * @param $pointer
     */
    public function close($pointer)
    {
        fclose($pointer);
    }

    /**
     * @param $pointer
     *
     * @return array|null
     */
    public function decode($pointer)
    {
        return fgetcsv($pointer, 1000, ",");
    }
}