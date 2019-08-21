<?php

namespace app\components\redirect\adapters;

use app\components\redirect\decoders\DecodeInterface;

class Adapter implements SourceAdapterInterface
{
    /**
     * @var array parameters for redirect
     */
    public $params;
    /**
     * @var DecodeInterface
     */
    public $decoder;
    /**
     * CsvAdapter constructor.
     * @param DecodeInterface $decoder
     */
    public function __construct(DecodeInterface $decoder)
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

        if (($rules = $this->decoder->decode()) == FALSE)
            return [];

        foreach ($rules as $rule) {
            $rule = array_combine($this->params, $rule);

            if ($rule['from'] == $url)
                return $rule;
        }
    }
}