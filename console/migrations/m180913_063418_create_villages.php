<?php

use yii\db\Migration;

/**
 * Class m180913_063418_create_villages
 */
class m180913_063418_create_villages extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('village', [
            'id'                => $this->primaryKey()->unsigned(),
            'name'              => $this->string(),
            'slug'              => $this->string(),
            'address'           => $this->string(),
            'phones'            => $this->string(),
            'url'               => $this->string(),
            'price_list'        => $this->string(),
            'logo'              => $this->string(),
            'region_id'         => $this->integer()->unsigned(),
            'image_id'          => $this->integer()->unsigned(),
            'electric'          => $this->boolean(),
            'gas'               => $this->boolean(),
            'water'             => $this->boolean(),
            'internet'          => $this->boolean(),
            'gas_boiler'        => $this->boolean(),
            'territory_control' => $this->boolean(),
            'fire_alarm'        => $this->boolean(),
            'security_alarm'    => $this->boolean(),
            'shop'              => $this->boolean(),
            'children_club'     => $this->boolean(),
            'sports_center'     => $this->boolean(),
            'sports_ground'     => $this->boolean(),
            'golf_club'         => $this->boolean(),
            'beach'             => $this->boolean(),
            'life_service'      => $this->boolean(),
            'forest'            => $this->boolean(),
            'reservoir'         => $this->boolean(),
            'description'         => $this->string(),
            'seo_description'         => $this->string(),
            'seo_title'         => $this->string(),
            'seo_keywords'         => $this->string(),
            'is_active'         => $this->boolean()->defaultValue(1),
            'is_deleted'        => $this->boolean()->defaultValue(0)
        ]);

        $this->createIndex('U_village_slug', 'region', 'slug', true);
        $this->createIndex('U_village_name', 'region', 'name', true);

        $this->createTable('village_image', [
            'id'         => $this->primaryKey()->unsigned(),
            'village_id' => $this->integer()->unsigned(),
            'file'       => $this->string(),
            'thumb'      => $this->string(),
            'sort'       => $this->integer()
        ]);

        $this->createTable('village_benefit', [
            'id'         => $this->primaryKey()->unsigned(),
            'village_id' => $this->integer()->unsigned(),
            'name'       => $this->string(),
            'text'       => $this->string(500)
        ]);

        $this->addForeignKey('FK_village_benefit_village', 'village_benefit', 'village_id', 'village', 'id');
        $this->addForeignKey('FK_village_region', 'village', 'region_id', 'region', 'id');
        $this->addForeignKey('FK_village_image_village', 'village_image', 'village_id', 'village', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('FK_village_region', 'village');
        $this->dropForeignKey('FK_village_image_village', 'village_image');
        $this->dropForeignKey('FK_village_benefit_village', 'village_benefit');

        $this->dropTable('village');
        $this->dropTable('village_image');
        $this->dropTable('village_benefit');
    }
}
