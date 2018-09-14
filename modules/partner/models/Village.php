<?php

namespace modules\partner\models;

use common\models\Region;

/**
 * This is the model class for table "village".
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $address
 * @property string $phones
 * @property string $url
 * @property string $price_list
 * @property string $logo
 * @property int $region_id
 * @property int $electric
 * @property int $gas
 * @property int $water
 * @property int $internet
 * @property int $gas_boiler
 * @property int $territory_control
 * @property int $fire_alarm
 * @property int $security_alarm
 * @property int $shop
 * @property int $children_club
 * @property int $sports_center
 * @property int $sports_ground
 * @property int $golf_club
 * @property int $beach
 * @property int $life_service
 * @property int $forest
 * @property int $reservoir
 *
 * @property Region $region
 * @property VillageBenefit[] $villageBenefits
 * @property VillageImage[] $villageImages
 */
class Village extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'village';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['region_id', 'electric', 'gas', 'water', 'internet', 'gas_boiler', 'territory_control', 'fire_alarm', 'security_alarm', 'shop', 'children_club', 'sports_center', 'sports_ground', 'golf_club', 'beach', 'life_service', 'forest', 'reservoir'], 'integer'],
            [['name', 'slug', 'address', 'phones', 'url', 'price_list', 'logo'], 'string', 'max' => 255],
            [['region_id'], 'exist', 'skipOnError' => true, 'targetClass' => Region::className(), 'targetAttribute' => ['region_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'slug' => 'Slug',
            'address' => 'Address',
            'phones' => 'Phones',
            'url' => 'Url',
            'price_list' => 'Price List',
            'logo' => 'Logo',
            'region_id' => 'Region ID',
            'electric' => 'Electric',
            'gas' => 'Gas',
            'water' => 'Water',
            'internet' => 'Internet',
            'gas_boiler' => 'Gas Boiler',
            'territory_control' => 'Territory Control',
            'fire_alarm' => 'Fire Alarm',
            'security_alarm' => 'Security Alarm',
            'shop' => 'Shop',
            'children_club' => 'Children Club',
            'sports_center' => 'Sports Center',
            'sports_ground' => 'Sports Ground',
            'golf_club' => 'Golf Club',
            'beach' => 'Beach',
            'life_service' => 'Life Service',
            'forest' => 'Forest',
            'reservoir' => 'Reservoir',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(Region::className(), ['id' => 'region_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVillageBenefits()
    {
        return $this->hasMany(VillageBenefit::className(), ['village_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVillageImages()
    {
        return $this->hasMany(VillageImage::className(), ['village_id' => 'id']);
    }
}
