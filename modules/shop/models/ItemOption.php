<?php

namespace modules\shop\models;

/**
 * This is the model class for table "shop_item_option".
 *
 * @property int $id
 * @property int $item_id
 * @property int $catalog_id
 * @property int $catalog_item_id
 *
 * @property Item $item
 * @property Catalog $catalog
 * @property CatalogItem $catalogItem
 */
class ItemOption extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shop_item_option';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item_id', 'catalog_id', 'catalog_item_id'], 'integer'],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Item::className(), 'targetAttribute' => ['item_id' => 'id']],
            [['catalog_id'], 'exist', 'skipOnError' => true, 'targetClass' => Catalog::className(), 'targetAttribute' => ['catalog_id' => 'id']],
            [['catalog_item_id'], 'exist', 'skipOnError' => true, 'targetClass' => CatalogItem::className(), 'targetAttribute' => ['catalog_item_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'item_id' => 'Item ID',
            'catalog_id' => 'Catalog ID',
            'catalog_item_id' => 'Catalog Item ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Item::className(), ['id' => 'item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCatalog()
    {
        return $this->hasOne(Catalog::className(), ['id' => 'catalog_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCatalogItem()
    {
        return $this->hasOne(CatalogItem::className(), ['id' => 'catalog_item_id']);
    }
}
