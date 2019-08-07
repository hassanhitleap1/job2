<?php

use yii\db\Migration;
use app\models\User;

/**
 * Class m190807_211440_add_user_admin
 */
class m190807_211440_add_user_admin extends Migration
{
  
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $data = [[
            'username' => 'hassanki',
            'name' => 'hassan',
            'password_hash' => Yii::$app->getSecurity()->generatePasswordHash("programerhk92"),
            'email' => 'hasasnkiwan92@gmail.com',
            'agree' => 27,
            'phone' => "0799263494",
            'type' => User::ADMIN_USER,
        ]];
        Yii::$app->db
            ->createCommand()
            ->batchInsert('user', ['username', "name", "password_hash", "email", "agree", "phone", "type"], $data)
            ->execute();
    }   

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "add admin user.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190807_211440_add_user_admin cannot be reverted.\n";

        return false;
    }
    */
}
