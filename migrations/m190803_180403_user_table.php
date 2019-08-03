<?php

use yii\db\Migration;

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
            'phone' => $this->integer(),
            'nationality' => $this->integer(),
            'certificates' => $this->text(),
            'experience' => $this->text(),
            'governorate' => $this->integer()->notNull(),
            'area' => $this->string(),
            'expected_salary' => $this->integer(),
            'note' => $this->text(),
            //'verification_token', $this->string()->defaultValue(null),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey(
            'fk-nationality-nationality',
            'user',
            'nationality',
            'nationality',
            'id',
            'CASCADE'
        );
    
        $this->addForeignKey(
            'fk-governorate-governorate',
            'user',
            'governorate',
            'governorate',
            'id',
            'CASCADE'
        );

    }
    public function down()
    {
        $this->dropForeignKey(
            'fk-governorate-governorate',
            'user'
        );
        
        $this->dropForeignKey(
            'fk-nationality-nationality',
            'user'
        );
        
        $this->dropTable('{{%user}}');
    }
}