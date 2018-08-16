<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 16.08.2018
 * Time: 11:16
 */

namespace modules\shop\admin\controllers;


use modules\admin\controllers\AdminController;
use modules\shop\models\Item;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class ItemController extends AdminController
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
                        'shop_item',
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
        $query = Item::find();
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
     * Создание нового товара
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Item();
        return $this->modify($model);
    }

    /**
     * Редактирование товара
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
     * @param $model Item
     * @return string|Response
     */
    public function modify($model)
    {
        $post = Yii::$app->request->post();

        if ($model->load($post)) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Категория создана успешно');
            } else {
                Yii::$app->session->setFlash('danger', 'Ошибка при создании категории');
            }
            return $this->redirect(Url::to(['item/update', 'id' => $model->id]));
        }

        return $this->render('_form', [
            'model' => $model,
        ]);
    }

    /**
     * Устанавливает через ajax файл превью категории
     * @return array
     */
    public function actionSetPreviewImage()
    {
//
        return ['status' => 'fail'];
    }

    /**
     * @param $id
     * @return Item|null
     * @throws NotFoundHttpException
     */
    public function findModel($id)
    {
        if (($model = Item::find()->where(['id' => $id])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}