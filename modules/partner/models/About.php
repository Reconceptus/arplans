<?php

namespace modules\partner\models;

use modules\content\models\ContentBlock;
use yii\base\Model;
use yii\db\Exception;
use yii\web\NotFoundHttpException;

/**
 *
 * @property int    $id
 * @property string $about_title
 * @property string $about_main_image
 * @property string $hot_line
 * @property string $phone
 * @property string $email
 * @property string $vk
 * @property string $fb
 * @property string $instagram
 * @property string $main_office_address
 */
class About extends Model
{
    public $about_title;
    public $about_main_image;
    public $hot_line;
    public $phone;
    public $email;
    public $vk;
    public $fb;
    public $instagram;
    public $main_office_address;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['about_title', 'hot_line', 'phone', 'email', 'vk', 'fb', 'instagram', 'main_office_address'], 'string', 'max' => 255],
            [['about_main_image'], 'file', 'extensions' => 'png, jpg, gif', 'maxSize' => 1024 * 1024 * 3],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'                  => 'ID',
            'about_title'         => 'Заголовок "О нас"',
            'about_main_image'    => 'Фото на странице "О нас"',
            'hot_line'            => 'Телефон горячей линии',
            'phone'               => 'Телефон',
            'email'               => 'Email',
            'vk'                  => 'Вконтакте',
            'fb'                  => 'Facebook',
            'instagram'           => 'Instagram',
            'main_office_address' => 'Адрес главного оффиса',
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
        $query1 = Village::find()->select(['id', 'name', 'address', 'phones', 'lat', 'lng'])->where(['is_office' => 1, 'is_active' => 1]);
        // Регион
        if (isset($get['region'])) {
            $query1->andWhere(['v.region_id' => intval($get['region'])]);
            unset($get['region']);
        }
        $query2 = Builder::find()->select(['id', 'name', 'address', 'phones', 'lat', 'lng'])->where(['is_office' => 1, 'is_active' => 1]);

        $query = $query1->union($query2);
        return $query;
    }
}
