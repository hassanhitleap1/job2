<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%assigns}}`.
 */
class m191114_125053_create_assigns_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%assigns}}', [
            'id' => $this->primaryKey(),
            'assigns_for'=>$this->string(1200)->defaultValue(""),
            'assigns_to'=>$this->string(1200)->defaultValue(""),
            'user_id'=>$this->integer(),  
            'created_at' =>$this->timestamp()->defaultValue(null),
            'updated_at' => $this->timestamp()->defaultValue(null),

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%assigns}}');
    }
}
