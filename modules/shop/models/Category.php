<?php

namespace modules\shop\models;

use yii\helpers\ArrayHelper;

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
 * @property Catalog[] $catalogs
 * @property Item[] $items
 */
class Category extends \yii\db\ActiveRecord
{
    const IS_ACTIVE = 1;
    const IS_NOT_ACTIVE = 0;

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
            'id'          => 'ID',
            'slug'        => 'Url',
            'name'        => 'Название',
            'description' => 'Описание',
            'image'       => 'Изображение',
            'sort'        => 'Сортировка',
            'is_active'   => 'Активна',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCatalogs()
    {
        return $this->hasMany(Catalog::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Item::className(), ['category_id' => 'id']);
    }

    /**
     * Получаем лист категорий
     * @return array
     */
    public static function getList()
    {
        $cache = \Yii::$app->cache;
        return $cache->getOrSet('categories-list', function ($cache) {
            return ArrayHelper::map(self::find()->where(['is_active' => self::IS_ACTIVE])->all(), 'id', 'name');
        }, 1000);
    }

    /**
     * Получаем категории для партнера
     * @return array
     */
    public static function getPartnerCategories()
    {
        $cache = \Yii::$app->cache;
        return $cache->getOrSet('categories-list', function ($cache) {
            return ArrayHelper::map(self::find()->where(['is_active' => self::IS_ACTIVE])->all(), 'id', 'name');
        }, 1000);
    }
}
