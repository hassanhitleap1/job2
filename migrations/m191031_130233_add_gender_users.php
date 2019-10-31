<?php

use yii\db\Migration;

/**
 * Class m191031_130233_add_gender_users
 */
class m191031_130233_add_gender_users extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%users}}', 'gender' , $this->tinyInteger()->defaultValue(0));
        $this->addColumn('{{%request_merchant}}', 'gender' , $this->tinyInteger()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%users}}', 'gender');
        $this->dropColumn('{{%request_merchant}}', 'gender');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191031_130233_add_gender_users cannot be reverted.\n";

        return false;
    }
    */
}
