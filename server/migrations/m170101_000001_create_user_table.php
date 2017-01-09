<?php

use yii\db\Migration;

/**
 * Class m170101_000000_create_task_type_table.
 * Миграция для создания таблицы типов проекта.
 */
class m170101_000000_create_task_type_table extends Migration
{

    protected $tableName = '{{%task_type}}';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable($this->tableName, [
            'id'   => $this->primaryKey(),
            'name' => $this->string(255),
        ], $tableOptions);

        $this->insert($this->tableName, [
            'name' => 'Task',
        ]);
        $this->insert($this->tableName, [
            'name' => 'Bug',
        ]);
        $this->insert($this->tableName, [
            'name' => 'New Feature',
        ]);

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }
}
