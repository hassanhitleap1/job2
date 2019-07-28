<?php

use yii\db\Migration;

/**
 * Class m190728_142645_area
 */
class m190728_142645_area extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%area}}', [
            'id' => $this->primaryKey(),
            'name_ar' => $this->string(),

        ], $tableOptions);
    }
    public function down()
    {
        $this->dropTable('{{%area}}');
    }
}