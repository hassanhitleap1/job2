<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_message_whatsapp}}`.
 */
class m200607_140612_create_user_message_whatsapp_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_message_whatsapp}}', [
            'id' => $this->primaryKey(),
            'user_id'=>$this->integer(),
            'text'=>$this->text(),
            'marchent_id'=>$this->integer(),
            'created_at'=>$this->dateTime(),
            'updated_at'=>$this->dateTime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_message_whatsapp}}');
    }
}
