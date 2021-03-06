<?php

namespace modules\partner\models;

use modules\content\models\ContentBlock;
use yii\base\Model;
use yii\db\Exception;
use yii\web\NotFoundHttpException;

/**
 *
 * @property int $id
 * @property string $about_title
 * @property string $about_main_image
 * @property string $share_image
 * @property string $hot_line
 * @property string $phone
 * @property string $email
 * @property string $vk
 * @property string $vk_reviews
 * @property string $fb
 * @property string $instagram
 * @property string $main_office_address
 * @property string $about_page_seo_description
 * @property string $about_page_seo_title
 * @property string $about_page_seo_keywords
 */
class About extends Model
{
    public $about_title;
    public $about_main_image;
    public $share_image;
    public $hot_line;
    public $phone;
    public $email;
    public $vk;
    public $vk_reviews;
    public $fb;
    public $instagram;
    public $main_office_address;
    public $about_page_seo_description;
    public $about_page_seo_title;
    public $about_page_seo_keywords;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['about_page_seo_keywords', 'about_page_seo_title', 'about_page_seo_description', 'about_title', 'hot_line', 'phone', 'email', 'vk', 'vk_reviews', 'fb', 'instagram', 'main_office_address'], 'string', 'max' => 255],
            [['about_main_image', 'share_image'], 'file', 'extensions' => 'png, jpg, gif', 'maxSize' => 1024 * 1024 * 3],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'                         => 'ID',
            'about_title'                => 'Заголовок "О нас"',
            'about_main_image'           => 'Фото на странице "О нас"',
            'share_image'                => 'Фото для ссылок "поделиться страницей"',
            'hot_line'                   => 'Телефон горячей линии',
            'phone'                      => 'Телефон',
            'email'                      => 'Email',
            'vk'                         => 'Вконтакте',
            'vk_reviews'                 => 'Отзывы Вконтакте',
            'fb'                         => 'Facebook',
            'instagram'                  => 'Instagram',
            'about_page_seo_keywords'    => 'Seo keywords',
            'about_page_seo_title'       => 'Seo title',
            'about_page_seo_description' => 'Seo description',
            'main_office_address'        => 'Адрес главного оффиса',
        ];
    }

    /**
     * @return About
     */
    public static function getModel()
    {
        $model = new static();
        $data = ContentBlock::find()->select(['text'])->where(['in', 'page', ['about', 'contacts']])->indexBy('slug')->column();
        foreach ($data as $k => $val) {
            $model->$k = $val;
        }
        return $model;
    }

    /**
     * @return int
     * @throws Exception
     * @throws NotFoundHttpException
     */
    public function save()
    {
        foreach ($this->attributes as $k => $v) {
            $model = ContentBlock::findOne(['slug' => $k]);
            if ($model) {
                $model->text = $v;
                if (!$model->save()) {
                    throw new Exception('Ошибка при сохранении');
                }
            } else {
                throw new NotFoundHttpException('Неизаестный параметр');
            }
        }
        return 1;
    }

    /**
     * @param array $get
     * @return \yii\db\ActiveQuery
     */
    public static function getFilteredQuery(array $get)
    {
        // Делаем выборку поселков
        $query1 = Village::find()->alias('v')->select(['id', 'name', 'address', 'phones', 'email', 'url', 'lat', 'lng', 'sort'])->where(['is_office' => 1, 'is_active' => Village::IS_ACTIVE, 'is_deleted' => Village::IS_NOT_DELETED]);
        $query2 = Builder::find()->alias('b')->select(['id', 'name', 'address', 'phones', 'email', 'url', 'lat', 'lng', 'sort'])->where(['is_office' => 1, 'is_active' => Builder::IS_ACTIVE, 'is_deleted' => Builder::IS_NOT_DELETED]);
        if (isset($get['region'])) {
            $query1->andWhere(['v.region_id' => intval($get['region'])]);
            $query2->andWhere(['b.region_id' => intval($get['region'])]);
            unset($get['region']);
        }

        $subQuery = ($query1->union($query2));
        $query = Village::find()->from(['x' => $subQuery]);
        return $query->orderBy(['sort' => SORT_DESC]);
    }
}
