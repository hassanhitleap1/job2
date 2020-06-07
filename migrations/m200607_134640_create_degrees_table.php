<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%degrees}}`.
 */
class m200607_134640_create_degrees_table extends Migration
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
        $this->createTable('{{%degrees}}', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(255),
            'created_at'=>$this->dateTime(),
            'updated_at'=>$this->dateTime(),
        ],$tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%degrees}}');
    }
}
