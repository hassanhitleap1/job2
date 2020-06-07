<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%university}}`.
 */
class m200607_141502_create_university_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%university}}', [
            'id' => $this->primaryKey(),
            'name'=>$this->primaryKey(),
            'created_at'=>$this->dateTime(),
            'updated_at'=>$this->dateTime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%university}}');
    }
}
