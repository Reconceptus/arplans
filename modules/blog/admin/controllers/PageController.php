<?php
/**
 * Created by PhpStorm.
 * User: suhov.a.s
 * Date: 24.07.2018
 * Time: 12:12
 */

namespace modules\blog\admin\controllers;

use common\models\Page;
use Imagine\Image\Box;
use modules\admin\controllers\AdminController;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\imagine\Image;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;

class PageController extends AdminController
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['access'] = [
            'class' => AccessControl::className(),
            'denyCallback' => function ($rule, $action) {
                return $this->redirect('/');
            },
            'rules' => [
                [
                    'actions' => [],
                    'allow'   => true,
                    'roles'   => [
                        'blog_page',
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
        $query = Page::find();
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
        $model = new Page();
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
     * @param $model Page
     * @return string
     */
    public function modify($model)
    {
        $post = Yii::$app->request->post();

        if ($model->load($post)) {
            // Добавляем автора и дату создания
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
                    $this->createDirectory($dir . $path);
                    $fileName = $model->image->baseName . '.' . $model->image->extension;
                    $model->image->saveAs($dir . $path . $fileName);
                    $model->image = '/uploads/images/post-preview/' . $path . $fileName;
                    $photo = Image::getImagine()->open($dir . $path . $fileName);
                    $photo->thumbnail(new Box(800, 800))->save($dir . $path . $fileName, ['quality' => 90]);
                }else{
                    var_dump($model->errors);
                }
            } elseif (array_key_exists('old-image', $post) && $post['old-image']) {
                $model->image = $post['old-image'];
            }
            if ($model->isNewRecord && $model->validate()) {
                $model->save();
            }
            $model->updated_at = date('Y-m-d H:i:s');
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Страница создана успешно');
            } else {
                Yii::$app->session->setFlash('danger', 'Ошибка при создании страницы');
            }
            return $this->redirect(Url::to(['page/update', 'id' => $model->id]));
        }

        return $this->render('_form', [
            'model' => $model,
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
        $pageId = (int)$get['pageId'];
        if ($pageId) {
            $page = Page::findOne($pageId);
            if ($page && $page->image) {
                $fileName = Yii::getAlias('@webroot') . $page->image;
                if (file_exists($fileName)) {
                    unlink($fileName);
                }
                $page->image = null;
                if ($page->save()) {
                    return ['status' => 'success'];
                }
            }
        }
        return ['status' => 'fail'];
    }

    /**
     * @param $id
     * @return Page|null
     * @throws NotFoundHttpException
     */
    public function findModel($id)
    {
        if (($model = Page::find()->where(['id' => $id])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Если директории не существует, то создает ее
     * @param $path
     */
    public function createDirectory($path)
    {
        if (!file_exists($path)) {
            mkdir($path, 0775, true);
        }
    }
}