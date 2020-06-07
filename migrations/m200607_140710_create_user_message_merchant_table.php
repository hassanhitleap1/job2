<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_message_merchant}}`.
 */
class m200607_140710_create_user_message_merchant_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_message_merchant}}', [
            'id' => $this->primaryKey(),
            'user_id'=>$this->integer(),
            'text'=>$this->text(),
            'created_at'=>$this->dateTime(),
            'updated_at'=>$this->dateTime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_message_merchant}}');
    }
}
