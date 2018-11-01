<?php

namespace modules\partner\models;

use modules\content\models\ContentBlock;
use yii\base\Model;
use yii\db\Exception;
use yii\web\NotFoundHttpException;

/**
 *
 * @property string $main_page_offer
 * @property string $main_page_offer_annotation
 *
 * @property string $main_page_text
 * @property string $main_page_author
 *
 * @property string $main_page_seo_title
 * @property string $main_page_seo_description
 * @property string $main_page_seo_keywords
 */
class Main extends Model
{
    public $main_page_offer;
    public $main_page_offer_annotation;
    public $main_page_text;
    public $main_page_author;
    public $main_page_seo_title;
    public $main_page_seo_description;
    public $main_page_seo_keywords;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['main_page_offer', 'main_page_offer_annotation', 'main_page_text', 'main_page_author', 'main_page_seo_title', 'main_page_seo_description', 'main_page_seo_keywords'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'main_page_offer'            => 'Оферта',
            'main_page_offer_annotation' => 'Пояснение к оферте',
            'main_page_text'             => 'Текст на главной',
            'main_page_author'           => 'Автор текста на главной',
            'main_page_seo_title'        => 'SEO тайтл',
            'main_page_seo_description'  => 'SEO описание',
            'main_page_seo_keywords'     => 'SEO ключевые слова',
        ];
    }

    /**
     * @return Main
     */
    public static function getModel()
    {
        $model = new static();
        $data = ContentBlock::find()->select(['text'])->where(['page'=>'main'])->indexBy('slug')->column();
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
                throw new NotFoundHttpException('Неизвестный параметр');
            }
        }
        return 1;
    }
}
