<?php

use yii\db\Migration;
use app\models\User;

/**
 * Class m190803_180403_user_table
 */
class m190803_180403_user_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->unique(),
            'name' => $this->string(),
            'auth_key' => $this->string(32),
            'password_hash' => $this->string(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->unique(),
            'status' => $this->smallInteger()->defaultValue(10),
            'agree' => $this->integer(),
            'phone' => $this->string(),
            'nationality' => $this->integer()->defaultValue(-1),
            'certificates' => $this->text(),
            'experience' => $this->text(),
            'governorate' => $this->integer()->defaultValue(-1),
            'area' => $this->string(),
            'expected_salary' => $this->integer(),
            'note' => $this->text(),
            'type'=>$this->smallInteger()->defaultValue(User::NORMAL_USER),
            'name_company' => $this->string(),
            'auth_token'=> $this->string()->defaultValue(null),
            'subscribe_date'=>$this->date()->defaultValue(null),
            'avatar'=>$this->string()->defaultValue(null),
            'gender' => $this->tinyInteger()->defaultValue(0),
            'affiliated_to' => $this->string()->defaultValue(null),
            'affiliated_with' => $this->string()->defaultValue(null),
            'interview_time' => $this->string()->defaultValue(null),
            'year_of_experience' => $this->double()->defaultValue(0.0),
            'created_at' =>$this->timestamp()->notNull(),
            'updated_at' => $this->timestamp()->defaultValue(null),
        ], $tableOptions);

        // $this->addForeignKey(
        //     'fk-nationality-nationality',
        //     'user',
        //     'nationality',
        //     'nationality',
        //     'id',
        //     'CASCADE'
        // );
    
        // $this->addForeignKey(
        //     'fk-governorate-governorate',
        //     'user',
        //     'governorate',
        //     'governorate',
        //     'id',
        //     'CASCADE'
        // );

    }
    public function down()
    {
        // $this->dropForeignKey(
        //     'fk-governorate-governorate',
        //     'user'
        // );
        
        // $this->dropForeignKey(
        //     'fk-nationality-nationality',
        //     'user'
        // );
        
        $this->dropTable('{{%user}}');
    }
}
