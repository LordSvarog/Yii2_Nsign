<?php

namespace app\controllers;

use app\components\robots\GeneratorRobotsTxtInterface;
use \yii\web\Controller;
use \yii\web\Response;
use \yii;

class WebController extends Controller
{
    public function actionIndex()
    {
        /**
         * @var GeneratorRobotsTxtInterface $generator
         */
        $generator = Yii::$app->robots;
        $response = Yii::$app->response;
        $response->format = Response::FORMAT_RAW;
        $response->headers->set('Content-Type', 'text/plain');

        return $generator->render();
    }
}
