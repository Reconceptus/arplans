<?php

namespace modules\shop\models;

/**
 * This is the model class for table "shop_category".
 *
 * @property string $id
 * @property string $slug
 * @property string $name
 * @property string $description
 * @property string $image
 * @property int $sort
 * @property int $is_active
 *
 * @property CatalogCategory[] $shopCatalogCategories
 * @property Item[] $shopItems
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shop_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['slug', 'name'], 'required'],
            [['description'], 'string'],
            [['sort', 'is_active'], 'integer'],
            [['slug', 'name'], 'string', 'max' => 255],
            [['image'], 'file', 'extensions' => 'png, jpg, gif', 'maxSize' => 1024 * 1024 * 3],
            [['slug'], 'unique'],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'slug' => 'Slug',
            'name' => 'Name',
            'description' => 'Description',
            'image' => 'Image',
            'sort' => 'Sort',
            'is_active' => 'Is Active',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCatalogCategories()
    {
        return $this->hasMany(CatalogCategory::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Item::className(), ['category_id' => 'id']);
    }
}
