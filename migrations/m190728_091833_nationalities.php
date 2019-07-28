<?php

use yii\db\Migration;

/**
 * Class m190728_091833_nationalities
 */
class m190728_091833_nationalities extends Migration
{

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%nationality}}', [
            'id' => $this->primaryKey(),
            'name_ar' => $this->string()
        ], $tableOptions);
    }
    public function down()
    {
        $this->dropTable('{{%nationality}}');
    }
}
