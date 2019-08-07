<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%categories}}`.
 */
class m190806_111421_create_categories_table extends Migration
{
    
    public $data = [
        ['name_ar' => 'وظائف فندقة مطاعم'],
        ['name_ar' => 'وظائف فنيين وحرفين'],
        ['name_ar' => 'وظائف صحه وجمال'],
        ['name_ar' => 'وظائف مبيعات'],
        ['name_ar' => 'وظائف تدريس ودورات تدريب'],
        ['name_ar' => 'وظائف سائقين وتوصيل'],
        ['name_ar' => 'وظائف طب تمريض صيدلة'],
        ['name_ar' => 'وظائف  اداره سكراريا'],
        ['name_ar' => 'وظائف تسويق'],
        ['name_ar' => 'تصميم'],
        ['name_ar' => 'محاسبه ومالية'],
        ['name_ar' => 'هندسة'],
        ['name_ar' => 'مكانيك سيارات']
    ];
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%categories}}', [
            'id' => $this->primaryKey(),
            'name_ar'=>$this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%categories}}');
    }
}
