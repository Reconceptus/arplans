<?php

use yii\db\Migration;

/**
 * Class m180920_141654_add_seo_fields_to_service
 */
class m180920_141654_add_seo_fields_to_service extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('shop_service', 'seo_description', $this->string());
        $this->addColumn('shop_service', 'seo_title', $this->string());
        $this->addColumn('shop_service', 'seo_keywords', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('shop_service', 'seo_description');
        $this->dropColumn('shop_service', 'seo_title');
        $this->dropColumn('shop_service', 'seo_keywords');
    }
}
