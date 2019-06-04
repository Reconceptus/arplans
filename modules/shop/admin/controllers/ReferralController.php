<?php
/**
 * Created by PhpStorm.
 * User: suhov.a.s
 * Date: 24.07.2018
 * Time: 12:12
 */

namespace modules\shop\admin\controllers;

use common\models\User;
use modules\admin\controllers\AdminController;
use Yii;
use yii\data\ArrayDataProvider;
use yii\filters\AccessControl;

class ReferralController extends AdminController
{
    /**
     * @return array
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['access'] = [
            'class'        => AccessControl::className(),
            'denyCallback' => function () {
                return $this->redirect('/');
            },
            'rules'        => [
                [
                    'actions' => [],
                    'allow'   => true,
                    'roles'   => [
                        'shop_referral',
                    ],
                ],
            ],
        ];
        return $behaviors;
    }


    /**
     * Вывод списка рефереров
     * @return string
     */
    public function actionIndex()
    {
        Yii::$app->request->baseUrl = '/admin/modules';
        $models = User::find()->select(['id', 'username', 'created_at', 'bonus_total', 'bonus_payed'])->where(['status' => User::STATUS_ACTIVE, 'is_referrer' => 1])->asArray()->all();
        $refs = User::find()->select('count(referrer_id) as count')->where(['is not', 'referrer_id', null])->andWhere(['status' => User::STATUS_ACTIVE])->groupBy('referrer_id')->indexBy('referrer_id')->asArray()->column();
        foreach ($models as &$model) {
            $model['balance'] = $model['bonus_total'] - $model['bonus_payed'];
            $model['created_at'] = date('Y-m-d H:i:s', $model['created_at']);
            $model['referrals'] = array_key_exists($model['id'], $refs) ? intval($refs[$model['id']]) : 0;
        }

        $filteredresultData = array_filter($models, function ($item) {
            $username = Yii::$app->request->getQueryParam('username', '');
            if (strlen($username) > 0) {
                if (strpos($item['username'], $username) !== false) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return true;
            }
        });

        $mailfilter = Yii::$app->request->getQueryParam('username', '');
        $searchModel = ['email' => $mailfilter];
        $dataProvider = new ArrayDataProvider([
            'allModels'  => $filteredresultData,
            'sort'       => [
                'defaultOrder' => ['referrals' => SORT_DESC],
                'attributes'   => ['id', 'username', 'created_at', 'referrals', 'bonus_total', 'bonus_payed', 'balance'],
            ],
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return $this->render('index', ['dataProvider' => $dataProvider, 'searchModel'=>$searchModel]);
    }
}