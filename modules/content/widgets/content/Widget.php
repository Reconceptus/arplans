<?php
/**
 * Created by PhpStorm.
 * User: Saint
 * Date: 29.06.2015
 * Time: 11:46
 */

namespace extensions\modules\content\widgets\content;

use modules\content\models\ContentBlock;

class Widget extends \yii\base\Widget
{
    public $slug = '';

    public function run()
    {
        $model = $this->loadModel($this->slug);
        return $this->render('index', ['model' => $model]);
    }

    /**
     * @param $slug string
     * @return array|ContentBlock|null|\yii\db\ActiveRecord
     */
    private static function loadModel($slug)
    {
        $model = ContentBlock::find()->where(['slug' => $slug, 'language' => \Yii::$app->language])->one();
        if (!$model) {
            $model = new ContentBlock();
            $model->slug = $slug;
            $model->language = \Yii::$app->language;
            $model->text = '';
            $model->save();
        }
        return $model;
    }
}