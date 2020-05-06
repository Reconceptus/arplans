<?php
namespace modules\blog\widgets\tagposts;


use common\models\Post;
use yii\base\Widget;

class TagPosts extends Widget
{
    public $viewName = 'index';
    public $limit = 10;
    public $tag;
    public $postId;

    public function run()
    {
        $query = Post::find()->alias('p')
            ->joinWith('tags')
            ->where(['status' => Post::STATUS_PUBLISHED])
            ->andWhere(['tag.name' => $this->tag]);
        if ($this->postId) {
            $query->andWhere(['!=', 'p.id', $this->postId]);
        }
        $query->limit($this->limit);
        $models = $query->all();
        $content = $this->render($this->viewName, ['models' => $models]);
        return $content;
    }
}