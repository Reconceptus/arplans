<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 16.08.2018
 * Time: 11:16
 */

namespace modules\shop\admin\controllers;


use modules\admin\controllers\AdminController;
use modules\shop\models\Catalog;
use modules\shop\models\Category;
use modules\shop\models\Item;
use modules\shop\models\ItemImage;
use modules\shop\models\ItemOption;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Exception;
use yii\filters\AccessControl;
use yii\helpers\FileHelper;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;

class ItemController extends AdminController
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
                        'shop_item',
                    ],
                ],
            ],
        ];
        return $behaviors;
    }

    public function actionIndex()
    {
        $query = Category::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    /**
     * Вывод списка товаров
     * @param $category_id
     * @return string
     */
    public function actionCategory($category_id)
    {
        $query = Item::find()->where(['category_id' => $category_id, 'is_deleted' => Item::IS_NOT_DELETED]);
        $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'sort'  => [
                    'defaultOrder' => [
                        'id' => SORT_ASC
                    ]
                ],
            ]
        );
        return $this->render('category', ['dataProvider' => $dataProvider]);
    }

    /**
     * Создание нового товара
     * @param $category_id integer
     * @return mixed
     */
    public function actionCreate(int $category_id)
    {
        $model = new Item();
        $model->category_id = $category_id;
        return $this->modify($model);
    }

    /**
     * Редактирование товара
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
     * @param $model Item
     * @return string|Response
     */
    public function modify($model)
    {
        $post = Yii::$app->request->post();

        if ($model->load($post)) {
            $project = UploadedFile::getInstance($model, 'project');
            if ($project && $project->tempName) {
                $model->project = $project;
                if ($model->validate(['project'])) {
                    $dir = Yii::getAlias('@webroot/uploads/shop/project/');
                    FileHelper::createDirectory($dir . $model->id . '/');
                    $fileName = 'project.' . $model->project->extension;
                    $model->project->saveAs($dir . $model->id . '/' . $fileName);
                    $model->project = '/uploads/shop/project/' . $model->id . '/' . $fileName;
                } else {
                    var_dump($model->errors);
                }
            }
            if (!$model->project && isset($model->oldAttributes['project'])) {
                $model->project = $model->oldAttributes['project'];
            }
            if ($model->save()) {
                if (isset($post['new-images'])) {
                    $newImages = explode(':', $post['new-images']);
                    foreach ($newImages as $newImage) {
                        if ($newImage) {
                            $image = new ItemImage();
                            $image->item_id = $model->id;
                            $image->image = $newImage;
                            $image->type = ItemImage::TYPE_PHOTO;
                            if (!$image->save()) {
                                throw new Exception('Ошибка сохранения изображения');
                            };
                        }
                    }
                }
                if (isset($post['new-plans'])) {
                    $newPlans = explode(':', $post['new-plans']);
                    foreach ($newPlans as $newPlan) {
                        if ($newPlan) {
                            $image = new ItemImage();
                            $image->item_id = $model->id;
                            $image->image = $newPlan;
                            $image->type = ItemImage::TYPE_PLAN;
                            if (!$image->save()) {
                                throw new Exception('Ошибка сохранения изображения');
                            };
                        }
                    }
                }
                if (isset($post['new-ready'])) {
                    $newPlans = explode(':', $post['new-ready']);
                    foreach ($newPlans as $newPlan) {
                        if ($newPlan) {
                            $image = new ItemImage();
                            $image->item_id = $model->id;
                            $image->image = $newPlan;
                            $image->type = ItemImage::TYPE_READY;
                            if (!$image->save()) {
                                throw new Exception('Ошибка сохранения изображения');
                            };
                        }
                    }
                }
                if (!$model->image) {
                    $model->image_id = $model->images ? $model->images[0]->id : null;
                    $model->save();
                }
                Yii::$app->session->setFlash('success', 'Товар добавлен успешно');
            } else {
                Yii::$app->session->setFlash('danger', 'Ошибка при создании категории');
            }
            if (isset($post['Catalogs'])) {
                foreach ($post['Catalogs'] as $k => $val) {
                    if ($val) {
                        $io = ItemOption::find()->where(['catalog_id' => $k])->andWhere(['item_id' => $model->id])->one();
                        if ($io) {
                            if ($val != $io->catalog_item_id) {
                                $io->catalog_item_id = $val;
                                $io->save();
                            }
                        } else {
                            $io = new ItemOption();
                            $io->item_id = $model->id;
                            $io->catalog_id = $k;
                            $io->catalog_item_id = $val;
                            $io->save();
                        }
                    } else {
                        $io = ItemOption::find()->where(['catalog_id' => $k])->andWhere(['item_id' => $model->id])->one();
                        if ($io) {
                            $io->delete();
                        }
                    }
                }
            }

            return $this->redirect(Url::to(['/admin/modules/shop/item/update', 'id' => $model->id]));
        }
        $catalogs = Catalog::getCategoryCatalogs($model->category_id);

        return $this->render('_form', [
            'model'    => $model,
            'catalogs' => $catalogs
        ]);
    }

    /**
     * Загрузка фото по ajax
     * @return array
     */
    public function actionUpload()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        if (empty($_FILES['images'])) {
            return ['success' => 'fail', 'message' => 'Не найдены файлы для загрузки'];
        }

        $images = $_FILES['images'];
        $success = null;
        $paths = [];
        $blocks = [];
        $fullPaths = [];
        $filenames = $images['name'];
        $dir = Yii::getAlias('@webroot/uploads/shop/item/');
        $path = date('ymdHis') . '/';
        if (!is_dir($dir . $path)) {
            FileHelper::createDirectory($dir . $path);
        }

        for ($i = 0; $i < count($filenames); $i++) {
            $fileName = str_replace(' ', '_', $filenames[$i]);
            $target = $dir . $path . $fileName;
            if (move_uploaded_file($images['tmp_name'][$i], $target)) {
                $success = true;
                $paths[] = '/uploads/shop/item/' . $path . $fileName;
                $fullPaths[] = $dir . $path . $fileName;
                $model = new ItemImage();
                $model->image = '/uploads/shop/item/' . $path . $fileName;
                $blocks[] = $this->renderAjax('_image', ['model' => $model]);
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
     * Удаление картинки товара через ajax
     * @return array
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDeleteImage()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $get = Yii::$app->request->get();
        if (intval($get['id'])) {
            $model = ItemImage::findOne(['id' => $get['id']]);
            $item = Item::find()->where(['image_id' => $get['id']])->one();
            if ($model) {
                $fileName = Yii::getAlias('@webroot') . $model->image;
                if (file_exists($fileName) && is_file($fileName)) {
                    unlink($fileName);
                }
                $thumbName = Yii::getAlias('@webroot') . $model->thumb;
                if (file_exists($thumbName) && is_file($thumbName)) {
                    unlink($thumbName);
                }
                $model->delete();
                if ($item) {
                    $item->image_id = null;
                    $item->save();
                }
            } else {
                return ['status' => 'fail', 'message' => 'Ошибка при удалении изображеия'];
            }
        } elseif (isset($get['file'])) {
            $fileName = Yii::getAlias('@webroot') . $get['file'];
            unlink($fileName);
        }
        return ['status' => 'success'];
    }

    /**
     * Устанавливает через ajax основное фото для товара
     * @return array
     */
    public function actionSetPreview()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $id = Yii::$app->request->get('id');
        $model = ItemImage::findOne(['id' => $id]);
        if ($model) {
            $item = $model->item;
            if ($item) {
                $item->image_id = $model->id;
                if ($item->save()) {
                    return ['status' => 'success'];
                }
            }
        }
        return ['status' => 'fail'];
    }

    /**
     * @return Response
     * @throws NotFoundHttpException
     * @throws \yii\base\Exception
     */
    public function actionDelete()
    {
        $model = $this->findModel(Yii::$app->request->get('id'));
        $model->is_deleted = Item::IS_DELETED;
        if ($model->save()) {
            return $this->redirect(Yii::$app->request->get('back'));
        }
        throw new \yii\base\Exception('Ошибка при удалении товара');
    }

    /**
     * @param int $id
     * @return Response
     * @throws NotFoundHttpException
     */
    public function actionClone(int $id)
    {
        $model = self::findModel($id);
        if ($model) {
            $newModel = new Item();
            $newModel->setAttributes($model->attributes);
            $newModel->slug = $newModel->slug . rand();
            if ($newModel->save()) {
                foreach ($model->itemOptions as $io) {
                    $newIo = new ItemOption();
                    $newIo->setAttributes($io->attributes);
                    $newIo->item_id = $newModel->id;
                    $newIo->save();
                }
                foreach ($model->images as $image) {
                    $newImage = new ItemImage();
                    $newImage->setAttributes($image->attributes);
                    $newImage->item_id = $newModel->id;
                    $newImage->save();
                }
            }
        }
        return $this->redirect(['/admin/modules/shop/item/category', 'category_id' => $model->category_id]);
    }


    /**
     * @param $id
     * @return Item|null/ActiveRecord
     * @throws NotFoundHttpException
     */
    public function findModel($id)
    {
        if (($model = Item::find()->where(['id' => $id])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}