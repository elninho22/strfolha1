<?php

namespace app\controllers;

use Yii;
use app\models\Usuario;
use app\models\UsuarioSearch;
use app\models\GestorUsuario;
use yii\web\Controller;
use yii\app;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\VarDumper;


class UsuarioController extends Controller
{

    public function behaviors()
    {
            //  VarDumper::dump(Yii::$app->user->identity->usua_nivel, 10, true);
            //  die('oi');
            $x = 4;
    if (Yii::$app->user->identity->usua_nivel != 98) {
            return [
                    'access' => [
                    'class' => AccessControl::classname(),
                    'rules' => [
                        [
                            'actions' => ['view', 'index', 'update'],
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                ],
            ];
        }
        elseif(Yii::$app->user->identity->usua_nivel = 98){
        return [
                'access' => [
                    'class' => AccessControl::classname(),
                    'rules' => [
                        [
                           'actions' => ['create','view','index','update'],
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                ],
            ];
        }
    }
    

    public function actionIndex()
    {
        $searchModel = new UsuarioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {   
        if (Yii::$app->user->identity->usua_nivel != 98) { // se for diferente do admin é usuario
            // VarDumper::dump(Yii::$app->user->identity->usua_codi, 10, true);
            // die('oi');
            if (Yii::$app->user->identity->usua_codi != $id) { // ID do usuário é diferente da sessão
            
                throw new NotFoundHttpException("Ops . . . não encontramos o que procurava :( " . "Entre em contato com suporte informando código: 0937");
            }
        }
        return $this->render('view', [
        'model' => $this->findModel($id),
        ]);
       
    }


    public function actionCreate() {

       // criar coluna para gestor ou nao
       // $gest = isset(Yii::$app->request->post('uuu')) ? 1 : 0;
        $model = new Usuario();
        if ($model->load(Yii::$app->request->post())) {
            $model->usua_pass = hash('sha256', $model->usua_pass);
            $model->usua_nivel = 99;
            if($model->save()){
               $usua_codi = $model->usua_codi;
               $gestor = new GestorUsuario();
               $gestor->geus_usua = $model->usua_codi; //pegando id do gestor tabela geus_
               $gestor->geus_gest = $model->usua_guest; //salvando id do gestor tabela geus_
               
               $gestor->save();
                return $this->redirect(['view', 'id' => $model->usua_codi]);
            }

        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }


    public function actionUpdate($id)
    {
        if (Yii::$app->user->identity->usua_nivel != 98) { // se for diferente do admin é usuario
            // VarDumper::dump(Yii::$app->user->identity->usua_codi, 10, true);
            // die('oi');
            if (Yii::$app->user->identity->usua_codi != $id) { // ID do usuário é diferente da sessão

                throw new NotFoundHttpException("Ops . . . não encontramos o que procurava :( " . "Entre em contato com suporte informando código: 0937");
            }
        }
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->usua_pass = hash('sha256', $model->usua_pass);
          if($model->save()) {
               $usua_codi = $model->usua_codi;
               $gestor = new GestorUsuario();
               $gestor->geus_usua = $model->usua_codi; //pegando id do gestor tabela geus_
               $gestor->geus_gest = $model->usua_guest; //salvando id do gestor tabela geus_
               $gestor->save();
            return $this->redirect(['view', 'id' => $model->usua_codi]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    protected function findModel($id)
    {
        if (($model = Usuario::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}