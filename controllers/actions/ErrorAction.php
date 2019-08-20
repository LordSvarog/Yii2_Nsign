<?php

namespace app\controllers\actions;

/**
 * Class ErrorAction
 * @package app\controllers\actions
 */
class ErrorAction extends \yii\web\ErrorAction
{
    /**
     * @return string|\yii\console\Response|\yii\web\Response
     *
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\di\NotInstantiableException
     */
    public function run()
    {
        if (\Yii::$app->response->statusCode === 404) {
            $redirect = \Yii::$container->get('Redirect');

            if ($rule = $redirect->findRule())
                return \Yii::$app->getResponse()->redirect($rule['to'], $rule['status']);
        }

        return parent::run();
    }
}