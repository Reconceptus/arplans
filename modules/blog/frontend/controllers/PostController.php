<?php

namespace modules\blog\frontend\controllers;


use common\models\Comment;
use common\models\Config;
use common\models\Post;
use common\models\PostTag;
use common\models\Tag;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class PostController extends Controller
{
    /**
     * Просмотр записей блога
     * @return string
     */
    public function actionIndex()
    {
        $showTags = PostTag::isExistsActiveTags();
        $get = Yii::$app->request->get();
        if (array_key_exists('tag', $get)) {
            $tag = $get['tag'];
        }
        $query = Post::find()->alias('p');
        if (!empty($tag)) {
            $query->innerJoin(PostTag::tableName() . ' pt', 'p.id = pt.post_id')
                ->innerJoin(Tag::tableName() . ' t', 'pt.tag_id = t.id');
        }
        $query->where(['status' => Post::STATUS_PUBLISHED]);
        if (!empty($tag)) {
            $query->andWhere(['t.name' => $tag]);
        }
        $query->andWhere(['!=', 'p.name', '']);

        $tags = Tag::find()->alias('t')
            ->joinWith('posts')
            ->where(['status' => Post::STATUS_PUBLISHED])->limit(10)->all();
        $dataProvider = new ActiveDataProvider([
            'query'      => $query,
            'pagination' => [
                'pageSize' => 24,
            ],
            'sort'       => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC
                ]
            ],
        ]);
        return $this->render('index', ['dataProvider' => $dataProvider, 'tags' => $tags, 'showTags' => $showTags, 'mainTag' => isset($tag) ? $tag : '']);
    }

    /**
     * Просмотр отдельной записи
     * @throws NotFoundHttpException
     */
    public function actionView()
    {
        $slug = Yii::$app->request->get('slug');
        $model = Post::find()->where(['slug' => $slug])->one();
        if (!$model) {
            throw new NotFoundHttpException('Статья не найдена');
        }
        $tags = ArrayHelper::map($model->getTags()->all(), 'id', 'name');
        $comment = new Comment();
        return $this->render('view', ['model' => $model, 'tags' => $tags, 'newComment' => $comment]);
    }

    /**
     * Добавление комментария к посту
     * @return array
     */
    public function actionAddComment()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii::$app->request->post();
        if (!empty($post['postId']) && !empty($post['name']) && !empty($post['email']) && !empty($post['text'])) {
            $article = Post::findOne($post['postId']);
            if ($article) {
                $model = new Comment();
                if (!Yii::$app->user->isGuest) {
                    $model->author_id = Yii::$app->user->id;
                }
                $model->text = $post['text'];
                $model->name = $post['name'];
                $model->email = $post['email'];
                $model->created_at = date('Y-m-d H:i:s');
                $model->post_id = $article->id;
                if ($model->save()) {
                    Yii::$app->mailer->compose(Yii::$app->language . '/new-comment', ['model' => $model])
                        ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
                        ->setTo(Config::getValue('requestEmail'))
                        ->setSubject('Новый комментарий')
                        ->send();
                    $commentBox = $this->renderPartial('_comment_box', ['model' => $model]);
                    return ['status' => 'success', 'id' => $model->id, 'box' => $commentBox];
                }
            }
        }
        return ['status' => 'fail', 'message' => !empty($model) ? $model->errors[0] : 'Ошибка при добавлении коммента'];
    }

    public function actionSearch(string $q)
    {
        $query = Post::find()->alias('p')
            ->andWhere(['like', 'p.name', $q])
            ->orWhere(['like', 'p.text', $q]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);
        return $this->render('search', ['dataProvider' => $dataProvider, 'q' => $q]);
    }

    public function actionTest()
    {
        var_dump(Yii::$app->language);
        var_dump(Yii::$app->request->getAbsoluteUrl());
        var_dump(Yii::$app->request->getUrl());
        var_dump(Yii::$app->request->getHostInfo());
        var_dump(Yii::$app->getHomeUrl());
//        $model = Post::find()->where(['id' => 1])->multilingual()->one();
//        $tags = $model->langTags;
//        var_dump($tags);
    }

}