<?php

use yii\db\Migration;
use app\models\Nationality;

/**
 * Class m190728_091833_nationalities
 */
class m190728_091833_nationalities extends Migration
{
    public $data=[['name_ar'=>'اردني'],['name_ar' => 'فلسطيني'],['name_ar' => 'سوري'], ['name_ar' => 'جبوتي'], 
        ['name_ar' => 'لبناني'], ['name_ar' => 'سعودي'], 
        ['name_ar' => 'قطري'], ['name_ar' => 'كويتي'], ['name_ar' => 'اماراتي'],
        ['name_ar' => 'يمني'], ['name_ar' => 'عماني'],
        ['name_ar' => 'بحريني'], ['name_ar' => 'مصري'], ['name_ar' => 'سوداني'],
        ['name_ar' => 'جزائري'], ['name_ar' => 'تونسي'], ['name_ar' => 'مغربي'],
        ['name_ar' => 'مورتاني'], ['name_ar' => 'عراقي'], ['name_ar' => 'صومالي'],
        ['name_ar' => 'ليبي']
    ];
    public $data2 = ['اردني', 'فلسطيني','سوري','جبوتي',
        'لبناني', 'سعودي', 'قطري','كويتي', 'اماراتي','يمني','عماني','بحريني', 'مصري', 'سوداني', 'جزائري', 'تونسي', 'مغربي','مورتاني','عراقي','صومالي', 'ليبي'];
    
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

      
        Yii::$app->db
            ->createCommand()
            ->batchInsert('nationality', ['name_ar'], $this->data)
            ->execute();
    }
    public function down()
    {
        $this->dropTable('{{%nationality}}');
    }
}
