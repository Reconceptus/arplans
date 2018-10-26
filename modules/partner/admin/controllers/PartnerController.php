<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 13.09.2018
 * Time: 17:35
 */

namespace modules\partner\admin\controllers;


use modules\admin\controllers\AdminController;
use modules\partner\models\Partner;
use modules\partner\models\PartnerCategory;
use modules\shop\models\Category;
use Yii;
use yii\base\Exception;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class PartnerController extends AdminController
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
                        'partner_partner',
                    ],
                ],
            ],
        ];
        return $behaviors;
    }


    /**
     * @return string
     */
    public function actionIndex()
    {
        $query = Partner::find()->where(['is_deleted' => Partner::IS_NOT_DELETED, 'is_active' => Partner::IS_ACTIVE]);
        $filterModel = new Partner();
        $filter = Yii::$app->request->get('Builder');
        if (isset($filter['name'])) {
            $query->andFilterWhere(['like', 'name', $filter['name']]);
        }
        if (isset($filter['url'])) {
            $query->andFilterWhere(['like', 'url', $filter['url']]);
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);
        return $this->render('index', ['dataProvider' => $dataProvider, 'filterModel' => $filterModel]);
    }


    /**
     * Создание нового партнера
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Partner();
        return $this->modify($model);
    }

    /**
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
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionCategories($id)
    {
        $categories = Category::find()->all();
        $model = $this->findModel($id);
        return $this->render('categories', ['model' => $model, 'categories' => $categories]);
    }

    /**
     * @param $model Partner
     * @return string|Response
     */
    public function modify($model)
    {
        $post = Yii::$app->request->post();
        if ($model->load($post)) {
            if ($model->save()) {
                return $this->redirect(Url::to(['/admin/modules/partner/partner/update', 'id' => $model->id]));
            }
        }
        return $this->render('_form', [
            'model' => $model,
        ]);
    }

    /**
     * @return Response
     * @throws NotFoundHttpException
     * @throws \yii\base\Exception
     */
    public function actionDelete()
    {
        $model = $this->findModel(Yii::$app->request->get('id'));
        $model->is_deleted = Partner::IS_DELETED;
        if ($model->save()) {
            return $this->redirect(Yii::$app->request->get('back'));
        }
        throw new Exception('Ошибка при удалении партнера');
    }

    /**
     * @return array
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionCheckCategory()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $get = Yii::$app->request->get();
        $model = PartnerCategory::find()->where(['category_id' => intval($get['category_id']), 'partner_id' => intval($get['partner_id'])])->one();
        if (intval($get['checked']) === 1) {
            if (!$model) {
                $model = new PartnerCategory();
                $model->partner_id = intval($get['partner_id']);
                $model->category_id = intval($get['category_id']);
                if ($model->save()) {
                    return ['status' => 'success', 'checked' => 1];
                }
            }
        } else {
            if ($model) {
                $model->delete();
                return ['status' => 'success', 'checked' => 0];
            }
        }
        return ['status' => 'fail'];
    }


    /**
     * @param $id
     * @return Partner|null|ActiveRecord
     * @throws NotFoundHttpException
     */
    public function findModel($id)
    {
        if (($model = Partner::find()->where(['id' => $id])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}