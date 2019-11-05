<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cobon}}`.
 */
class m191105_102750_create_cobon_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%cobon}}', [
            'id' => $this->primaryKey(),
            'active'=>$this->tinyInteger()->defaultValue(1), // 1 active // 0 desactive
            'used'=>$this->tinyInteger()->defaultValue(0), // 1 used // 0 unuserd
            'number_cobon'=> $this->string(),
            'distributor_id'=>$this->integer()->defaultValue(null),
            'used_by'=>$this->integer()->defaultValue(null),
            'created_at' =>$this->timestamp()->defaultValue(null),
            'updated_at' => $this->timestamp()->defaultValue(null),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%cobon}}');
    }
}
