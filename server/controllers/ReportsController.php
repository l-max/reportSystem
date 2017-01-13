<?php

namespace app\controllers;

use Yii;
use yii\filters\auth\HttpBasicAuth;
use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use app\models\Reports;
use yii\filters\Cors;

/**
 * Class ReportsController
 * Класс контроллера api для работы с отчетами.
 *
 * @package app\controllers
 */
class ReportsController extends ActiveController
{
    public $modelClass = 'app\models\Reports';

    public function behaviors()
    {
        return
            ArrayHelper::merge(parent::behaviors(), [
                'corsFilter' => [
                    'class' => Cors::className(),
                ],
                'authenticator' => [
                    'class' => HttpBasicAuth::className(),
                    'auth' => function ($username, $password) {
                            $user = \app\models\User::findOne(['username' => $username]);
                        return (Yii::$app->getSecurity()->validatePassword($password, $user->password_hash)) ? $user : null;
//                        if ($user->validatePassword($password))
//                                return $user;
//                            return null;
                        },
                ],
            ]);
    }

    public function actions(){
        $actions = parent::actions();
        unset($actions['index']);
        return $actions;
    }

    /**
     * Метод осуществляет поиск всех отчетов и сортирует по заданному полю.
     *
     * @return ActiveDataProvider
     */
    public function actionIndex()
    {
        $order = Yii::$app->request->getQueryParam('orderBy', null);

        if ($this->isSafeOrder($order)) {
            return new ActiveDataProvider([
                'query'      => Reports::find()->orderBy($order),
                'pagination' => [
                    'pageSize' => 5,
                ],
            ]);
        } else {
            return new ActiveDataProvider([
                'query'      => Reports::find(),
                'pagination' => [
                    'pageSize' => 5,
                ],
            ]);
        }

    }

    /**
     * Проверка параметра сортировки.
     *
     * @param $order string Параметр поиска.
     * @return bool
     */
    public function isSafeOrder($order)
    {
        $field = explode(' ', $order);
        $fields = (new Reports())->fields();

        return isset($fields[$field[0]]);
    }
}
