<?php

use yii\db\Migration;

/**
 * Class m190728_091754_requast_job
 */
class m190728_091754_requast_job extends Migration
{

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%requast_job}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'agree' => $this->integer(),
            'phone' => $this->integer(),
            'nationality'=>$this->integer(),
            'certificates'=>$this->text(),
            'experience'=>$this->text(),
            'governorate'=>$this->integer(),
            'expected_salary'=>$this->integer(),
            'note'=>$this->text(),

        ], $tableOptions);
    }
    public function down()
    {
        $this->dropTable('{{%requast_job}}');
    }



}
