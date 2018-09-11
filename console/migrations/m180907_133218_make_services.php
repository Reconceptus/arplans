<?php

use yii\db\Migration;

/**
 * Class m180907_133218_make_services
 */
class m180907_133218_make_services extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('shop_service', 'time', $this->string());
        $this->addColumn('shop_service', 'short_description', $this->string());

        $this->createTable('shop_service_image', [
            'id'         => $this->primaryKey()->unsigned(),
            'service_id' => $this->integer()->unsigned(),
            'file'      => $this->string(),
            'thumb'      => $this->string(),
            'sort'       => $this->integer()
        ]);
        $this->addForeignKey('FK_service_image_service', 'shop_service_image', 'service_id', 'shop_service', 'id');

        $this->createTable('shop_service_file', [
            'id'         => $this->primaryKey()->unsigned(),
            'service_id' => $this->integer()->unsigned(),
            'file'       => $this->string(),
            'sort'       => $this->integer()
        ]);
        $this->addForeignKey('FK_service_file_service', 'shop_service_file', 'service_id', 'shop_service', 'id');

        $this->createTable('shop_service_benefit', [
            'id'         => $this->primaryKey(),
            'service_id' => $this->integer()->unsigned(),
            'name'       => $this->string(),
            'text'       => $this->string(500)
        ]);
        $this->addForeignKey('FK_service_benefit_service', 'shop_service_benefit', 'service_id', 'shop_service', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('FK_service_image_service', 'shop_service_image');
        $this->dropForeignKey('FK_service_file_service', 'shop_service_file');
        $this->dropForeignKey('FK_service_benefit_service', 'shop_service_benefit');
        $this->dropTable('shop_service_image');
        $this->dropTable('shop_service_file');
        $this->dropTable('shop_service_benefit');
        $this->dropColumn('shop_service', 'time');
        $this->dropColumn('shop_service', 'short_description');
    }
}
