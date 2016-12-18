<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Класс модели для сущности отчеты.
 *
 * @property integer $id
 * @property string $title
 * @property string $comments
 * @property string $date
 * @property integer $project_id
 * @property integer $hours
 */
class Reports extends ActiveRecord
{
    /**
     * Переопределенный метод. Возвращает имя таблицы.
     *
     * return string
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%reports}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                [
                    'title',
                    'comments',
                    'date',
                    'project_id',
                    'hours'
                ],
                'required'
            ],
            [
                ['comments'],
                'string'
            ],
            [
                ['date'],
                'filter',
                'filter' => function ($value) {
                    $date = new \DateTime($value);
                    return $date->format('Y-m-d');
                }
            ],
            [
                ['date'],
                'safe'
            ],
            [
                ['project_id'],
                'integer'
            ],
            [
                ['title'],
                'string',
                'max' => 255
            ],
            [
                ['hours'],
                'double',
                'min' => 0,
                'max' => 24.0
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'         => 'ID',
            'title'      => 'Title',
            'comments'   => 'Comments',
            'date'       => 'Date',
            'project_id' => 'Project ID',
            'hours'      => 'Hours',
        ];
    }

    /**
     * Переопределенный метод, возвращающий поля сущьности.
     *
     * return array
     * @inheritdoc
     */
    public function fields()
    {
        return [
            'id'         => 'id',
            'title'      => 'title',
            'comments'   => 'comments',
            'date'       => 'date',
            'project_id' => 'project_id',
            'hours'      => 'hours',
        ];
    }
}
