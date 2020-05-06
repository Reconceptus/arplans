<?php

namespace modules\shop\admin\controllers;


use common\models\Profile;
use common\models\User;
use DateTime;
use DateTimeZone;
use Exception;
use modules\admin\controllers\AdminController;
use modules\partner\models\Partner;
use modules\shop\models\Order;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;

class OrderController extends AdminController
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
                        'shop_order',
                    ],
                ],
            ],
        ];
        return $behaviors;
    }

    /**
     * @return string
     * @throws Exception
     */
    public function actionIndex()
    {
        Yii::$app->request->baseUrl = '/admin/modules';
        $partners = ArrayHelper::merge([0 => ''], Partner::getUserList());
        $query = Order::find()->alias('o')
            ->innerJoin(User::tableName() . ' u', 'o.user_id=u.id')
            ->leftJoin(User::tableName() . ' r', 'o.referrer_id=r.id')
            ->innerJoin(Profile::tableName() . ' p', 'u.id=p.user_id');
        $filterModel = new Order();
        $filter = Yii::$app->request->get('Order');
        if (isset($filter['id'])) {
            $query->andFilterWhere(['o.id' => $filter['id']]);
        }
        if (isset($filter['partner']) && $filter['partner']) {
            $query->andFilterWhere(['o.user_id' => $filter['partner'], 'o.type' => Order::TYPE_API]);
        }
        if (isset($filter['status']) && $filter['status']) {
            $query->andFilterWhere(['o.status' => $filter['status']]);
        }
        if (isset($filter['referrer_id']) && $filter['referrer_id']) {
            $query->andFilterWhere(['like', 'r.username', $filter['referrer_id']]);
        }
        if (isset($filter['price_from']) && $filter['price_from']) {
            $query->andFilterWhere(['>=', 'o.price', intval($filter['price_from'])]);
        }
        if (isset($filter['price_to']) && $filter['price_to']) {
            $query->andFilterWhere(['<=', 'o.price', intval($filter['price_to'])]);
        }
        if (isset($filter['fio'])) {
            $query->andFilterWhere(['like', 'p.fio', $filter['fio']]);
        }
        if (isset($filter['email'])) {
            $query->andFilterWhere(['like', 'u.email', $filter['email']]);
        }
        if (isset($filter['from']) && $filter['from']) {
            $query->andWhere('o.created_at>=:from', [':from' => (new DateTime($filter['from'], new DateTimeZone('europe/moscow')))->format('Y-m-d 00:00:00')]);
        }
        if (isset($filter['to']) && $filter['to']) {
            $query->andWhere('o.created_at<=:to', [':to' => (new DateTime($filter['to'], new DateTimeZone('europe/moscow')))->format('Y-m-d 00:00:00')]);
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'  => [
                'defaultOrder' => [
                    'id' => SORT_DESC
                ]
            ]
        ]);
        return $this->render('index', ['dataProvider' => $dataProvider, 'filterModel' => $filterModel, 'partners' => $partners]);
    }

    /**
     * @param int $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionUpdate(int $id)
    {
        $model = Order::findOne(['id' => $id]);
        if ($post = Yii::$app->request->post()) {
            $model->load($post);
            if ($model->track && $model->track !== $model->oldAttributes['track']) {
                $mail = Yii::$app->mailer->compose('new-track', ['model' => $model]);
                $mail->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name]);
                $mail->setTo($model->email);
                $mail->setSubject('Заказу #' . $model->id . ' присвоен треккод');
                $mail->send();
            }
            $model->save();
        }
        if (!$model) {
            throw new NotFoundHttpException();
        }
        return $this->render('form', ['model' => $model]);
    }
}