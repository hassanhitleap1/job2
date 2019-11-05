<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%distributor}}`.
 */
class m191105_102931_create_distributor_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%distributor}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'phone' => $this->string(),
            'count_cobon' => $this->integer(),
            'created_at' =>$this->timestamp()->notNull(),
            'updated_at' => $this->timestamp()->defaultValue(null),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%distributor}}');
    }
}
