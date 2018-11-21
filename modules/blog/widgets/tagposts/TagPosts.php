<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 30.08.2018
 * Time: 15:15
 */

namespace modules\blog\widgets\tagposts;


use common\models\Post;
use yii\base\Widget;

class TagPosts extends Widget
{
    public $viewName = 'index';
    public $limit = 10;
    public $tag;

    public function run()
    {
        $models = Post::find()->alias('p')
            ->joinWith('tags')
            ->where(['status' => Post::STATUS_PUBLISHED])
            ->andWhere(['tag.name'=>$this->tag])
            ->limit($this->limit)
            ->all();
        $content = $this->render($this->viewName, ['models' => $models]);
        return $content;
    }
}