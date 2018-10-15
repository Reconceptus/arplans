<?php

use yii\db\Migration;

/**
 * Class m181015_102002_add_lat_lng_to_builder
 */
class m181015_102002_add_lat_lng_to_builder extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('builder', 'lat', $this->string(10));
        $this->addColumn('builder', 'lng', $this->string(10));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('builder', 'lat');
        $this->dropColumn('builder', 'lng');
    }
}
