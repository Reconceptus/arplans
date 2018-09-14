<?php

namespace modules\partner\models;

use common\models\Region;
use common\models\User;

/**
 * This is the model class for table "partner".
 *
 * @property int $id
 * @property string $name
 * @property string $url
 * @property string $slug
 * @property int $region_id
 * @property int $glued_timber
 * @property int $profiled_timber
 * @property int $wooden_frame
 * @property int $lstk
 * @property int $carcass
 * @property int $combined
 * @property int $brick
 * @property int $block
 * @property int $finishing
 * @property int $santech
 * @property int $electric
 * @property int $wooden
 * @property int $stone
 * @property int $roof
 * @property int $windows
 * @property int $stretch_ceiling
 * @property int $surround_region
 * @property int $any_region
 *
 * @property Region $region
 * @property PartnerBenefit[] $benefits
 * @property PartnerImage[] $images
 * @property User[] $users
 */
class Partner extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'partner';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['region_id', 'glued_timber', 'profiled_timber', 'wooden_frame', 'lstk', 'carcass', 'combined', 'brick', 'block', 'finishing', 'santech', 'electric', 'wooden', 'stone', 'roof', 'windows', 'stretch_ceiling', 'surround_region', 'any_region'], 'integer'],
            [['name', 'url', 'slug'], 'string', 'max' => 255],
            [['slug'], 'unique'],
            [['region_id'], 'exist', 'skipOnError' => true, 'targetClass' => Region::className(), 'targetAttribute' => ['region_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'              => 'ID',
            'name'            => 'Наименование',
            'url'             => 'Сайт',
            'slug'            => 'Код',
            'region_id'       => 'Регион',
            'glued_timber'    => 'Из клееного бруса',
            'profiled_timber' => 'Из профилированного бруса',
            'wooden_frame'    => 'На основе деревянного каркаса',
            'lstk'            => 'На основе каркаса из ЛСТК',
            'carcass'         => 'Каркасные дома',
            'combined'        => 'Комбинированные дома',
            'brick'           => 'Из блоков и кирпича',
            'block'           => 'Из газобетонных блоков',
            'finishing'       => 'Отделочные',
            'santech'         => 'Сантехнические',
            'electric'        => 'Электромонтажные',
            'wooden'          => 'Деревянные',
            'stone'           => 'Каменные',
            'roof'            => 'Кровельные',
            'windows'         => 'Окна и двери',
            'stretch_ceiling' => 'Натяжные потолки',
            'surround_region' => 'Возможен выезд в соседний регион',
            'any_region'      => 'Возможен выезд в любую часть России',
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
    public function getBenefits()
    {
        return $this->hasMany(PartnerBenefit::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(PartnerImage::className(), ['partner_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['partner_id' => 'id']);
    }
}
