<?php

namespace frontend\controllers;

use common\models\Config;
use common\models\LoginForm;
use common\models\Request;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use modules\partner\models\About;
use modules\partner\models\AboutBenefit;
use modules\partner\models\AboutReady;
use modules\partner\models\Collaboration;
use modules\partner\models\Reviews;
use Yii;
use yii\base\InvalidParamException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only'  => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow'   => true,
                        'roles'   => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow'   => true,
                        'roles'   => ['@'],
                    ],
                ],
            ],
            'verbs'  => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post', 'get'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error'   => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class'           => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function beforeAction($action)
    {
        if ($action->id == 'request') {
            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if (Yii::$app->user->can('adminPanel')) {
                return $this->redirect('/admin');
            }
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        if (Yii::$app->request->get('toLogin')) {
            return $this->redirect('/site/login');
        }
        return $this->goHome();
    }

    public function actionRequest()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new Request();
        $post = Yii::$app->request->post();
        if (isset($post['Request']['accept'])) {
            $post['Request']['accept'] = 1;
        }
        if (Yii::$app->request->isAjax && $model->load($post)) {
            $file = UploadedFile::getInstance($model, 'file');
            if ($model->save()) {
                $mail = Yii::$app->mailer->compose('request', ['model' => $model])
                    ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
                    ->setTo(Config::getValue('requestEmail'))
                    ->setSubject('Новый запрос');
                if ($file) {
                    $mail->attachContent(file_get_contents($file->tempName), ['fileName' => $file->baseName . '.' . $file->extension]);
                }
                $mail->send();
                return ['status' => 'success', 'message' => 'Ваш  запрос успешно отправлен. В ближайшее время мы с вами свяжемся'];
            } else {
                return ['status' => 'fail'];
            }
        }

    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContacts()
    {
        $request = new Request();
        if ($request->load(Yii::$app->request->post()) && $request->validate()) {
            $file = UploadedFile::getInstance($request, 'file');
            if ($request->save()) {
                $mail = Yii::$app->mailer->compose('request', ['model' => $request, 'type' => Yii::$app->request->post('type')])
                    ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
                    ->setTo(Config::getValue('requestEmail'))
                    ->setSubject('Новый запрос');
                if ($file) {
                    $mail->attachContent(file_get_contents($file->tempName), ['fileName' => $file->baseName . '.' . $file->extension]);
                }
                $mail->send();
            }
            return $this->redirect(Yii::$app->request->referrer);
        }
        $model = About::getModel();
        $query = About::getFilteredQuery(Yii::$app->request->get());
        return $this->render('contacts', [
            'model'   => $model,
            'request' => $request,
            'query'   => $query
        ]);
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        $benefits = AboutBenefit::find()->all();
        $reviews = Reviews::find()->all();
        $readyProjects = AboutReady::find()->all();
        $model = About::getModel();
        $query = About::getFilteredQuery(Yii::$app->request->get());
        return $this->render('about', [
            'query'         => $query,
            'model'         => $model,
            'benefits'      => $benefits,
            'reviews'       => $reviews,
            'readyProjects' => $readyProjects
        ]);
    }

    /**
     * Displays collaboration page.
     *
     * @return mixed
     */
    public function actionCollaboration()
    {
        $model = Collaboration::getModel();
        return $this->render('collaboration', [
            'model' => $model
        ]);
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    Yii::$app->mailer->compose('registration', ['model' => $model])
                        ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
                        ->setTo($user->email)
                        ->setSubject('Регистрация на сайте ' . Yii::$app->name)
                        ->send();
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', ['model' => $model,]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public
    function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->refresh();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public
    function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
