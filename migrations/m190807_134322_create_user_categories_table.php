<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_categories}}`.
 */
class m190807_134322_create_user_categories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_categories}}', [
            'id' => $this->primaryKey(),
            'user_id'=>$this->integer(),
            'category_id'=>$this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_categories}}');
    }
}
