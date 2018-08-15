<?php
/**
 * Created by PhpStorm.
 * User: suhov.a.s
 * Date: 24.07.2018
 * Time: 12:12
 */

namespace modules\shop\admin\controllers;


use modules\admin\controllers\AdminController;
use modules\shop\models\Category;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class CategoryController extends AdminController
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
                        'shop_category',
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
     * Вывод списка категорий
     * @return string
     */
    public function actionIndex()
    {
        $query = Category::find();
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
     * Создание новой категории
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Category();
        return $this->modify($model);
    }

    /**
     * Редактирование категории
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
     * @param $model Category
     * @return string|array
     */
    public function modify($model)
    {
        return $this->render('_form', [
            'model' => $model
        ]);
    }

    /**
     * Удаляет через ajax файл превью категории
     * @return array
     */
    public function actionDeletePreviewImage()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $get = Yii::$app->request->get();
        $categoryId = (int)$get['categoryId'];
        if ($categoryId) {
            $category = Category::findOne($categoryId);
            if ($category && $category->image) {
                $fileName = '@webroot' . $category->image;
                if (file_exists($fileName)) {
                    unlink($fileName);
                }
                $category->image = null;
                if ($category->save()) {
                    return ['status' => 'success'];
                }
            }
        }
        return ['status' => 'fail'];
    }

    /**
     * @param $id
     * @return Category|null
     * @throws NotFoundHttpException
     */
    public function findModel($id)
    {
        if (($model = Category::find()->where(['id' => $id])->one()) !== null) {
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