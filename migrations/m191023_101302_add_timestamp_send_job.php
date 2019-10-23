<?php

use yii\db\Migration;

/**
 * Class m191023_101302_add_timestamp_send_job
 */
class m191023_101302_add_timestamp_send_job extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%send_job}}', 'created_at' , $this->timestamp()->defaultValue(null));
        $this->addColumn('{{%send_job}}', 'updated_at' , $this->timestamp()->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%send_job}}', 'created_at');
        $this->dropColumn('{{%send_job}}', 'updated_at');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191023_101302_add_timestamp_send_job cannot be reverted.\n";

        return false;
    }
    */
}
