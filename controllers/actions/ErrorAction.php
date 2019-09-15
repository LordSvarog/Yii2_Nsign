<?php

namespace app\controllers\actions;

use app\components\redirect\RedirectInterface;
use yii\base\Controller;

/**
 * Class ErrorAction
 * @package app\controllers\actions
 */
class ErrorAction extends \yii\web\ErrorAction
{
    /**
     * @var RedirectInterface
     */
    private $redirect;

    /**
     * ErrorAction constructor.
     *
     * @param string $id
     * @param Controller $controller
     * @param RedirectInterface $redirect
     * @param array $config
     */
    public function __construct(string $id, Controller $controller, RedirectInterface $redirect, array $config = [])
    {
        parent::__construct($id, $controller, $config);
        $this->redirect = $redirect;
    }
    /**
     * @return string|\yii\console\Response|\yii\web\Response
     *
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\di\NotInstantiableException
     */
    public function run()
    {
        if (\Yii::$app->response->statusCode === 404) {

            if ($rule = $this->redirect->findRule())
                return \Yii::$app->getResponse()->redirect($rule['to'], $rule['status']);
        }

        return parent::run();
    }
}