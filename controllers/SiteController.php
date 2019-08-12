<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\PhoneNumber;
use app\models\XmlDataModel;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
      $objects = PhoneNumber::find()->all();

      return $this->render('index', ['phone_numbers' => $objects]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     * @throws yii\base\InvalidConfigException
     */
    public function actionAbout()
    {
        $xmlData = new XmlDataModel();

        $productsFile = '../files/products.xml';
        $categoriesFile = '../files/categories.xml';
        $filteredResultData = $xmlData->getData($productsFile, $categoriesFile);
        $searchModel = $xmlData->getModel();

        $dataProvider = new \yii\data\ArrayDataProvider([
        'key'=>'id',
        'allModels' => $filteredResultData,
        'pagination' => [
          'pageSize' => 5,
        ],
        'sort' => [
          'attributes' => ['id', 'price', 'hidden', 'category'],
        ],
        ]);

        $res = Yii::$app->request->getQueryParam('res') ?? 0;
        $mes = '';
        switch($res){
            case 0:
                $mes = "Заполните необходимые директивы!";break;
            case -1:
                $mes = "Ошибка при сохранении, попробуйте позднее!";break;
            case 1:
                $mes = "Сохранение настроек прошло успешно!";break;
        }

        $robots = Yii::$container->get('Robo');
        $dirs = $robots->check();

        return $this->render('about', ['dataProvider' => $dataProvider, 'searchModel' => $searchModel, 'mes' => $mes, 'robots' => $dirs]);
    }
}
