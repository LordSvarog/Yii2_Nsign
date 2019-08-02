<?php

namespace app\controllers;

use app\components\robots\adapters\AdapterRobotsInterface;
use \yii\web\Controller;
use \yii\web\Response;
use \yii\base\Module;
use \yii;
/**
 * Class WebController
 *
 * @package app\controllers
 */
class WebController extends Controller
{
    /**
     * @var AdapterRobotsInterface
     */
    protected $robots;
    /**
     * WebController constructor.
     *
     * @param string $id
     * @param Module $module
     * @param AdapterRobotsInterface $robots
     * @param array $config
     */
    public function __construct (string $id, Module $module, AdapterRobotsInterface $robots, array $config = [])
    {
        parent::__construct($id, $module, $config);

        $this->robots = $robots;
    }
    /**
     * rendering robots.txt @return string
     */
    public function actionIndex()
    {
        require_once "../files/DataForRobotsTxt.php";

        $response = Yii::$app->response;
        $response->format = Response::FORMAT_RAW;
        $response->headers->set('Content-Type', 'text/plain');

        return $this->robots->render($data);
    }
}
