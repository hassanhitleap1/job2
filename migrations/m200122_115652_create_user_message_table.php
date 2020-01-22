<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_message}}`.
 */
class m200122_115652_create_user_message_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_message}}', [
            'id' => $this->primaryKey(),
            'text'=> $this->text(),
            'user_id'=>$this->integer(),
            'created_at'=>$this->dateTime(),
            'updated_at'=>$this->dateTime(),
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_message}}');
    }
}
