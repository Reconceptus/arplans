<?php

use yii\db\Migration;

/**
 * Class m181126_072854_add_alt_to_images
 */
class m181126_072854_add_alt_to_images extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('builder_image', 'alt', $this->string());
        $this->addColumn('village_image', 'alt', $this->string());
        $this->addColumn('shop_item_image', 'alt', $this->string());
        $this->addColumn('shop_service_image', 'alt', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('builder_image', 'alt');
        $this->dropColumn('village_image', 'alt');
        $this->dropColumn('shop_item_image', 'alt');
        $this->dropColumn('shop_service_image', 'alt');
    }
}
