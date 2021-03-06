<?php

namespace modules\partner\admin\controllers;


use common\models\User;
use modules\admin\controllers\AdminController;
use modules\partner\models\Main;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

class MainController extends AdminController
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
                        'partner_main',
                    ],
                ],
            ],
        ];
        return $behaviors;
    }

    /**
     * @return string
     * @throws \yii\db\Exception
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionIndex()
    {
        $model = Main::getModel();
        $post = Yii::$app->request->post();
        if ($model->load($post)) {

            $logo1 = UploadedFile::getInstance($model, 'main_page_photo_1');
            if ($logo1 && $logo1->tempName) {
                $model->main_page_photo_1 = $logo1;
                if ($model->validate(['main_page_photo_1'])) {
                    $dir = Yii::getAlias('@webroot/uploads/village/item/mainpage/');
                    FileHelper::createDirectory($dir . '/');
                    $fileName =  time().'image1.' . $model->main_page_photo_1->extension;
                    $model->main_page_photo_1->saveAs($dir . '/' . $fileName);
                    $model->main_page_photo_1 = '/uploads/village/item/mainpage/' . $fileName;
                }
            }
            if (!$model->main_page_photo_1 && isset($post['old_main_page_photo_1'])) {
                $model->main_page_photo_1 = $post['old_main_page_photo_1'];
            }

            $logo2 = UploadedFile::getInstance($model, 'main_page_photo_2');
            if ($logo2 && $logo2->tempName) {
                $model->main_page_photo_2 = $logo2;
                if ($model->validate(['main_page_photo_2'])) {
                    $dir = Yii::getAlias('@webroot/uploads/village/item/mainpage/');
                    FileHelper::createDirectory($dir . '/');
                    $fileName = time().'image2.' . $model->main_page_photo_2->extension;
                    $model->main_page_photo_2->saveAs($dir . '/' . $fileName);
                    $model->main_page_photo_2 = '/uploads/village/item/mainpage/' . $fileName;
                }
            }
            if (!$model->main_page_photo_2 && isset($post['old_main_page_photo_2'])) {
                $model->main_page_photo_2 = $post['old_main_page_photo_2'];
            }
            $video1 = UploadedFile::getInstance($model, 'main_page_video_1');
            if ($video1) {
                $model->main_page_video_1 = $video1;
                if ($model->validate(['main_page_video_1'])) {
                    $dir = Yii::getAlias('@webroot/uploads/videos/');
                    $fileName = time() . '.' . $model->main_page_video_1->extension;
                    $model->main_page_video_1->saveAs($dir . $fileName);
                    $model->main_page_video_1 = '/uploads/videos/' . $fileName;
                } else {
                    var_dump($model);
                    die;
                }
            }
            if (!$model->main_page_video_1 && isset($post['old_main_page_video_1'])) {
                $model->main_page_video_1 = $post['old_main_page_video_1'];
            }

            $video2 = UploadedFile::getInstance($model, 'main_page_video_2');
            if ($video2) {
                $model->main_page_video_2 = $video2;
                if ($model->validate(['main_page_video_2'])) {
                    $dir = Yii::getAlias('@webroot/uploads/videos/');
                    $fileName = time() . '.' . $model->main_page_video_2->extension;
                    $model->main_page_video_2->saveAs($dir . $fileName);
                    $model->main_page_video_2 = '/uploads/videos/' . $fileName;
                } else {
                    var_dump($model);
                    die;
                }
            }
            if (!$model->main_page_video_2 && isset($post['old_main_page_video_2'])) {
                $model->main_page_video_2 = $post['old_main_page_video_2'];
            }
            if ($model->save()) {
                return $this->redirect('/admin/modules/partner/main');
            }
        }
        $users = User::getAuthors();
        return $this->render('index', ['model' => $model, 'users' => $users]);
    }
}