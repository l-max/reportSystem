<?php

namespace app\controllers;

use Yii;
use yii\rest\Controller;
use app\models\LoginForm;
use yii\filters\Cors;
use yii\helpers\ArrayHelper;
use yii\filters\auth\HttpBearerAuth;

/**
 * Class ApiController
 * Контроллер для основных действий api.
 *
 * @package app\controllers
 */
class ApiController extends Controller
{
    public $modelClass = 'app\models\Projects';

    public function behaviors()
    {
        return
            ArrayHelper::merge(parent::behaviors(), [
                'corsFilter' => [
                    'class' => Cors::className(),
                ],
                'authenticator' => [
                    'class' => HttpBearerAuth::className(),
                    /*'auth' => function ($username, $password) {
                        $user = User::findOne(['username' => $username]);
                        return ($user->validatePassword($password)) ? $user : null;
                        },*/
                ],
            ]);
    }


    /**
     * Действие входа в систему.
     *
     * @return array|LoginForm
     */
    public function actionLogin()
    {
        $model = new LoginForm();
        if ($model->load(Yii::$app->getRequest()->getBodyParams(), '') && $model->login()) {
            return ['access_token' => Yii::$app->user->identity->getAuthKey()];
        } else {
            $model->validate();
            return $model;
        }
    }
}