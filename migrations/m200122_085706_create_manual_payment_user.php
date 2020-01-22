<?php

use yii\db\Migration;

/**
 * Class m200122_085706_create_manual_payment_user
 */
class m200122_085706_create_manual_payment_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%manual_payment_user}}', [
            'id' => $this->primaryKey(),
            'user_id'=>$this->integer(),
            'amount'=>$this->string(200),
            'created_at' =>$this->timestamp()->defaultValue(null),
            'updated_at' => $this->timestamp()->defaultValue(null),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%manual_payment_user}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200122_085706_create_manual_payment_user cannot be reverted.\n";

        return false;
    }
    */
}
