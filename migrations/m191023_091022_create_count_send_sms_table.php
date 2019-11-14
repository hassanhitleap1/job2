<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%count_send_sms}}`.
 */
class m191023_091022_create_count_send_sms_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%count_send_sms}}', [
            'id' => $this->primaryKey(),
            'user_id'=>$this->integer()->notNull(),
            'count'=>$this->integer()->defaultValue(0)->notNull(),
            'created_at' =>$this->timestamp()->notNull(),
            'updated_at' => $this->timestamp()->defaultValue(null),

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%count_send_sms}}');
    }
}
