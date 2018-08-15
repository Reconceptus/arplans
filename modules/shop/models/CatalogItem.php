<?php

namespace modules\shop\models;

/**
 * This is the model class for table "shop_catalog_item".
 *
 * @property string $id
 * @property string $catalog_id
 * @property string $slug
 * @property string $name
 * @property int $sort
 *
 * @property Catalog $catalog
 */
class CatalogItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shop_catalog_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['catalog_id', 'sort'], 'integer'],
            [['slug', 'name'], 'string', 'max' => 255],
            [['slug'], 'unique'],
            [['catalog_id'], 'exist', 'skipOnError' => true, 'targetClass' => Catalog::className(), 'targetAttribute' => ['catalog_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'catalog_id' => 'Catalog ID',
            'slug' => 'Slug',
            'name' => 'Name',
            'sort' => 'Sort',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCatalog()
    {
        return $this->hasOne(Catalog::className(), ['id' => 'catalog_id']);
    }
}
