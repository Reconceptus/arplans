<?php
/**
 * Created by PhpStorm.
 * User: suhov.a.s
 * Date: 24.07.2018
 * Time: 12:12
 */

namespace modules\blog\admin\controllers;

use common\models\Post;
use modules\admin\controllers\AdminController;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;

class PostController extends AdminController
{
    /**
     * @return array
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['access'] = [
            'class'        => AccessControl::className(),
            'denyCallback' => function ($rule, $action) {
                return $this->redirect('/');
            },
            'rules'        => [
                [
                    'actions' => [],
                    'allow'   => true,
                    'roles'   => [
                        'blog_post',
                    ],
                ],
            ],
        ];
        return $behaviors;
    }

    /**
     * @return array
     */
    public function actions()
    {
        return [
            'image-upload' => [
                'class'            => 'vova07\imperavi\actions\UploadFileAction',
                'url'              => '/uploads/images/posts', // Directory URL address, where files are stored.
                'path'             => '@webroot/uploads/images/posts', // Or absolute path to directory where files are stored.
                'translit'         => true,
                'validatorOptions' => [
                    'maxWidth'  => 1200,
                    'maxHeight' => 1000
                ],
            ],
            ''
        ];
    }

    /**
     * Вывод списка постов
     * @return string
     */
    public function actionIndex()
    {
        $query = Post::find();
        $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'sort'  => [
                    'defaultOrder' => [
                        'created_at' => SORT_DESC
                    ]
                ],
            ]
        );
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    /**
     * Создание нового поста
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Post();
        return $this->modify($model);
    }

    /**
     * Редактирование поста
     * @param $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        return $this->modify($model);
    }

    /**
     * @param $model Post
     * @return string|array
     */
    public function modify($model)
    {
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        $post = Yii::$app->request->post();

        if ($model->load($post)) {
            // Добавляем автора и дату создания
            if ($model->isNewRecord) {
                $model->author_id = Yii::$app->user->id;
            }
            if (!$model->created_at) {
                $model->created_at = date('Y-m-d H:i:s');
            }

            // Загружаем картинки
            $image = UploadedFile::getInstance($model, 'image');
            if ($image && $image->tempName) {
                $model->image = $image;
                if ($model->validate(['image'])) {
                    $dir = Yii::getAlias('@webroot/uploads/images/post-preview/');
                    $path = date('ymdHis', strtotime($model->created_at)) . '/';
                    \common\models\Image::createDirectory($dir . $path);
                    $fileName = $model->image->baseName . '.' . $model->image->extension;
                    $model->image->saveAs($dir . $path . $fileName);
                    $model->image = '/uploads/images/post-preview/' . $path . $fileName;
//                    $photo = Image::getImagine()->open($dir . $path . $fileName);
//                    $photo->thumbnail(new Box(800, 800))->save($dir . $path . $fileName, ['quality' => 90]);
                }
            } elseif (array_key_exists('old-image', $post) && $post['old-image']) {
                $model->image = $post['old-image'];
            }
            if ($model->isNewRecord && $model->validate()) {
                $model->save();
            }
            // Обновляем теги
            $tags = $post['tags'];
            if ($model->isNewRecord) {
                $model->save();
            }
            $model->updateTags($tags);
            $model->updated_at = date('Y-m-d H:i:s');
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Post created successfully');
            } else {
                Yii::$app->session->setFlash('danger', 'Error creating post');
            }
            return $this->redirect(Url::to(['post/update', 'id' => $model->id]));
        }
        $tags = implode(', ', ArrayHelper::map($model->getTags()->all(), 'id', 'name'));
        return $this->render('_form', [
            'model' => $model,
            'tags' =>$tags
        ]);
    }

    /**
     * Удаляет через ajax файл превью поста
     * @return array
     */
    public function actionDeletePreviewImage()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $get = Yii::$app->request->get();
        $postId = (int)$get['postId'];
        if ($postId) {
            $post = Post::findOne($postId);
            if ($post && $post->image) {
                $fileName = Yii::getAlias('@webroot') . $post->image;
                if (file_exists($fileName)) {
                    unlink($fileName);
                }
                $post->image = null;
                if ($post->save()) {
                    return ['status' => 'success'];
                }
            }
        }
        return ['status' => 'fail'];
    }

    /**
     * @param $id
     * @return Post|null
     * @throws NotFoundHttpException
     */
    public function findModel($id)
    {
        if (($model = Post::find()->where(['id' => $id])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}