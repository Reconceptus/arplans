<?php

namespace modules\shop\admin\controllers;

use modules\admin\controllers\AdminController;
use modules\shop\models\Block;
use modules\shop\models\Catalog;
use modules\shop\models\Item;
use modules\shop\models\Selection;
use modules\shop\models\SelectionItem;
use modules\shop\models\SelectionOption;
use modules\shop\models\SelectionSearch;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;

/**
 * SelectionController implements the CRUD actions for Selection model.
 */
class SelectionController extends AdminController
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
                        'shop_selection',
                    ],
                ],
            ],
        ];
        return $behaviors;
    }

    /**
     * Lists all Selection models.
     * @return mixed
     */
    public function actionIndex()
    {
        Yii::$app->request->baseUrl = '/admin/modules';
        $searchModel = new SelectionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param  int  $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionItems(int $id)
    {
        Yii::$app->request->baseUrl = '/admin/modules';
        $selection = Selection::findOne(['id' => $id]);
        if (!$selection) {
            throw new NotFoundHttpException();
        }
        $query = Item::find()->alias('i')->joinWith('selectionItems si')->where(['si.selection_id' => $id])->andWhere(['i.is_deleted' => 0]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        return $this->render('items', [
            'selection'    => $selection,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $model Selection
     * @return string|\yii\web\Response
     */
    public function modify($model)
    {
        Yii::$app->request->baseUrl = '/admin/modules';
        $post = Yii::$app->request->post();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $catalogs = ArrayHelper::getValue($post, 'Catalogs');
            if ($catalogs) {
                foreach ($catalogs as $k => $val) {
                    if ($val) {
                        $so = SelectionOption::find()->where(['filter_id' => $k])->andWhere(['selection_id' => $model->id])->one();
                        /* @var $so SelectionOption */
                        if ($so) {
                            if ((int) $val !== $so->filter_item_id) {
                                $so->filter_item_id = (int) $val;
                                $so->save();
                            }
                        } else {
                            $so = new SelectionOption();
                            $so->selection_id = $model->id;
                            $so->filter_id = (int) $k;
                            $so->filter_item_id = (int) $val;
                            $so->save();
                        }
                    } else {
                        $so = SelectionOption::find()->where(['filter_id' => $k])->andWhere(['selection_id' => $model->id])->one();
                        if ($so) {
                            $so->delete();
                        }
                    }
                }
            }
            if (ArrayHelper::getValue($post, 'recollect')) {
                SelectionItem::deleteAll(['selection_id' => $model->id, 'status' => SelectionItem::STATUS_AUTO_ADDED]);
            }
            $newBlocks = ArrayHelper::getValue($post['Selection'], 'blocks');
            $model->collect();
            return $this->redirect(['index']);
        }
        $blocks = ArrayHelper::map(Block::all(), 'id', 'name');
        $filters = Catalog::find()->where(['is', 'category_id', null])->all();
        return $this->render('form', [
            'blocks'   => $blocks,
            'model'    => $model,
            'catalogs' => $filters
        ]);
    }

    /**
     * Creates a new Selection model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Selection();
        return $this->modify($model);
    }

    /**
     * Updates an existing Selection model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param  integer  $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        return $this->modify($model);
    }

    /**
     * Deletes an existing Selection model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param  integer  $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Selection model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param  integer  $id
     * @return Selection the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Selection::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
