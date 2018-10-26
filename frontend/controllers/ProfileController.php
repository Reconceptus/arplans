<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 26.07.2018
 * Time: 17:13
 */

namespace frontend\controllers;

use common\models\Profile;
use common\models\User;
use modules\shop\models\Order;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


class ProfileController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        $model = Yii::$app->user->identity->profile;
        /* @var $model Profile */
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save();
        }
        return $this->render('index', ['profile' => $model]);
    }

    /**
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionOrders()
    {
        $user = Yii::$app->user->identity;
        if (!$user) {
            throw new NotFoundHttpException();
        }
        /* @var $user User */
        $query = Order::find()->where(['user_id' => Yii::$app->user->id, 'type' => Order::TYPE_SHOP]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);
        return $this->render('orders', ['dataProvider' => $dataProvider]);
    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionOrder($id)
    {
        $model = Order::findOne(['id' => $id]);
        if (!$model || $model->user_id != Yii::$app->user->id || $model->type === Order::TYPE_API) {
            throw new NotFoundHttpException();
        } else {
            return $this->render('order', ['model' => $model]);
        }
    }

    /**
     * @return string
     */
    public function actionSales()
    {
        $query = Order::find()->where(['type' => Order::TYPE_API, 'user_id' => Yii::$app->user->id]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);
        return $this->render('sales', ['dataProvider' => $dataProvider]);
    }
}