<?php

use yii\db\Migration;

/**
 * Class m180918_122304_add_coordinates_to_village
 */
class m180918_122304_add_coordinates_to_village extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('village', 'lat', $this->string(10));
        $this->addColumn('village', 'lng', $this->string(10));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('village', 'lat');
        $this->dropColumn('village', 'lng');
    }
}
