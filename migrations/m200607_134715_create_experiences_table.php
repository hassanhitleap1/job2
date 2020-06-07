<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%experiences}}`.
 */
class m200607_134715_create_experiences_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%experiences}}', [
            'id' => $this->primaryKey(),
            'user_id'=>$this->integer(),
            'job_title'=>$this->string(255),
            'month_from_exp'=>$this->integer(),
            'year_from_exp'=>$this->integer(),
            'month_to_exp'=>$this->integer(),
            'year_to_exp'=>$this->integer(),
            'facility_name'=>$this->string(255),
            'created_at'=>$this->dateTime(),
            'updated_at'=>$this->dateTime(),
        ],$tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%experiences}}');
    }
}
