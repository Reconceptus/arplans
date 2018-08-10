<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 26.07.2018
 * Time: 17:13
 */

namespace frontend\controllers;


use common\models\Comment;
use common\models\Post;
use common\models\PostLang;
use common\models\PostTag;
use common\models\Tag;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class BlogController extends Controller
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
        $query = Post::find()->localized(Yii::$app->language)->alias('p')
            ->innerJoin(PostLang::tableName() . ' pl', 'pl.post_id=p.id');
        if (!empty($tag)) {
            $query->innerJoin(PostTag::tableName() . ' pt', 'p.id = pt.post_id')
                ->innerJoin(Tag::tableName() . ' t', 'pt.tag_id = t.id');
        }
        $query->where(['status' => Post::STATUS_PUBLISHED]);
        if (!empty($tag)) {
            $query->andWhere(['t.name' => $tag]);
        }
        $query->andWhere([
            'and',
            ['pl.language' => Yii::$app->language],
            ['!=', 'pl.name', '']
        ]);

        $tags = Tag::find()->where(['language' => Yii::$app->language])->limit(5)->all();
        $dataProvider = new ActiveDataProvider([
            'query'      => $query,
            'pagination' => [
                'pageSize' => 3,
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
        $model = Post::find()->where(['slug' => $slug])->localized(Yii::$app->language)->one();
        if (!$model) {
            throw new NotFoundHttpException('Post not found');
        }
        $tags = ArrayHelper::map($model->getLangTags(Yii::$app->language)->all(), 'id', 'name');
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
                        ->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->name])
                        ->setTo(Yii::$app->params['supportEmail'])
                        ->setSubject('Новый комментарий')
                        ->send();
                    $commentBox = $this->renderPartial('_comment_box', ['model' => $model]);
                    return ['status' => 'success', 'id' => $model->id, 'box' => $commentBox];
                }
            }
        }
        return ['status' => 'fail', 'message' => !empty($model) ? $model->errors[0] : 'Error adding comment'];
    }

    public function actionSearch(string $q)
    {
        $query = Post::find()->alias('p')
            ->innerJoin(PostLang::tableName() . ' pl', 'p.id=pl.post_id')
            ->localized(Yii::$app->language)
            ->where(['pl.language' => Yii::$app->language])
            ->andWhere(['like', 'pl.name', $q])
            ->orWhere(['like', 'pl.preview_text', $q])
            ->orWhere(['like', 'pl.text', $q]);
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