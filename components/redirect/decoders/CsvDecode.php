<?php

namespace app\components\redirect\decoders;

class CsvDecode implements DecodeInterface
{
    /**
     * @var string path to file .csv
     */
    public $file;
    /**
     * open stream from file .decoders
     * @param $file
     *
     * @return bool|resource
     */
    public function open()
    {
        return fopen($this->file, "r") ?? false;
    }
    /**
     * close stream from file .decoders
     *
     * @param $pointer
     */
    public function close($pointer)
    {
        fclose($pointer);
    }

    /**
     * @return array
     */
    public function decode(): array
    {
        $rules = [];
        if ($pointer = $this->open()) {

            while (($data = fgetcsv($pointer, 1000, ",")) !== FALSE) {
                $rules[] = $data;
            }
            $this->close($pointer);
        }
        return $rules;
    }
}