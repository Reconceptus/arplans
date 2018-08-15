<?php

namespace modules\shop\models;


/**
 * This is the model class for table "shop_item".
 *
 * @property string $id
 * @property string $category_id
 * @property string $slug
 * @property string $name
 * @property string $video
 * @property int $discount
 * @property string $preview_id
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
 *
 * @property Category $category
 * @property ItemImage[] $shopItemImages
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
            [['category_id', 'discount', 'preview_id', 'live_area', 'common_area', 'useful_area', 'one_floor', 'two_floor', 'mansard', 'pedestal', 'cellar', 'garage', 'double_garage', 'tent', 'terrace', 'balcony', 'light2', 'pool', 'sauna', 'gas_boiler', 'is_new'], 'integer'],
            [['slug', 'name', 'video'], 'string', 'max' => 255],
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
            'id' => 'ID',
            'category_id' => 'Category ID',
            'slug' => 'Slug',
            'name' => 'Name',
            'video' => 'Video',
            'discount' => 'Discount',
            'preview_id' => 'Preview ID',
            'live_area' => 'Live Area',
            'common_area' => 'Common Area',
            'useful_area' => 'Useful Area',
            'one_floor' => 'One Floor',
            'two_floor' => 'Two Floor',
            'mansard' => 'Mansard',
            'pedestal' => 'Pedestal',
            'cellar' => 'Cellar',
            'garage' => 'Garage',
            'double_garage' => 'Double Garage',
            'tent' => 'Tent',
            'terrace' => 'Terrace',
            'balcony' => 'Balcony',
            'light2' => 'Light2',
            'pool' => 'Pool',
            'sauna' => 'Sauna',
            'gas_boiler' => 'Gas Boiler',
            'is_new' => 'Is New',
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
    public function getItemImages()
    {
        return $this->hasMany(ItemImage::className(), ['item_id' => 'id']);
    }
}
