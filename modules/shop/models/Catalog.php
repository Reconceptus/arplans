<?php

namespace modules\shop\models;

/**
 * This is the model class for table "shop_catalog".
 *
 * @property string $id
 * @property string $slug
 * @property string $name
 * @property int $category_id
 * @property int $type
 * @property int $view_type
 * @property int $cart
 * @property int $order
 * @property int $filter
 * @property int $basic
 * @property int $sort
 * @property int $columns_in_filter
 *
 * @property CatalogItem[] $catalogItems
 * @property Category $category
 */
class Catalog extends \yii\db\ActiveRecord
{
    const VIEW_CHECKBOX = 1;

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
            [['slug', 'name'], 'required'],
            [['type', 'view_type', 'cart', 'order', 'filter', 'basic', 'sort', 'category_id'], 'integer'],
            [['slug', 'name'], 'string', 'max' => 255],
            ['slug', 'match', 'pattern' => '/^[a-z]\w*$/i'],
            [['category_id', 'slug'], 'unique', 'targetAttribute' => ['category_id', 'slug'], 'message' => 'Комбинация выбранной категории и такого URL уже существует'],
            [['category_id', 'name'], 'unique', 'targetAttribute' => ['category_id', 'name'], 'message' => 'Комбинация выбранной категории и такого названия уже существует'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'          => 'ID',
            'category_id' => 'Категория',
            'slug'        => 'Url',
            'name'        => 'Название',
            'type'        => 'Тип',
            'view_type'   => 'Вид отображения',
            'cart'        => 'Показывать в корзине',
            'order'       => 'Показывать в заказе',
            'filter'      => 'Показывать в фильтрах',
            'basic'        => 'Показывать в основном',
            'sort'        => 'Сортировка',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCatalogItems()
    {
        return $this->hasMany(CatalogItem::className(), ['catalog_id' => 'id'])->orderBy(['sort' => SORT_ASC]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * Возвращает все каталоги относящиеся к категории, включая общие
     * @param $category_id
     * @return array|Catalog[]|Category[]|\yii\db\ActiveRecord[]
     */
    public static function getCategoryCatalogs($category_id)
    {
        $catalogs = self::find()
            ->where(['category_id' => $category_id])
            ->orWhere(['is', 'category_id', null])
            ->orderBy(['sort' => SORT_ASC])->all();
        return $catalogs;
    }
}
