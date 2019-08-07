<?php

use yii\db\Migration;

/**
 * Handles adding category_id to table `{{%requast_marchent}}`.
 */
class m190807_132604_add_category_id_column_to_requast_marchent_table extends Migration
{
    
    public function safeUp()
    {
        $this->addColumn('{{%request_merchant}}', 'category_id', $this->integer()->defaultValue(-1));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%request_merchant}}', 'category_id');
    }
}
