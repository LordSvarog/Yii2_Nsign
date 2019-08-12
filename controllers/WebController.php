<?php

namespace app\controllers;

use \yii\web\Controller;
use \yii\web\Response;
use \yii;
/**
 * Class WebController
 *
 * @package app\controllers
 */
class WebController extends Controller
{
    /**
     * rendering robots.txt
     *
     * @return string
     *
     * @throws yii\base\InvalidConfigException
     * @throws yii\di\NotInstantiableException
     */
    public function actionIndex()
    {
        $response = Yii::$app->response;
        $response->format = Response::FORMAT_RAW;
        $response->headers->set('Content-Type', 'text/plain');

        $robots = Yii::$container->get('Robo');

        return $robots->render();
    }
    /**
     * save robots.txt from admin settings
     *
     * @throws yii\base\InvalidConfigException
     *
     * return message
     */
    public function actionSave()
    {
        $res = '';
        $robots = Yii::$container->get('Robo');
        if ($robots->save())
            $res = 1;
        else
            $res = -1;

        return Yii::$app->response->redirect(['/site/about', 'res' => $res]);
    }
}
