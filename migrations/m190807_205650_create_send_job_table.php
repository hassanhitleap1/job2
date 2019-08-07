<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%send_job}}`.
 */
class m190807_205650_create_send_job_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%send_job}}', [
            'id' => $this->primaryKey(),
            'title'=>$this->string(),
            'body' => $this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%send_job}}');
    }
}
