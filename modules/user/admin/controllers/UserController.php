<?php
/**
 * Created by PhpStorm.
 * User: suhov.a.s
 * Date: 24.07.2018
 * Time: 12:12
 */

namespace modules\user\admin\controllers;

use common\models\Profile;
use common\models\User;
use modules\admin\controllers\AdminController;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

class UserController extends AdminController
{
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
                        'users',
                    ],
                ],
            ],
        ];
        return $behaviors;
    }

    /**
     * Вывод списка юзеров
     * @return string
     */
    public function actionIndex()
    {
        $query = User::find()->alias('u')
            ->leftJoin(Profile::tableName() . ' p', 'u.id = p.user_id');
        $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'sort'  => [
                    'defaultOrder' => [
                        'id' => SORT_DESC
                    ]
                ],
            ]
        );
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    /**
     * Creates a new User model.
     * @return mixed
     */
    public function actionCreate($back)
    {
        $model = new User();
        return $this->modify($model, $back);
    }

    /**
     * @param $id
     * @param $back
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id, $back)
    {
        $model = $this->findModel($id);
        return $this->modify($model, $back);
    }

    /**
     * @param $model User
     * @param $back
     * @return string|\yii\web\Response
     * @throws \yii\base\Exception
     */
    public function modify($model, $back)
    {
        $auth = Yii::$app->authManager;
        $roles = $auth->getRoles();
        $rolesItems = [];
        foreach ($roles as $role => $params) {
            $rolesItems[$role] = $params->description;
        }
        unset($roles['guest']);

        $userRoles = $auth->getRolesByUser($model->id);
        unset($userRoles['guest']);
        $userRolesKeys = array_keys($userRoles);
        $oldRole = $userRole = array_key_exists(0, $userRolesKeys) && $userRolesKeys[0] ? $userRolesKeys[0] : 'user';
        if (Yii::$app->request->isPost) {
            if (array_search(Yii::$app->request->post('userRole'), array_keys($roles)) !== false)
                $userRole = Yii::$app->request->post('userRole');

            if ($model->load(Yii::$app->request->post())) {
                $model->auth_key = Yii::$app->security->generateRandomString();
                $model->setPassword(Yii::$app->request->post('password'));
                if ($model->save()) {
                    if ($oldRole !== $userRole) {
                        $auth->revokeAll($model->id);
                        $auth->assign($roles[$userRole], $model->id);
                    }
                }

                $profile = Profile::findOne(['user_id' => $model->id]);

                if (!$profile) {
                    $profile = new Profile();
                    $profile->user_id = $model->id;
                }

                foreach (Yii::$app->request->post('Profile', []) as $k => $v) {
                    $profile->$k = $v;
                }

                $profile->save();

                return $this->redirect($back);
            }
        }


        return $this->render('_form', [
            'model'      => $model,
            'rolesItems' => $rolesItems,
            'userRole'   => $userRole
        ]);
    }

    /**
     * @param $id
     * @param $back
     * @return \yii\web\Response
     * @throws \Throwable
     */
    public function actionDelete($id, $back)
    {
        $this->findModel($id)->delete();
        return $this->redirect(urldecode($back));
    }

    /**
     * @param $id
     * @return User|null
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}