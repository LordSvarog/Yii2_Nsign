<?php

namespace app\components\redirect;

use app\components\redirect\decoders\DecodeInterface;

/**
 * Class Redirect
 *
 * @package app\components\redirect
 */
class Redirect implements RedirectInterface
{
    /**
     * $var DecodeInterface
     */
    private $decoder;
    /**
     * @var array parameters for redirect
     */
    public $params;
    /**
     * Redirect constructor
     *
     * @param DecodeInterface $decoder
     */
    public function __construct(DecodeInterface $decoder)
    {
        $this->decoder = $decoder;
    }
    /**
     * @return array|false
     * @throws \yii\base\InvalidConfigException
     */
    public function findRule()
    {
        $url = \Yii::$app->request->url;

        if (($rules = $this->decoder->decode()) == FALSE)
            return false;

        foreach ($rules as $rule) {
            $rule = array_combine($this->params, $rule);

            if ($rule['from'] == $url)
                return $rule;
        }

        return false;
    }
}