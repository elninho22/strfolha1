<?php

namespace app\controllers;

use Yii;
use app\models\Usuario;
use app\models\UsuarioSearch;
use app\models\GestorUsuario;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * UsuarioController implements the CRUD actions for Usuario model.
 */
class UsuarioController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        /* return [
            'acess'=> [
                'class' => AccessControl::classname(),
                'allow' => ['create', 'delete', 'update', 'view','index'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ]; */
        return [
            /*  'acess'=> [
                'class' => AccessControl::classname(),
               // 'only' => ['create', 'delete', 'update', 'view','index'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],*/
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Usuario models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsuarioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Usuario model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Usuario model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {

       // criar coluna para gestor ou nao
       // $gest = isset(Yii::$app->request->post('uuu')) ? 1 : 0;
        $model = new Usuario();
        if ($model->load(Yii::$app->request->post())) {
            $model->usua_pass = hash('sha256', $model->usua_pass);
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

     /* If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
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

    /**
     * Deletes an existing Usuario model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Usuario model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Usuario the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Usuario::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}