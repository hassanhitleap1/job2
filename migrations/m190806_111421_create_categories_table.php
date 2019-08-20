<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%categories}}`.
 */
class m190806_111421_create_categories_table extends Migration
{
    
    public $data = [
        ['name_ar' => 'اي شيء'],
        ['name_ar' => ' فندقة مطاعم'],
        ['name_ar' => ' فنيين وحرفين'],
        ['name_ar' => ' صحه وجمال'],
        ['name_ar' => ' مبيعات'],
        ['name_ar' => ' تدريس ودورات تدريب'],
        ['name_ar' => ' سائقين وتوصيل'],
        ['name_ar' => ' طب تمريض صيدلة'],
        ['name_ar' => ' اداره سكراريا'],
        ['name_ar' => ' تسويق'],
        ['name_ar' => 'تصميم'],
        ['name_ar' => 'محاسبه ومالية'],
        ['name_ar' => 'هندسة'],
        ['name_ar' => 'مكانيك سيارات'],
        ['name_ar' => 'انتاج واعلام'],
        ['name_ar' => 'حراسه وامن'],
        ['name_ar' => 'العلوم الطبيعية والرعايه الصحية'],  
        ['name_ar' => 'قانوم ومحاماه'],
        ['name_ar' => 'صحه وجمال'],
        ['name_ar' => 'سياحة وسفر'], 
        ['name_ar' => 'كتابة محتوى وترجمة'], 
        ['name_ar' => 'وظائف موارد بشرية'], 
        ['name_ar' => 'وظائف تأمين'],
        ['name_ar' => 'خدمة عملاء'],
        ['name_ar' => 'تسويق هاتفي'],


      
        
    ];
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%categories}}', [
            'id' => $this->primaryKey(),
            'name_ar'=>$this->string(),
        ], $tableOptions);
        Yii::$app->db
            ->createCommand()
            ->batchInsert('categories', ['name_ar'], $this->data)
            ->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%categories}}');
    }
}
