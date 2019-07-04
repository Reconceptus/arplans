<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 13.09.2018
 * Time: 17:35
 */

namespace modules\partner\admin\controllers;


use common\models\Config;
use modules\admin\controllers\AdminController;
use modules\partner\models\AddPartnerForm;
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
        Yii::$app->request->baseUrl = '/admin/modules';
        $query = Partner::find()->where(['is_deleted' => Partner::IS_NOT_DELETED]);
        $filterModel = new Partner();
        $filter = Yii::$app->request->get('Builder');
        if (isset($filter['name'])) {
            $query->andFilterWhere(['like', 'name', $filter['name']]);
        }
        if (isset($filter['url'])) {
            $query->andFilterWhere(['like', 'url', $filter['url']]);
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'  => [
                'defaultOrder' => [
                    'id' => SORT_DESC
                ]
            ],
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
        $categories = Category::find()->all();
        return $this->render('_form', [
            'model'      => $model,
            'categories' => $categories
        ]);
    }

    /**
     * @return string|Response
     * @throws Exception
     */
    public function actionAdd()
    {
        $model = new AddPartnerForm();
        $post = Yii::$app->request->post();
        if ($model->load($post) && $model->validate()) {
            if ($partner = $model->add()) {
                $categories = Category::find()->where(['is_active' => Category::IS_ACTIVE])->all();
                foreach ($categories as $category) {
                    $partCat = new PartnerCategory();
                    $partCat->partner_id = $partner->id;
                    $partCat->category_id = $category->id;
                    $partCat->save();
                }
                $config = $this->renderPartial('config', ['model' => $partner->agent]);
                Yii::$app->mailer->compose('partner-config', ['partner' => $partner])
                    ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
                    ->setTo($partner->email)
                    ->setBcc(Config::getValue('requestEmail'))
                    ->setSubject('Файл конфига для подключения вашего сайта к апи ' . Yii::$app->request->getHostInfo())
                    ->attachContent($config, ['fileName' => 'config.php'])
                    ->send();
                return $this->redirect(['/admin/modules/partner/partner/update', 'id' => $partner->id]);
            }
        }
        return $this->render('add', ['model' => $model]);
    }

    /**
     * @throws NotFoundHttpException
     */
    public function actionConfig()
    {
        $id = intval(Yii::$app->request->get('id'));
        if (!$id) {
            throw new NotFoundHttpException();
        }
        $model = Partner::findOne(['id' => $id]);
        Yii::$app->response->sendContentAsFile($this->renderPartial('config', ['model' => $model->agent]),'config.php', ['mimeType'=>'text/php']);
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