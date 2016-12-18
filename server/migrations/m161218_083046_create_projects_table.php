<?php

use yii\db\Migration;

/**
 * Class m161218_083046_create_projects_table.
 * Миграция для создания таблицы проектов.
 */
class m161218_083046_create_projects_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%projects}}', [
            'id'   => $this->primaryKey(),
            'name' => $this->string(255),
        ], $tableOptions);

        $this->insert('{{%projects}}', [
            'name' => 'Система учёта рабочего времени',
        ]);
        $this->insert('{{%projects}}', [
            'name' => 'Корпоративный портал',
        ]);

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%projects}}');
    }
}
