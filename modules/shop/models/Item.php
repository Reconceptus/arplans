<?php

namespace modules\shop\models;


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
 * @property ItemImage[] $images
 */
class Item extends \yii\db\ActiveRecord
{
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
            [['category_id', 'price', 'discount', 'live_area', 'common_area', 'useful_area', 'one_floor', 'two_floor', 'mansard', 'pedestal', 'cellar', 'garage', 'double_garage', 'tent', 'terrace', 'balcony', 'light2', 'pool', 'sauna', 'gas_boiler', 'is_new', 'is_active', 'is_deleted', 'image_id', 'sort'], 'integer'],
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
}
