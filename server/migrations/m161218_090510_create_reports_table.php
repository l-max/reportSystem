<?php

use yii\db\Migration;
use app\models\Reports;

/**
 * Class m161218_090510_create_reports_table.
 * Миграция для создания таблицы отчетов.
 */
class m161218_090510_create_reports_table extends Migration
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

        $this->createTable ('{{%reports}}', [
            'id'         => $this->primaryKey(),
            'title'      => $this->string(255)->notNull(),
            'comments'   => $this->text(),
            'date'       => $this->date()->notNull(),
            'project_id' => $this->integer()->notNull(),
            'hours'      => $this->double()->notNull(),
        ], $tableOptions);

        // creates index for column `project_id`
        $this->createIndex(
            'idx-reports-project_id',
            'reports',
            'project_id'
        );

        // add foreign key for table `projects`
        $this->addForeignKey(
            'fk-reports-project_id',
            'reports',
            'project_id',
            'projects',
            'id',
            'CASCADE'
        );
        $this->insert('{{%reports}}', [
            'title'      => 'Реализовать систему учёта рабочего времени',
            'comments'   => 'Система учёта рабочего времени реализована как тестовое задание. В процессе создания приложения были
            изучены AngularJs, Bootstrap и Yii2 RESTful API. Реализовано: полностью весь backend (db, yii2 rest)',
            'date'       => '2016-12-14',
            'project_id' => 1,
            'hours'      => '6',
        ]);
        $this->insert('{{%reports}}', [
            'title'      => 'Реализовать систему учёта рабочего времени',
            'comments'   => 'Реализован основной функционал на фронтенде. Angular стабильно работает в связке с yii.',
            'date'       => '2016-12-15',
            'project_id' => 1,
            'hours'      => '5',
        ]);
        $this->insert('{{%reports}}', [
            'title'      => 'Реализовать систему учёта рабочего времени',
            'comments'   => 'Доработан функционал на клиенте и сервере: сортировка, лоадер, пагинация и т.д.',
            'date'       => '2016-12-16',
            'project_id' => 1,
            'hours'      => '5',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        // drops foreign key for table `projects`
        $this->dropForeignKey(
            'fk-reports-project_id',
            'reports'
        );

        // drops index for column `project_id`
        $this->dropIndex(
            'idx-reports-project_id',
            'reports'
        );
        $this->dropTable('{{%reports}}');
    }
}
