<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%educational_attainment}}`.
 */
class m200607_134659_create_educational_attainment_table extends Migration
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
        $this->createTable('{{%educational_attainment}}', [
            'id' => $this->primaryKey(),
            'user_id'=>$this->integer(),
            'specialization'=>$this->string(255),
            'university'=>$this->string(255),
            'year_get'=>$this->integer(),
            'created_at'=>$this->dateTime(),
            'updated_at'=>$this->dateTime(),
        ],$tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%educational_attainment}}');
    }
}
