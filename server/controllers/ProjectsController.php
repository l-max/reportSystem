<?php

namespace app\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use app\models\Projects;
use yii\filters\Cors;

/**
 * Class ProjectsController
 * Контроллер для api проектов.
 *
 * @package app\controllers
 */
class ProjectsController extends ActiveController
{
    public $modelClass = 'app\models\Projects';

    public function behaviors()
    {
        return
            ArrayHelper::merge(parent::behaviors(), [
                'corsFilter' => [
                    'class' => Cors::className(),
                ],
            ]);
    }

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
        return $actions;
    }

    /**
     * Метод осуществляет поиск всех проектов.
     *
     * @return ActiveDataProvider
     */
    public function actionIndex()
    {
        return new ActiveDataProvider([
            'query'      => Projects::find(),
            'pagination' => [
                'pageSize' => 1000,
            ],
        ]);
    }
}
