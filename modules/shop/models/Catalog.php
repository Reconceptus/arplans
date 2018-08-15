<?php

namespace modules\shop\models;

/**
 * This is the model class for table "shop_catalog".
 *
 * @property string $id
 * @property string $slug
 * @property string $name
 * @property int $type
 * @property int $view_type
 * @property int $cart
 * @property int $order
 * @property int $filter
 * @property int $sort
 *
 * @property CatalogCategory[] $catalogCategories
 * @property CatalogItem[] $catalogItems
 */
class Catalog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shop_catalog';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['type', 'view_type', 'cart', 'order', 'filter', 'sort'], 'integer'],
            [['slug', 'name'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['slug'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'        => 'ID',
            'slug'      => 'Url',
            'name'      => 'Название',
            'type'      => 'Тип',
            'view_type' => 'Вид отображения',
            'cart'      => 'Показывать в корзине',
            'order'     => 'Показывать в заказе',
            'filter'    => 'Показывать в фильтрах',
            'sort'      => 'Сортировка',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCatalogCategories()
    {
        return $this->hasMany(CatalogCategory::className(), ['catalog_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCatalogItems()
    {
        return $this->hasMany(CatalogItem::className(), ['catalog_id' => 'id']);
    }
}
