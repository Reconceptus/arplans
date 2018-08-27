<?php

namespace modules\shop\models;


use yii\db\ActiveQuery;

/**
 * This is the model class for table "shop_item".
 *
 * @property string $id
 * @property string $category_id
 * @property string $slug
 * @property string $name
 * @property string $description
 * @property string $video
 * @property int $price
 * @property int $discount
 * @property int $image_id
 * @property int $rooms
 * @property int $bathrooms
 * @property int $live_area
 * @property int $common_area
 * @property int $useful_area
 * @property int $one_floor
 * @property int $two_floor
 * @property int $mansard
 * @property int $pedestal
 * @property int $cellar
 * @property int $garage
 * @property int $double_garage
 * @property int $tent
 * @property int $terrace
 * @property int $balcony
 * @property int $light2
 * @property int $pool
 * @property int $sauna
 * @property int $gas_boiler
 * @property int $is_new
 * @property int $is_active
 * @property int $is_deleted
 * @property int $sort
 *
 * @property Category $category
 * @property ItemImage $image
 * @property ItemOption[] $itemOptions
 * @property ItemImage[] $images
 */
class Item extends \yii\db\ActiveRecord
{
    const IS_ACTIVE = 1;
    const IS_NOT_ACTIVE = 0;

    const IS_DELETED = 1;
    const IS_NOT_DELETED = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shop_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'slug', 'category_id'], 'required'],
            [['category_id', 'price', 'rooms', 'bathrooms', 'discount', 'live_area', 'common_area', 'useful_area', 'one_floor', 'two_floor', 'mansard', 'pedestal', 'cellar', 'garage', 'double_garage', 'tent', 'terrace', 'balcony', 'light2', 'pool', 'sauna', 'gas_boiler', 'is_new', 'is_active', 'is_deleted', 'image_id', 'sort'], 'integer'],
            [['slug', 'name', 'video'], 'string', 'max' => 255],
            [['description'], 'string'],
            [['slug'], 'unique'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'            => 'ID',
            'category_id'   => 'Категория',
            'slug'          => 'Url',
            'name'          => 'Название',
            'description'   => 'Описание',
            'video'         => 'Видео',
            'image_id'      => 'Превью',
            'price'         => 'Цена',
            'discount'      => 'Скидка',
            'rooms'         => 'Количество комнат',
            'bathrooms'     => 'Количество санузлов',
            'live_area'     => 'Жилая площадь',
            'common_area'   => 'Общая площадь',
            'useful_area'   => 'Полезная площадь',
            'one_floor'     => 'Один этаж',
            'two_floor'     => 'Два этажа',
            'mansard'       => 'Мансарда',
            'pedestal'      => 'Цоколь',
            'cellar'        => 'Чердак',
            'garage'        => 'Гараж',
            'double_garage' => 'Гараж на 2 авто',
            'tent'          => 'Навес',
            'terrace'       => 'Терасса',
            'balcony'       => 'Балкон',
            'light2'        => 'Второй свет',
            'pool'          => 'Бассейк',
            'sauna'         => 'Сауна',
            'gas_boiler'    => 'Газовая котельная',
            'is_new'        => 'Новинка',
            'is_active'     => 'Активен',
            'is_deleted'    => 'Удален',
            'sort'          => 'Сортировка',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getItemOptions()
    {
        return $this->hasMany(ItemOption::className(), ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(ItemImage::className(), ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
        return $this->hasOne(ItemImage::className(), ['id' => 'image_id']);
    }

    /**
     * Получаем основное фото товара
     * @return string
     */
    public function getMainImage()
    {
        if ($this->image_id) {
            $image = $this->image->image;
        } elseif ($this->images) {
            $image = $this->images[0]->image;
        } else {
            $image = \Yii::$app->params['defaultImage'];
        }
        return $image;
    }


    public static function getFilteredQuery(Category $category, array $get)
    {
        // Делаем выборку товаров
        $query = Item::find()->alias('i')->distinct()
            ->leftJoin(ItemOption::tableName() . ' io', 'i.id=io.item_id')
            ->innerJoin(Category::tableName() . ' cat', 'i.category_id = cat.id')
            ->leftJoin(Catalog::tableName() . ' c', 'cat.id=c.category_id')
            ->where(['i.category_id' => $category->id])
            ->andWhere(['i.is_active' => Item::IS_ACTIVE])
            ->andWhere(['i.is_deleted' => Item::IS_NOT_DELETED]);

        // Фильтруем их по get параметрам
        // Убираем из параметров категорию
        if (isset($get['category'])) {
            unset($get['category']);
        }

        // Этажи
        if (isset($get['floors']) && is_array($get['floors'])) {
            $floors[] = 'or';
            foreach ($get['floors'] as $k => $floor) {
                $floors[] = ['>', 'i.' . $k, 0];
            }
            $query->andWhere($floors);
            unset($get['floors']);
        }

        // Бесплатные проекты
        if (isset($get['free'])) {
            $query->andWhere(['i.price' => 0]);
            unset($get['free']);
        }

        // По количеству комнат
        if (isset($get['rooms']) && is_array($get['rooms'])) {
            $rooms[] = 'or';
            foreach ($get['rooms'] as $k => $room) {
                $rooms[] = ['i.rooms' => $k];
            }
            $query->andWhere($rooms);
            unset($get['rooms']);
        }

        // По количеству санузлов
        if (isset($get['bath']) && is_array($get['bath'])) {
            $rooms[] = 'or';
            foreach ($get['bath'] as $k => $room) {
                $rooms[] = ['i.bathrooms' => $k];
            }
            $query->andWhere($rooms);
            unset($get['bath']);
        }

        // По минимальной площади
        if (isset($get['minarea'])) {
            $query->andWhere(['>', 'i.common_area', intval($get['minarea'])]);
            unset($get['minarea']);
        }

        // по максимальной площади
        if (isset($get['maxarea'])) {
            $query->andWhere(['<', 'i.common_area', intval($get['maxarea'])]);
            unset($get['maxarea']);
        }

        // По остальным параметрам
        $query = self::addConditions($query, $get);

        return $query;
    }

    /**
     * Получаем массив с удобствами
     * @return array
     */
    public function getComfort()
    {
        $comfort = [];
        if ($this->pedestal) $comfort[] = 'цоколь';
        if ($this->cellar) $comfort[] = 'чердак';
        if ($this->garage) $comfort[] = 'гараж';
        if ($this->double_garage) $comfort[] = 'гараж на 2 авто';
        if ($this->tent) $comfort[] = 'навес';
        if ($this->terrace) $comfort[] = 'терасса';
        if ($this->balcony) $comfort[] = 'балкон';
        if ($this->light2) $comfort[] = 'второй свет';
        if ($this->pool) $comfort[] = 'бассейн';
        if ($this->sauna) $comfort[] = 'сауна';
        if ($this->gas_boiler) $comfort[] = 'газовая котельная';
        return $comfort;
    }

    /**
     * Добавляем условия по чекбоксам свойств товара к выборке
     * @param ActiveQuery $query
     * @param array $get
     * @return ActiveQuery
     */
    public static function addConditions(ActiveQuery $query, array $get)
    {
        foreach ($get as $key => $item) {
            if (!is_array($item)) {
                $query->andWhere(['>', $key, 0]);
            } else {
                $values = [];
                foreach ($item as $k => $value) {
                    $values[] = $k;
                }
                $query->andWhere(['io.catalog_id' => $key])->andWhere(['in', 'io.catalog_item_id', $values]);
            }
        }
        return $query;
    }

    /**
     * @param $catalog_id
     * @return int|mixed|null
     */
    public function getItemOptionCatalogItemId($catalog_id)
    {
        $io = ItemOption::find()->where(['catalog_id' => $catalog_id, 'item_id' => $this->id])->one();
        if ($io) {
            return $io->catalog_item_id;
        }
        return null;
    }
}
