<?php

use yii\db\Migration;

/**
 * Class m180919_115936_add_fields_to_partners
 */
class m180919_115936_add_fields_to_partners extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('', 'description', $this->text());
        $this->addColumn('partner', 'seo_description', $this->string());
        $this->addColumn('partner', 'seo_title', $this->string());
        $this->addColumn('partner', 'seo_keywords', $this->string());
        $this->addColumn('village', 'description', $this->text());
        $this->addColumn('village', 'seo_description', $this->string());
        $this->addColumn('village', 'seo_title', $this->string());
        $this->addColumn('village', 'seo_keywords', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('partner', 'description');
        $this->dropColumn('partner', 'seo_description');
        $this->dropColumn('partner', 'seo_title');
        $this->dropColumn('partner', 'seo_keywords');
        $this->dropColumn('village', 'description');
        $this->dropColumn('village', 'seo_description');
        $this->dropColumn('village', 'seo_title');
        $this->dropColumn('village', 'seo_keywords');
    }
}
