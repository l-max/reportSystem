<?php

namespace app\controllers;

use Yii;
use yii\rest\Controller;
use app\models\LoginForm;
use yii\filters\Cors;
use yii\helpers\ArrayHelper;

/**
 * Class UserController
 * Контроллер для авторизации пользователя.
 *
 * @package app\controllers
 */
class UserController extends Controller
{
    public function behaviors()
    {
        return
            ArrayHelper::merge(parent::behaviors(), [
                'corsFilter' => [
                    'class' => Cors::className(),
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