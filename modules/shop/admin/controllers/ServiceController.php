<?php

namespace modules\shop\admin\controllers;


use modules\admin\controllers\AdminController;
use modules\shop\models\Service;
use modules\shop\models\ServiceBenefit;
use modules\shop\models\ServiceFile;
use modules\shop\models\ServiceImage;
use Yii;
use yii\base\Exception;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
use yii\filters\AccessControl;
use yii\helpers\FileHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class ServiceController extends AdminController
{
    /**
     * @return array
     */
    public function actions()
    {
        return [
            'image-upload' => [
                'class'            => 'vova07\imperavi\actions\UploadFileAction',
                'url'              => '/uploads/images/posts', // Directory URL address, where files are stored.
                'path'             => '@webroot/uploads/images/posts', // Or absolute path to directory where files are stored.
                'translit'         => true,
                'validatorOptions' => [
                    'maxWidth'  => 1200,
                    'maxHeight' => 1000
                ],
            ],
            ''
        ];
    }

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
                        'shop_service',
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
        $query = Service::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    /**
     * Создание новой услуги
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Service();
        return $this->modify($model);
    }

    /**
     * Редактирование услуги
     * @param $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        return $this->modify($model);
    }

    /**
     * Удаление услуги
     * @param $id
     * @return Response
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if (!$model) {
            throw new NotFoundHttpException();
        }
        $model->delete();
        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * @return array
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDeleteBenefit()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $id = intval(Yii::$app->request->get('id'));
        if ($id) {
            $model = ServiceBenefit::findOne(['id' => $id]);
            if ($model) {
                $model->delete();
                return ['status' => 'success'];
            }
        }
        return ['status' => 'fail', 'message' => 'Ошибка при удалении'];
    }

    /**
     * @param $model Service
     * @return string|Response
     * @throws Exception
     */
    public function modify($model)
    {
        $post = Yii::$app->request->post();

        if ($model->load($post)) {
            if ($model->save()) {
                if (isset($post['new-images'])) {
                    $newImages = explode(':', $post['new-images']);
                    foreach ($newImages as $newImage) {
                        if ($newImage) {
                            $image = new ServiceImage();
                            $image->service_id = $model->id;
                            $image->file = $newImage;
                            $image->makeThumb();
                        }
                    }
                }
                if (isset($post['new-files'])) {
                    $newFiles = explode(':', $post['new-files']);
                    foreach ($newFiles as $newFile) {
                        if ($newFile) {
                            $file = new ServiceFile();
                            $file->service_id = $model->id;
                            $file->file = $newFile;
                            if (!$file->save()) {
                                throw new Exception('Ошибка сохранения файла');
                            };
                        }
                    }
                }
                if (isset($post['new-benefits'])) {
                    $newBenefits = explode('~', $post['new-benefits']);
                    foreach ($newBenefits as $newBenefit) {
                        if ($newBenefit) {
                            $data = explode('|', $newBenefit);
                            $benefit = new ServiceBenefit();
                            $benefit->service_id = $model->id;
                            $benefit->name = $data[0];
                            $benefit->text = $data[1];
                            if (!$benefit->save()) {
                                throw new Exception('Ошибка сохранения');
                            };
                        }
                    }
                }
                Yii::$app->session->setFlash('success', 'Услуга добавлена успешно');
            } else {
                Yii::$app->session->setFlash('danger', 'Ошибка при добавлении услуги');
            }
            return $this->redirect(Url::to(['/admin/modules/shop/service/update', 'id' => $model->id]));
        }

        return $this->render('_form', [
            'model' => $model,
        ]);
    }

    /**
     * Загрузка файлов по ajax
     * @return array
     */
    public function actionUpload()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        if (empty($_FILES['images'])) {
            return ['success' => 'fail', 'message' => 'Не найдены файлы для загрузки'];
        }
        $type = Yii::$app->request->post('type');

        $images = $_FILES['images'];
        $success = null;
        $paths = [];
        $blocks = [];
        $fullPaths = [];
        $fileNames = $images['name'];
        if ($type === Service::TYPE_IMAGE) {
            $dirs = 'uploads/service/image/';
            $view = '_image';
        } else {
            $dirs = 'uploads/service/file/';
            $view = '_file';
        }
        $dir = Yii::getAlias('@webroot/' . $dirs);

        $path = date('ymdHis') . '/';
        if (!is_dir($dir . $path)) {
            FileHelper::createDirectory($dir . $path);
        }
        for ($i = 0; $i < count($fileNames); $i++) {
            $fileName = str_replace(' ', '_', $fileNames[$i]);
            $target = $dir . $path . $fileName;
            if (move_uploaded_file($images['tmp_name'][$i], $target)) {
                $success = true;
                $paths[] = '/' . $dirs . $path . $fileName;
                $fullPaths[] = $dir . $path . $fileName;
                if ($type === Service::TYPE_IMAGE) {
                    $model = new ServiceImage();
                } else {
                    $model = new ServiceFile();
                }
                $model->file = '/' . $dirs . $path . $fileName;
                $blocks[] = $this->renderAjax($view, ['model' => $model]);
            } else {
                $success = false;
                break;
            }
        }
        if ($success === true) {
            $output = ['status' => 'success', 'files' => $paths, 'type' => Yii::$app->request->post('type'), 'blocks' => $blocks];
        } elseif ($success === false) {
            $output = ['status' => 'fail', 'message' => 'Ошибка при загрузке файлов, обратитесь к разработчику'];
            foreach ($fullPaths as $file) {
                unlink($file);
            }
        } else {
            $output = ['status' => 'fail', 'message' => 'Файлы не были загружены.'];
        }

        return $output;
    }

    /**
     * @param $id
     * @return ActiveRecord|null
     * @throws NotFoundHttpException
     */
    public function findModel($id)
    {
        if (($model = Service::find()->where(['id' => $id])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionDeleteImage()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $get = Yii::$app->request->get();
        if (intval($get['id'])) {
            $model = ServiceImage::findOne(['id' => $get['id']]);
            if ($model) {
                $fileName = Yii::getAlias('@webroot') . $model->file;
                if (file_exists($fileName) && is_file($fileName)) {
                    unlink($fileName);
                }
                $model->delete();
            } else {
                return ['status' => 'fail', 'message' => 'Ошибка при удалении изображеия'];
            }
        } elseif (isset($get['file'])) {
            $fileName = Yii::getAlias('@webroot') . $get['file'];
            unlink($fileName);
        }
        return ['status' => 'success'];
    }


    public function actionSetAlt()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $get = Yii::$app->request->get();
        $model = ServiceImage::findOne(['id' => $get['id']]);
        $model->alt = Html::encode($get['alt']);
        if ($model->save()) {
            return ['status' => 'success'];
        }
        return ['status' => 'fail'];
    }

    public function actionDeleteFile()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $get = Yii::$app->request->get();
        if (intval($get['id'])) {
            $model = ServiceFile::findOne(['id' => $get['id']]);
            if ($model) {
                $fileName = Yii::getAlias('@webroot') . $model->file;
                if (file_exists($fileName) && is_file($fileName)) {
                    unlink($fileName);
                }
                $model->delete();
            } else {
                return ['status' => 'fail', 'message' => 'Ошибка при удалении файла'];
            }
        } elseif (isset($get['file'])) {
            $fileName = Yii::getAlias('@webroot') . $get['file'];
            unlink($fileName);
        }
        return ['status' => 'success'];
    }
}