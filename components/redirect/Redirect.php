<?php

namespace app\components\redirect;

/**
 * Class Redirect
 *
 * @package app\components\redirect
 */
class Redirect implements RedirectInterface
{
    /**
     * @return array|false
     * @throws \yii\base\InvalidConfigException
     */
    public function findRule()
    {
        $adapter = \Yii::$container->get($this->source_adapters['csv']);

        if ($rule = $adapter->find())
            return $rule;
        return false;
    }
}