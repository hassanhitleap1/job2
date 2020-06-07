<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%pages}}`.
 */
class m200121_123057_create_pages_table extends Migration
{

    public $data = [
        ['key' =>'growth-strategies' ,'title'=>'استراتجيات النمو' ,
            'text'=>"  <div>تشجيع الباحث عن العمل على التطوير الذاتي لمواكبة التغيرات في االسواق المحلية والعالمية</div>"],
        ['key' =>'our-goals' ,'title'=>'اهدافنا' ,
            'text'=>"<div>.استخدام احدث وسائل االستقطاب الوظيفي التي تلبي احتياجات
سوق العمل المتغير وتزويد المؤسسات بالموظف المناسب .</div><div><br></div><div>السهام في بناء ثقافة اإلرشاد الوظيفي لدى الباحث عن العمل حتى
يكون لديهم القدرة في الدخول الى سوق العمل .<br></div><div><br></div><div>تطوير القيم االخالقية واالجتماعية عند الباحثين عن العمل .<br></div><div><br></div><div>االسهام في إعطاء الباحثين عن العمل مهارات مختلفة الكسابهم
خبرات عملية لمواكبة سوق العمل .<br></div><div><br></div><div>مشاركة أصحاب العمل في تحسين األداء الوظيفي باعتبارهم احد
اهم ركائز العملية التوظيفية وأكثرها تأثيرا.<br></div><div><br></div><div> إقامة شراكات فاعلة مع أصحاب المنشآت لزيادة الوعي بأهمية الثقافة
الوظيفيه لدى الباحثين عن العمل لألسهام في تلبية احتياجاتهم.<br></div><div><br></div>"],
        ['key' =>'our-vision' ,'title'=>'رؤيتنا' , 'text'=>"<blockquote><b>جرس شركاء في توظيف أفضل الكفاءات</b></blockquote>"],
        ['key' =>'our-message' ,'title'=>'رسالتنا ' , 'text'=>"<div>نحن جزء ال يتجزأ من االقتصاد المحلي ومهمتنا تدور
حول تحريك عجلة االقتصاد وبذل جهودنا في حل
المعضلة العظمى \" البطالة \" من خالل تطوير
االستقطاب الوظيفي سعيا إلحداث فرق ايجابي في
ايجاد الكفاءات المناسبة وتوفير فرص وظيفية عادلة
للمواطن بما يلبي طموحاته الوظيفية</div>"],
        ['key' =>'about' ,'title'=>'عنا' , 'text'=>"<div>تأسست شركة جرس عام ٢٠١٩ ,كجزء من المشاريع الريادية التي
تصبو إلى تنشيط ورفع نسب التشغيل على المستوى المحلي
والدولي من خالل تسويق الكفاءات األردنية.
حيث نستخدم أحدث وسائل االتصال لتوفير النخبة األفضل من
الموارد البشرية , ويراعى في عملية االختيار دراسة حالة المتقدم
للعمل وتنمية قدراته بما يتالئم مع الوظائف المتاحة.
يقع مقر الشركة في العاصمة األردنية عمان</div>"],
        ['key' =>'rate-us' ,'title'=>'قيمنا' , 'text'=>"<div>العمل على تقديم أفضل الكفاءات من الموارد البشرية المتاحة لدينا
وتأهيل اآلخرين ليصبحوا على قدر عالي من الكفاءة ليتناسبوا مع
المتطلبات الوظيفية.</div><div><br></div><div>االلتزام بأعلى قيم النزاهة في التعامل مع الباحثين عن العمل ومد يد
العون لهم لرفع مستوى ادائهم . </div><div><br></div><div>تشجيع الموظفين على المشاركة في صناعة القرارات من خالل
التركيز على العمل بروح الفريق الواحد بما يلبي تطوير قدراتهم مما
يساعد على تلبية احتياجات صاحب العمل ومساهمة الشركة في
بلوغ طموحها .</div><div><br></div><div>نعزز لدى موظفينا ثقافة التميز والمنافسة بقوة من خالل التحفيز
المعنوي والمادي لدى كل فرد في فريق العمل للوفاء بالتزاماتهم تجاه
الشركة والعمالء.</div><div><br></div><div> نحترم قدرات الموظف ونرفع من مستوى كفاءته وذلك من خالل توفير
وسائل تدريبية متعددة و مستمرة . </div>"],
        ['key' =>'our-responsibility' ,'title'=>'مسؤولياتنا' , 'text'=>"<div>تجاه المنشآت :نعمل على مراعاة المواصفات الوظيفية التي يجب أن
يتحلى بها الموظف قبل ارساله للوظيفة المتاحة بالمنشأه ليكون قادرا
على اثبات قدرته لتعبئة هذا الشاغر بكفاءة .</div><div><br></div><div>اتجاه المتقدم للوظيفة : التعرف على صفات ومهارات المتقدم للوظيفة
اليجاد الشاغر الذي يليق به وتوفير التأهيل االحترافي للمتقدمين األقل
كفاءة ليصبحوا قادرين على مواجهة التحديات في سوق العمل المحلي
والدولي .<br></div><div><br></div><div>اتجاه أنفسنا : االلتزام في عمليات التدريب الدورية للموظفين ووضع
خطط وأهداف متجددة ومتسلسلة والتركيز على استقطاب الموظف
المناسب للمواصفات الوظيفية المطلوبة .<br></div><div><br></div><div>اتجاه المجتمعات : زيادة الوعي لدى األفراد بما يتعلق باالرشاد
الوظيفي واهميته لدخول سوق العمل ونشجع تطوره ونشارك في
تحقيق طموحاته لمستقبل افضل.<br></div>"],
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
        $this->createTable('{{%pages}}', [
            'id' => $this->primaryKey(),
            'key'=>$this->string(),
            'title'=>$this->string(200),
            'body'=>$this->text(),
            'created_at' =>$this->timestamp()->defaultValue(null),
            'updated_at' => $this->timestamp()->defaultValue(null),
        ],$tableOptions);
        Yii::$app->db
            ->createCommand()
            ->batchInsert('pages', ['key','title','text'], $this->data)
            ->execute();

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%pages}}');
    }
}
