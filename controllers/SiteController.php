<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionCreate()
    {
        $model = new Usuario();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->usua_codi]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    public function actionIndex()
    {
        if (isset(Yii::$app->user->identity->usua_codi) ? Yii::$app->user->identity->usua_nivel == 98 : null) {

            return $this->redirect([@Yii::getAlias('/folhapagamento/') . '']);
        }
        if (isset(Yii::$app->user->identity->usua_codi) ? Yii::$app->user->identity->usua_nivel == 99 : null) {
            return $this->redirect([@Yii::getAlias('/folhapagamentousuario/') . '']);
        } else {
            //return $this->render(['index']);
            $this->layout = 'SLayout';
            
            return $this->render('index');
        }        //return $this->render('folhapagamento/folhapagamento');
    }

    public function actionLogin()
    {
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post())) {
            //  var_dump( Yii::$app->user->identity);
            // die('ads');
            if ($model->login()) {
                if (Yii::$app->user->identity->usua_nivel == 98 && Yii::$app->user->identity->usua_logi == 20) {
                    return $this->redirect(['folhapagamento/index']);
                } elseif (Yii::$app->user->identity->usua_nivel == 99) {
                    return $this->redirect(['folhapagamentousuario/index']);
                } else {
                    return $this->redirect(['site/login']);
                }
            }
        }

        $model->usua_pass = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        $session = Yii::$app->session;
        Yii::$app->user->logout();
        return $this->goHome();
        $session->close();
        // destrói todos os dados registrados em uma sessão.
        $session->destroy();

        return $this->redirect(['site/login']);
        //return $this->goHome();
    }

    //pagina sera criada para mostrar qnt de aprovacoes por usuarios e etc
    public function actionrRelatorios()
    {
        /* $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh(); 
        }*/
        return $this->render('relatorios'); /* , [
            'model' => $model,
        ]); */
    }
}
