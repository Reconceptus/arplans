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
 * @property string $lat
 * @property string $lng
 * @property int $image_id
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
 * @property VillageImage $image
 * @property VillageBenefit[] $villageBenefits
 * @property VillageImage[] $images
 */
class Village extends \yii\db\ActiveRecord
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
        return 'village';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['image_id', 'region_id', 'electric', 'gas', 'water', 'internet', 'gas_boiler', 'territory_control', 'fire_alarm', 'security_alarm', 'shop', 'children_club', 'sports_center', 'sports_ground', 'golf_club', 'beach', 'life_service', 'forest', 'reservoir'], 'integer'],
            [['name', 'slug', 'address', 'phones', 'url', 'price_list'], 'string', 'max' => 255],
            [['lat', 'lng'], 'string', 'max' => 10],
            [['logo'], 'file', 'extensions' => 'png, jpg, gif', 'maxSize' => 1024 * 1024 * 3],
            [['region_id'], 'exist', 'skipOnError' => true, 'targetClass' => Region::className(), 'targetAttribute' => ['region_id' => 'id']],
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
            'slug'              => 'Slug',
            'address'           => 'Адрес',
            'phones'            => 'Телефоны',
            'url'               => 'Сайт',
            'price_list'        => 'Прайслист',
            'logo'              => 'Логотип',
            'image_id'          => 'Основное изображение',
            'region_id'         => 'Регион',
            'electric'          => 'Электроснабжение',
            'gas'               => 'Газоснабжение',
            'water'             => 'Водоснабжение',
            'internet'          => 'Интернет',
            'gas_boiler'        => 'Газовая котельная',
            'territory_control' => 'Охрана территории и подъездов',
            'fire_alarm'        => 'Противопожарная сигнализация',
            'security_alarm'    => 'Охранная сигнализация',
            'shop'              => 'Магазины',
            'children_club'     => 'Детский клуб',
            'sports_center'     => 'Спортивно-оздоровительный комплекс',
            'sports_ground'     => 'Спортивные площадки',
            'golf_club'         => 'Гольф-клуб',
            'beach'             => 'Пляж',
            'life_service'      => 'Служба быта',
            'forest'            => 'Лесозона',
            'reservoir'         => 'Водоем',
            'lat'               => 'Широта',
            'lng'               => 'Долгота',
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
    public function getImages()
    {
        return $this->hasMany(VillageImage::className(), ['village_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery|VillageImage
     */
    public function getImage()
    {
        return $this->hasOne(VillageImage::className(), ['id' => 'image_id']);
    }

    /**
     * @return mixed|string
     */
    public function getMainImage()
    {
        if ($this->image) {
            $image = $this->image->file;
        } elseif ($this->images) {
            $image = $this->images[0]->file;
        } else {
            $image = '';
        }
        return $image;
    }

    /**
     * @param array $get
     * @return \yii\db\ActiveQuery
     */
    public static function getFilteredQuery(array $get)
    {
        // Делаем выборку товаров
        $query = self::find()->alias('v')->distinct()
            ->andWhere(['v.is_active' => self::IS_ACTIVE])
            ->andWhere(['v.is_deleted' => self::IS_NOT_DELETED]);

        // Фильтруем их по get параметрам

        // Регион
        if (isset($get['region'])) {
            $query->andWhere(['v.region_id' => intval($get['region'])]);
            unset($get['region']);
        }

        if (isset($get['networks']) && is_array($get['networks'])) {
            $build[] = 'or';
            foreach ($get['networks'] as $k => $item) {
                $build[] = ['v.' . $k => 1];
            }
            $query->andWhere($build);
            unset($get['networks']);
        }

        if (isset($get['safety']) && is_array($get['safety'])) {
            $work[] = 'or';
            foreach ($get['safety'] as $k => $item) {
                $work[] = ['v.' . $k => 1];
            }
            $query->andWhere($work);
            unset($get['safety']);
        }

        if (isset($get['infra']) && is_array($get['infra'])) {
            $mat[] = 'or';
            foreach ($get['infra'] as $k => $item) {
                $mat[] = ['v.' . $k => 1];
            }
            $query->andWhere($mat);
            unset($get['infra']);
        }

        if (isset($get['eco']) && is_array($get['eco'])) {
            $mat[] = 'or';
            foreach ($get['eco'] as $k => $item) {
                $mat[] = ['v.' . $k => 1];
            }
            $query->andWhere($mat);
            unset($get['eco']);
        }

        return $query;
    }
}
