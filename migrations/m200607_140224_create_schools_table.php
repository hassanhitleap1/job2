<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%schools}}`.
 */
class m200607_140224_create_schools_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%schools}}', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(255),
            'created_at'=>$this->dateTime(),
            'updated_at'=>$this->dateTime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%schools}}');
    }
}
