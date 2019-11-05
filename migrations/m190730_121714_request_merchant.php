<?php

use yii\db\Migration;

/**
 * Class m190730_121714_request_merchant
 */
class m190730_121714_request_merchant extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%request_merchant}}', [
            'id' => $this->primaryKey(),
            'job_title' => $this->string(),
            'desc_job' => $this->text(),
            'salary_from'=>$this->integer(),
            'salary_to'=>$this->integer(),
            'agree_from' => $this->integer(),
            'agree_to' => $this->integer(),
            'governorate'=>$this->integer(),
            'area'=>$this->integer(),
            'number_of_houer'=>$this->integer(),
            'nationality'=>$this->integer(),
            'note'=>$this->text(),
            'gender' => $this->tinyInteger()->defaultValue(0),
            'user_id'=>$this->integer(),
  
        ], $tableOptions);
    }
    public function down()
    {
        $this->dropTable('{{%request_merchant}}');
    }
}
