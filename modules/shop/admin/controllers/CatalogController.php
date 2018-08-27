<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 16.08.2018
 * Time: 11:16
 */

namespace modules\shop\admin\controllers;


use modules\admin\controllers\AdminController;
use modules\shop\models\Catalog;
use modules\shop\models\CatalogItem;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Exception;
use yii\filters\AccessControl;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;

class CatalogController extends AdminController
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
                        'shop_catalog',
                    ],
                ],
            ],
        ];
        return $behaviors;
    }

    /**
     * Вывод списка товаров
     * @return string
     */
    public function actionIndex()
    {
        $query = Catalog::find();
        $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'sort'  => [
                    'defaultOrder' => [
                        'id' => SORT_ASC
                    ]
                ],
            ]
        );
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    /**
     * Создание нового фильтра
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Catalog();
        return $this->modify($model);
    }

    /**
     * Редактирование фильтра
     * @param $id
     * @return string|Response
     * @throws Exception
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        return $this->modify($model);
    }

    /**
     * Создание нового CatalogItem
     * @param int $id ID каталога, к которому прикреплять
     * @return string|Response
     */
    public function actionAddItem(int $id)
    {
        $model = new CatalogItem();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['catalog/update', 'id' => $id]);
        }
        $model->catalog_id = $id;
        return $this->render('_ci_form', ['model' => $model]);
    }

    /**
     * Изменение CatalogItem
     * @param int $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionUpdateItem(int $id)
    {
        $model = CatalogItem::findOne(['id' => $id]);
        if (!$model) {
            throw new NotFoundHttpException('Не найден параметр');
        }
        return $this->render('_ci_form', ['model' => $model]);
    }

    public function actionSaveCatalog()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $get = Yii::$app->request->get();
        $catalog = new  Catalog();
        if (isset($get['category'])) {
            if (intval($get['category'])) {
                $catalog->category_id = intval($get['category']);
            }
        }
        $catalog->name = Html::encode($get['name']);
        $catalog->slug = Html::encode($get['slug']);
        $catalog->sort = intval($get['sort']);
        if ($catalog->save()) {
            return ['status' => 'success', 'id' => $catalog->id];
        } else {
            $message = '';
            foreach ($catalog->errors as $k => $val) {
                $message = $val[0];
                break;
            }
            return ['status' => 'fail', 'message' => $message];
        }
    }

    /**
     * @param $model Catalog
     * @return string|Response|array
     * @throws Exception
     */
    public function modify($model)
    {
        $post = Yii::$app->request->post();
        if (Yii::$app->request->isAjax && $model->load($post)) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load($post)) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Фильтр добавлен успешно');
            } else {
                Yii::$app->session->setFlash('danger', 'Ошибка при создании фильтра');
            }
            return $this->redirect(Url::to(['catalog/update', 'id' => $model->id]));
        }

        return $this->render('_form', [
            'model' => $model,
        ]);
    }

    /**
     * @param $id
     * @return Catalog|null
     * @throws NotFoundHttpException
     */
    public function findModel($id)
    {
        if (($model = Catalog::find()->where(['id' => $id])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}