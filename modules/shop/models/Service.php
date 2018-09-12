<?php

namespace modules\shop\models;

/**
 * This is the model class for table "shop_service".
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $time
 * @property string $short_description
 * @property string $description
 * @property string $preview_text
 * @property float $price
 * @property int $in_cart
 *
 * @property OrderService[] $shopOrderServices
 * @property Order[] $orders
 * @property ServiceImage[] $images
 * @property ServiceFile[] $files
 * @property ServiceBenefit[] $benefits
 */
class Service extends \yii\db\ActiveRecord
{
    const TYPE_IMAGE = 'image';
    const TYPE_FILE = 'file';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shop_service';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description', 'preview_text'], 'string'],
            [['price'], 'number'],
            [['in_cart'], 'integer'],
            [['name', 'slug', 'time', 'short_description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'                => 'ID',
            'name'              => 'Название',
            'preview_text'      => 'Краткое описание',
            'slug'              => 'Url',
            'short_description' => 'Вводный текст',
            'description'       => 'Описание',
            'time'              => 'Срок',
            'price'             => 'Цена',
            'in_cart'           => 'Отображать в корзине',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderServices()
    {
        return $this->hasMany(OrderService::className(), ['service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['id' => 'order_id'])->viaTable('shop_order_service', ['service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(ServiceImage::className(), ['service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFiles()
    {
        return $this->hasMany(ServiceFile::className(), ['service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBenefits()
    {
        return $this->hasMany(ServiceBenefit::className(), ['service_id' => 'id']);
    }
}
