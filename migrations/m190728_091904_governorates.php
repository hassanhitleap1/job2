<?php

use yii\db\Migration;

/**
 * Class m190728_091904_governorates
 */
class m190728_091904_governorates extends Migration
{
    public $data = [
        ['name_ar' => 'جرش'],
        ['name_ar' => 'عمان'],
        ['name_ar' => 'عجلون'],
        ['name_ar' => 'الزرقاء'],
        ['name_ar' => 'البلقاء'],
        ['name_ar' => 'اربد'],
        ['name_ar' => 'الكرك'],
        ['name_ar' => 'معان'],
        ['name_ar' => 'العقبة'],
        ['name_ar' => 'الطفيلة'],
        ['name_ar' => 'المفرق'],
        ['name_ar' => 'مادبا']
    ];
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%governorate}}', [
            'id' => $this->primaryKey(),
            'name_ar' => $this->string()
        ], $tableOptions);
        
        Yii::$app->db
            ->createCommand()
            ->batchInsert('governorate', ['name_ar'], $this->data)
            ->execute();
    }
    public function down()
    {
        $this->dropTable('{{%governorate}}');
    }
}
