<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 16.08.2018
 * Time: 16:02
 */

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
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;

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
                            if (!$image->save()) {
                                throw new Exception('Ошибка сохранения изображения');
                            };
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
        $type = Yii::$app->request->post('type');
        if ($type === Service::TYPE_IMAGE) {
            $model = new ServiceImage();
            $view = '_image';
        } else {
            $model = new ServiceFile();
            $view = '_file';
        }
        $file = UploadedFile::getInstance($model, 'file');
        if ($file && $file->tempName) {
            $model->file = $file;
            if ($model->validate(['file'])) {
                $dir = Yii::getAlias('@webroot/uploads/service/' . $type . '/');
                $path = date('ymdHis') . '/';
                \common\models\Image::createDirectory($dir . $path);
                $fileName = str_replace(' ', '_', $model->file->baseName) . '.' . $model->file->extension;
                $model->file->saveAs($dir . $path . $fileName);
                $model->file = '/uploads/service/' . $type . '/' . $path . $fileName;
                if ($type === Service::TYPE_IMAGE) {
//                    $photo = Image::getImagine()->open($dir . $path . $fileName);
//                    $photo->thumbnail(new Box(900, 900))->save($dir . $path . $fileName, ['quality' => 90]);
                }
                if (file_exists($dir . $path . $fileName)) {
                    return ['status' => 'success', 'file' => $model->file, 'type' => $type, 'block' => $this->renderAjax($view, ['model' => $model])];
                }
            }
        }
        return ['status' => 'fail', 'message' => ' Ошибка при загрузке'];
    }

    /**
     * @return array
     */
    public function actionAddBenefit()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $get = Yii::$app->request->get();
        if (isset($get['name']) && isset($get['text']) && isset($get['service_id'])) {
            $model = new ServiceBenefit();
            $model->name = Html::encode($get['name']);
            $model->text = Html::encode($get['text']);
            $model->service_id = intval($get['service_id']);
            if ($model->save()) {
                return ['status' => 'success', 'block' => $this->renderAjax('_benefit', ['model' => $model])];
            }
        }
        return ['status' => 'fail', 'message' => 'Ошибка при добавлении'];
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
}