<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use linslin\yii2\curl;

class SiteController extends Controller
{
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

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    public function actionIndex()
    {
//        die(Yii::$app->getSecurity()->generatePasswordHash('12345678'));

        if (Yii::$app->user->isGuest) {
            return $this->redirect('/login');
        }

        return $this->render('index');
    }

    public function actionOpenDoor()
    {
        Yii::$app->response->format = yii\web\Response::FORMAT_JSON;

        if (Yii::$app->user->isGuest) {
            return [
                'success' => false,
                'message' => 'Authentication needed'
            ];
        }

        $curl = new curl\Curl();

        //get http://example.com/
        //$response = $curl->get(Yii::$app->params['IOT_DOOR_OPEN_URL']);
        $response = $curl->get('http://example.com/'); // faking

        if ($curl->errorCode === null) {
            return [
                'success' => true,
                'message' => 'Welcome Jamila!'
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Couldn\'t open the door... try to use window'
            ];
        }
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
