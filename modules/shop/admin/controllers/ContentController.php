<?php

namespace modules\shop\admin\controllers;


use modules\admin\controllers\AdminController;
use modules\content\models\ContentBlock;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class ContentController extends AdminController
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
                        'shop_content',
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
        Yii::$app->request->baseUrl = '/admin/modules';
        $query = ContentBlock::find()
            ->select(['page', 'page_title', 'page_url'])
            ->where(['not in', 'page', ['about', 'contacts', 'collaboration']])
            ->groupBy(['page', 'page_title', 'page_url']);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'  => ['defaultOrder' => ['page' => SORT_ASC]]
        ]);
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    /**
     * @param string $page
     * @return string
     */
    public function actionPage(string $page)
    {
        $query = ContentBlock::find()->where(['page' => $page]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'  => ['defaultOrder' => ['sort' => SORT_DESC, 'name' => SORT_ASC]]
        ]);
        return $this->render('page', ['dataProvider' => $dataProvider]);
    }

    /**
     * Создание нового параметра
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ContentBlock();
        return $this->modify($model);
    }

    /**
     * Редактирование параметра
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
     * Удаление параметра
     * @param $id
     * @return Response
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if (!$model) {
            throw new NotFoundHttpException();
        }
        $model->delete();
        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * @param $model ActiveRecord|ContentBlock
     * @return string|array
     */
    public function modify($model)
    {
        $post = Yii::$app->request->post();

        if ($model->load($post)) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Параметр отредактирован успешно');
            } else {
                Yii::$app->session->setFlash('danger', 'Ошибка при редактировании параметра');
            }
            return $this->redirect(Url::to(['/admin/modules/shop/content/update', 'id' => $model->id]));
        }

        return $this->render('_form', [
            'model' => $model,
        ]);
    }

    /**
     * @param $id
     * @return ActiveRecord|null
     * @throws NotFoundHttpException
     */
    public function findModel($id)
    {
        if (($model = ContentBlock::find()->where(['id' => $id])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}