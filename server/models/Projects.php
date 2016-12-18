<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
/**
 * Класс модели для сущности проекты.
 *
 * @property integer $id
 * @property string $name
 */
class Projects extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%projects}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }
}
