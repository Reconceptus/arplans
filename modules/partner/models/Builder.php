<?php

namespace modules\partner\models;

use common\models\Region;
use common\models\User;

/**
 * This is the model class for table "builder".
 *
 * @property int $id
 * @property string $name
 * @property string $url
 * @property string $slug
 * @property string $address
 * @property string $phones
 * @property string $email
 * @property string $price_list
 * @property string $logo
 * @property string $description
 * @property string $seo_description
 * @property string $seo_title
 * @property string $seo_keywords
 * @property int $image_id
 * @property int $back_image_id
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
 * @property int $is_office
 * @property int $no_page
 * @property int $sort
 *
 * @property Region $region
 * @property BuilderImage $image
 * @property BuilderImage $background
 * @property BuilderBenefit[] $benefits
 * @property BuilderImage[] $images
 * @property User[] $users
 */
class Builder extends \yii\db\ActiveRecord
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
        return 'builder';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['image_id', 'back_image_id', 'region_id', 'sort', 'glued_timber', 'profiled_timber', 'wooden_frame', 'lstk', 'carcass', 'combined', 'brick', 'block', 'finishing', 'santech', 'electric', 'wooden', 'stone', 'roof', 'windows', 'stretch_ceiling', 'surround_region', 'any_region', 'is_office', 'no_page'], 'integer'],
            [['address', 'phones', 'email', 'name', 'url', 'slug', 'seo_description', 'seo_title', 'seo_keywords'], 'string', 'max' => 255],
            [['description'], 'string'],
            [['slug', 'name'], 'unique'],
            [['lat', 'lng'], 'string', 'max' => 10],
            [['logo'], 'file', 'extensions' => 'png, jpg, gif', 'maxSize' => 1024 * 1024 * 3],
            [['price_list'], 'file'],
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
            'description'     => 'Описание',
            'seo_description' => 'Описание (SEO)',
            'seo_title'       => 'Заголовок (SEO)',
            'seo_keywords'    => 'Ключевые слова (SEO)',
            'url'             => 'Сайт',
            'email'           => 'Email',
            'slug'            => 'Код',
            'image_id'        => 'Основное изображение',
            'back_image_id'   => 'Фоновое изображение',
            'region_id'       => 'Регион',
            'address'         => 'Адрес',
            'logo'            => 'Логотип',
            'phones'          => 'Телефоны (через запятую)',
            'price_list'      => 'Прайслист',
            'is_active'       => 'Активен',

            'glued_timber'    => 'Из клееного бруса',
            'profiled_timber' => 'Из профилированного бруса',
            'wooden_frame'    => 'На основе деревянного каркаса',
            'lstk'            => 'На основе каркаса из ЛСТК',
            'carcass'         => 'Каркасные дома',
            'combined'        => 'Комбинированные дома',
            'brick'           => 'Из блоков и кирпича',
            'block'           => 'Из газобетонных блоков',

            'finishing' => 'Отделочные',
            'santech'   => 'Сантехнические',
            'electric'  => 'Электромонтажные',

            'wooden'          => 'Деревянные',
            'stone'           => 'Каменные',
            'roof'            => 'Кровельные',
            'windows'         => 'Окна и двери',
            'stretch_ceiling' => 'Натяжные потолки',

            'surround_region' => 'Возможен выезд в соседний регион',
            'any_region'      => 'Возможен выезд в любую часть России',
            'is_office'       => 'Офис продаж',
            'no_page'         => 'Не создавать страницу',

            'lat'  => 'Широта (в формате 55.555555)',
            'lng'  => 'Долгота (в формате 55.555555)',
            'sort' => 'Сортировка',
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
        return $this->hasMany(BuilderBenefit::className(), ['builder_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(BuilderImage::className(), ['builder_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery|BuilderImage
     */
    public function getImage()
    {
        return $this->hasOne(BuilderImage::className(), ['id' => 'image_id']);
    }

    /**
     * @return \yii\db\ActiveQuery|BuilderImage
     */
    public function getBackground()
    {
        return $this->hasOne(BuilderImage::className(), ['id' => 'back_image_id']);
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
     * @return mixed|string
     */
    public function getBackImage()
    {
        if ($this->background) {
            $image = $this->background->file;
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
        $query = self::find()->alias('p')->distinct()
            ->andWhere(['p.is_active' => self::IS_ACTIVE])
            ->andWhere(['p.is_deleted' => self::IS_NOT_DELETED]);

        // Фильтруем их по get параметрам

        // Регион
        if (isset($get['region'])) {
            $query->andWhere(['p.region_id' => intval($get['region'])]);
            unset($get['region']);
        }

        if (isset($get['build']) && is_array($get['build'])) {
            $build[] = 'or';
            foreach ($get['build'] as $k => $item) {
                $build[] = ['p.' . $k => 1];
            }
            $query->andWhere($build);
            unset($get['build']);
        }

        if (isset($get['works']) && is_array($get['works'])) {
            $work[] = 'or';
            foreach ($get['works'] as $k => $item) {
                $work[] = ['p.' . $k => 1];
            }
            $query->andWhere($work);
            unset($get['works']);
        }

        if (isset($get['mat']) && is_array($get['mat'])) {
            $mat[] = 'or';
            foreach ($get['mat'] as $k => $item) {
                $mat[] = ['p.' . $k => 1];
            }
            $query->andWhere($mat);
            unset($get['mat']);
        }
        return $query;
    }
}
