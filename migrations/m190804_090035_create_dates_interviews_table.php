<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%dates_interviews}}`.
 */
class m190804_090035_create_dates_interviews_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%dates_interviews}}', [
            'id' => $this->primaryKey(),
            'date_from'=>$this->dateTime(),
            'date_to'=>$this->dateTime(),
            'user_id'=>$this->integer(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%dates_interviews}}');
    }
}
