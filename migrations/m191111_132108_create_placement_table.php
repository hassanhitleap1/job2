<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%placement}}`.
 */
class m191111_132108_create_placement_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%placement}}', [
            'id' => $this->primaryKey(),
            'user_id'=> $this->integer(),
            'placement_for'=> $this->integer()->defaultValue(-1),
            'placement_to'=> $this->integer()->defaultValue(-1),
            'note'=> $this->string(1200),
            'created_at' =>$this->timestamp()->notNull(),
            'updated_at' => $this->timestamp()->defaultValue(null),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%placement}}');
    }
}
