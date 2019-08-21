<?php

namespace app\components\redirect;

use app\components\redirect\adapters\SourceAdapterInterface;

/**
 * Class Redirect
 *
 * @package app\components\redirect
 */
class Redirect implements RedirectInterface
{
    /**
     * $var SourceAdapterInterface
     */
    private $adapter;
    /**
     * Redirect constructor
     *
     * @param SourceAdapterInterface $adapter
     */
    public function __construct(SourceAdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }
    /**
     * @return array|false
     * @throws \yii\base\InvalidConfigException
     */
    public function findRule()
    {
        $adapter = $this->adapter;

        if ($rule = $adapter->find())
            return $rule;
        return false;
    }
}