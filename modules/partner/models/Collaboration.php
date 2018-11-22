<?php

namespace modules\partner\models;

use common\models\Profile;
use modules\content\models\ContentBlock;
use yii\base\Model;
use yii\db\Exception;
use yii\web\NotFoundHttpException;

/**
 * @property string $collaboration_title_1
 * @property string $collaboration_title_2
 * @property string $collaboration_title_3
 * @property string $collaboration_text_1
 * @property string $collaboration_text_2
 * @property string $collaboration_text_3
 * @property string $collaboration_image_1
 * @property string $collaboration_image_2
 * @property string $collaboration_image_3
 * @property string $collaboration_manager
 * @property string $collaboration_page_seo_title
 * @property string $collaboration_page_seo_description
 * @property string $collaboration_page_seo_keywords
 */
class Collaboration extends Model
{
    public $collaboration_title_1;
    public $collaboration_title_2;
    public $collaboration_title_3;
    public $collaboration_text_1;
    public $collaboration_text_2;
    public $collaboration_text_3;
    public $collaboration_image_1;
    public $collaboration_image_2;
    public $collaboration_image_3;
    public $collaboration_manager;
    public $collaboration_page_seo_title;
    public $collaboration_page_seo_description;
    public $collaboration_page_seo_keywords;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['collaboration_page_seo_title', 'collaboration_page_seo_description', 'collaboration_page_seo_keywords', 'collaboration_title_1', 'collaboration_title_2', 'collaboration_title_3', 'collaboration_text_1', 'collaboration_text_2', 'collaboration_text_3'], 'string'],
            [['collaboration_manager'], 'integer'],
            [['collaboration_image_1', 'collaboration_image_2', 'collaboration_image_3'], 'file', 'extensions' => 'png, jpg, gif'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'collaboration_title_1'              => 'Заголовок 1',
            'collaboration_title_2'              => 'Заголовок 2',
            'collaboration_title_3'              => 'Заголовок 3',
            'collaboration_text_1'               => 'Текст 1',
            'collaboration_text_2'               => 'Текст 2',
            'collaboration_text_3'               => 'Текст 3',
            'collaboration_image_1'              => 'Картинка 1',
            'collaboration_image_2'              => 'Картинка 2',
            'collaboration_image_3'              => 'Картинка 3',
            'collaboration_page_seo_title'       => 'Seo title',
            'collaboration_page_seo_description' => 'Seo description',
            'collaboration_page_seo_keywords'    => 'Seo keywords',
            'collaboration_manager'              => 'Менеджер'
        ];
    }

    /**
     * @return Collaboration
     */
    public static function getModel()
    {
        $model = new static();
        $data = ContentBlock::find()->select(['text'])->where(['page' => 'collaboration'])->indexBy('slug')->column();
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
     * @return array|null|\yii\db\ActiveRecord
     */
    public function getManager()
    {
        return Profile::find()->where(['user_id' => intval($this->collaboration_manager)])->one();
    }
}
