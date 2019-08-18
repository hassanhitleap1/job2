<?php

use yii\db\Migration;

/**
 * Class m190818_124757_add_category_user
 */
class m190818_124757_add_category_user extends Migration
{
    public function up()
    {
        $this->addColumn('{{%user}}', 'category_id', $this->integer()->defaultValue(null));
    }
    public function down()
    {
        $this->dropColumn('{{%user}}', 'category_id');
    }
    
}
