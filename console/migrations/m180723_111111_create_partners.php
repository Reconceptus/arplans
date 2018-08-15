<?php

use common\models\Partner;
use yii\db\Migration;

/**
 * Class m180723_111111_create_partners
 */
class m180723_111111_create_partners extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('partner', [
            'id'   => $this->primaryKey()->unsigned(),
            'name' => $this->string(),
            'url'  => $this->string()
        ]);
        $this->addColumn('user', 'partner_id', $this->integer()->unsigned());
        $this->addForeignKey(
            'FK_user_partner_id',
            'user',
            'partner_id',
            'partner',
            'id',
            'SET NULL',
            'CASCADE'
        );

        $arplans = Partner::find()->where(['name' => 'Arplans'])->one();
        if (!$arplans) {
            $arplans = new Partner();
            $arplans->name = 'Arplans';
            $arplans->save();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('FK_user_partner_id', 'user');
        $this->dropTable('partner');
    }
}
