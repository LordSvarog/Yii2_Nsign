<?php

namespace app\components\redirect\adapters;

use app\components\redirect\csv\CsvDecodeInterface;

class CsvAdapter implements SourceAdapterInterface
{
    /**
     * @var string path to file .csv
     */
    public $file;
    /**
     * @var array parameters for redirect
     */
    public $params;
    /**
     * @var CsvDecodeInterface
     */
    public $decoder;
    /**
     * CsvAdapter constructor.
     * @param CsvDecodeInterface $decoder
     */
    public function __construct(CsvDecodeInterface $decoder)
    {
        $this->decoder = $decoder;
    }
    /**
     * Return data for redirect
     *
     * @return array
     */
    public function find(): array
    {
        $url = \Yii::$app->request->url;

        if ($pointer = $this->decoder->open($this->file)) {

            while (($data = $this->decoder->decode($pointer)) !== FALSE) {
                $rule = array_combine($this->params, $data);

                if ($rule['from'] == $url) {
                    $this->decoder->close($pointer);
                    return $rule;
                }
            }
            $this->decoder->close($pointer);
        }

        return [];
    }
}