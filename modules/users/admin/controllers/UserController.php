<?php
/**
 * Created by PhpStorm.
 * User: suhov.a.s
 * Date: 24.07.2018
 * Time: 12:12
 */

namespace modules\users\admin\controllers;

use common\models\Image;
use common\models\Profile;
use common\models\User;
use modules\admin\controllers\AdminController;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\FileHelper;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

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
                        'users_user',
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
        Yii::$app->request->baseUrl = '/admin/modules';
        $filterModel = new User();
        $query = User::find()->alias('u')
            ->leftJoin(Profile::tableName() . ' p', 'u.id = p.user_id');
        $filter = Yii::$app->request->get('User');
        if (isset($filter['username'])) {
            $query->andFilterWhere(['like', 'username', $filter['username']]);
        }
        if (isset($filter['fio'])) {
            $query->andFilterWhere(['like', 'fio', $filter['fio']]);
        }
        if (isset($filter['status'])) {
            $query->andFilterWhere(['status' => $filter['status']]);
        }
        if (isset($filter['role'])) {
            $query->andFilterWhere(['role' => $filter['role']]);
        }
        $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'sort'  => [
                    'defaultOrder' => [
                        'id' => SORT_DESC
                    ]
                ],
            ]
        );
        return $this->render('index', ['dataProvider' => $dataProvider, 'filterModel' => $filterModel]);
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
                if ($model->email && !$model->username) {
                    $model->username = $model->email;
                }
                $model->auth_key = Yii::$app->security->generateRandomString();
                if (Yii::$app->request->post('password')) {
                    $model->setPassword(Yii::$app->request->post('password'));
                }
                if ($model->save()) {
                    if ($oldRole !== $userRole) {
                        $auth->revokeAll($model->id);
                        $auth->assign($roles[$userRole], $model->id);
                        $model->role = $userRole;
                        $model->save();
                    }
                }

                $profile = Profile::findOne(['user_id' => $model->id]);

                if (!$profile) {
                    $profile = new Profile();
                    $profile->user_id = $model->id;
                }

                if ($profile->load(Yii::$app->request->post())) {
                    $image = UploadedFile::getInstance($profile, 'image');
                    if ($image && $image->tempName) {
                        $profile->image = $image;
                        if ($profile->validate(['image'])) {
                            $dir = Yii::getAlias('@webroot/uploads/user/avatar/');
                            FileHelper::createDirectory($dir . $model->id . '/');
                            $fileName = 'avatar.' . $profile->image->extension;
                            if (file_exists($dir . $model->id . '/' . $fileName)) {
                                unlink($dir . $model->id . '/' . $fileName);
                            }
                            $profile->image->saveAs($dir . $model->id . '/' . $fileName);
                            $profile->image = '/uploads/user/avatar/' . $model->id . '/' . $fileName;
                            Image::thumbImage($profile->image, 240, false, 30);
                        }
                        if (!$profile->image && isset($profile->oldAttributes['image'])) {
                            $profile->image = $profile->oldAttributes['image'];
                        }
                    }

                    $profile->save();

                    return $this->redirect($back);
                }
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
        $model = $this->findModel($id);
        if ($model) {
            $model->status = 0;
            $model->save();
        }
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