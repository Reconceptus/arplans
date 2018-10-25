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
     */
    public function actionOrders()
    {
        $user = Yii::$app->user->identity;
        /* @var $user User */
        $query = Order::find()->where(['user_id' => Yii::$app->user->id]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);
        if ($user->access_token || $user->partner) {
            $viewName = 'orders-partner';
        } else {
            $viewName = 'orders-user';
        }
        return $this->render($viewName, ['dataProvider' => $dataProvider]);
    }

    public function actionOrder($id)
    {
        $model = Order::findOne(['id' => $id]);
        if (!$model && $model->user_id != Yii::$app->user->id) {
            throw new NotFoundHttpException();
        } else {
            return $this->render('order', ['model' => $model]);
        }
    }
}