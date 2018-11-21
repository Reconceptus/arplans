<?php

use yii\db\Migration;

/**
 * Class m181121_064621_add_seo_to_categories
 */
class m181121_064621_add_seo_to_categories extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('shop_category', 'seo_description', $this->string());
        $this->addColumn('shop_category', 'seo_title', $this->string());
        $this->addColumn('shop_category', 'seo_keywords', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('shop_category', 'seo_description');
        $this->dropColumn('shop_category', 'seo_title');
        $this->dropColumn('shop_category', 'seo_keywords');
    }

}
