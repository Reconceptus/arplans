<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 26.07.2018
 * Time: 17:13
 */

namespace frontend\controllers;

use common\models\Config;
use common\models\User;
use modules\shop\models\Order;
use modules\shop\models\RefRequest;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


class ProfileController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            throw new NotFoundHttpException();
        }
        $post = Yii::$app->request->post();
        $user = Yii::$app->user->identity;
        /* @var $user User */
        $model = $user->profile;
        if ($model->load($post) && $model->validate()) {
            $model->save();
            if ($post['Profile']['password']) {
                $user->setPassword($post['Profile']['password']);
                $user->save();
            }
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
        $models = Order::find()->where(['user_id' => Yii::$app->user->id, 'type' => Order::TYPE_SHOP])->orderBy(['id' => SORT_DESC])->all();
        return $this->render('orders', ['models' => $models]);
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
        if (Yii::$app->user->isGuest || !Yii::$app->user->identity->partner) {
            throw new NotFoundHttpException();
        }
        $models = Order::find()->where(['type' => Order::TYPE_API, 'user_id' => Yii::$app->user->id])->orderBy(['id' => SORT_DESC])->all();
        return $this->render('sales', ['models' => $models]);
    }

    /**
     * @return string
     */
    public function actionReferrals()
    {
        if (Yii::$app->user->isGuest || !Yii::$app->user->identity->is_referrer) {
            throw new NotFoundHttpException();
        }
        $user_id = Yii::$app->user->id;
        $referrals = User::find()->where(['referrer_id' => $user_id, 'status' => User::STATUS_ACTIVE])->count();
        $models = Order::find()->where(['referrer_id' => $user_id, 'type' => Order::TYPE_SHOP])->andWhere(['in', 'status', [Order::STATUS_PAYED, Order::STATUS_DONE]])->orderBy(['id' => SORT_DESC])->all();
        return $this->render('referrals', ['models' => $models, 'referrals' => $referrals]);
    }

    public function actionBonus()
    {
        if (Yii::$app->user->isGuest || !Yii::$app->user->identity->is_referrer || Yii::$app->user->identity->bonusRemnants < 2000) {
            throw new NotFoundHttpException();
        }
        /* @var $user User */
        $user = Yii::$app->user->identity;
        $model = new RefRequest(['referrer_id' => $user->id]);
        $post = Yii::$app->request->post();
        if ($model->load($post) && $model->save()) {
            Yii::$app->mailer->compose('bonus', ['model' => $model])
                ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
                ->setTo(Config::getValue('requestEmail'))
                ->setSubject('Новый запрос на вывод средств')
                ->send();
            return $this->redirect('/profile/referrals');
        }
        $model->amount = 2000;
        return $this->render('bonus', ['user' => $user, 'model' => $model]);
    }
}