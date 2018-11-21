<?php

namespace modules\shop\models;

use modules\partner\models\PartnerCategory;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "shop_category".
 *
 * @property string $id
 * @property string $slug
 * @property string $name
 * @property string $description
 * @property string $seo_description
 * @property string $seo_title
 * @property string $seo_keywords
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
            [['slug', 'name', 'seo_description', 'seo_title', 'seo_keywords'], 'string', 'max' => 255],
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
            'id'              => 'ID',
            'slug'            => 'Url',
            'name'            => 'Название',
            'description'     => 'Описание',
            'seo_description' => 'Seo description',
            'seo_keywords'    => 'Seo keywords',
            'seo_title'       => 'Seo title',
            'image'           => 'Изображение',
            'sort'            => 'Сортировка',
            'is_active'       => 'Активна',
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
     * @param $partner_id
     * @return bool
     */
    public function isAllowToPartner($partner_id)
    {
        if (PartnerCategory::find()->where(['category_id' => $this->id, 'partner_id' => $partner_id])->exists()) {
            return true;
        }
        return false;
    }
}
