<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\Log;
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
        $response_data = [
            'success' => false,
            'message' => 'Unknown error'
        ];

        if (Yii::$app->user->isGuest) {
            $response_data['message'] = 'Authentication needed';
            return $response_data;
        }

        $curl = new curl\Curl();

        //get http://example.com/
        //$response = $curl->get(Yii::$app->params['IOT_DOOR_OPEN_URL']); // do not forget to convert JSON to array!!!
        $response = [
            'success' => false,
            'errors' => ['pir_sensor' => 'Man does not detected']
        ];

        if ($curl->errorCode === null) {

            if (!$response['success']) {
                $response_data['success'] = false;

                // most likely someone will try to open door without standing in front of it...
                if (isset($response['errors']['pir_sensor'])) {
                    $response_data['message'] = 'You have to be in front of the door';
                } else {
                    $response_data['message'] = 'Some internal error...';
                }
            } else {
                $response_data['success'] = true;
                $response_data['message'] = 'Welcome ' . Yii::$app->user->identity->firstname . '!';
            }
        } else {
            $response_data['success'] = false;
            $response_data['message'] = 'Couldn\'t open the door... try to use window';
        }

        // adding to log
        Yii::$app->user->identity->onDoorOpen($response_data);

        return $response_data;
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
