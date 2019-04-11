<?php

namespace app\controllers;

use Yii;
use app\models\FolhaHistorico;
use app\models\FolhaHistoricoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\FolhaPagamento;
use app\models\FolhaPagamentoSearch;
use app\models\Usuario;
use app\models\UsuarioSearch;
use app\models\GestorUsuario;
use app\components\Upload;
use app\components\Uteis;

/**
 * FolhaHistoricoController implements the CRUD actions for FolhaHistorico model.
 */
class FolhahistoricoController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
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
     * Lists all FolhaHistorico models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FolhaHistoricoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FolhaHistorico model.
     * @param integer $fohi_codi
     * @param integer $fopa_fopa
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($fohi_codi, $fopa_fopa)
    {
        return $this->render('view', [
            'model' => $this->findModel($fohi_codi, $fopa_fopa),
        ]);
    }

    /**
     * Creates a new FolhaHistorico model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FolhaHistorico();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'fohi_codi' => $model->fohi_codi, 'fopa_fopa' => $model->fopa_fopa]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing FolhaHistorico model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $fohi_codi
     * @param integer $fopa_fopa
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($fohi_codi, $fopa_fopa)
    {
        $model = $this->findModel($fohi_codi, $fopa_fopa);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'fohi_codi' => $model->fohi_codi, 'fopa_fopa' => $model->fopa_fopa]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing FolhaHistorico model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $fohi_codi
     * @param integer $fopa_fopa
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($fohi_codi, $fopa_fopa)
    {
        $this->findModel($fohi_codi, $fopa_fopa)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the FolhaHistorico model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $fohi_codi
     * @param integer $fopa_fopa
     * @return FolhaHistorico the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($fohi_codi, $fopa_fopa)
    {
        if (($model = FolhaHistorico::findOne(['fohi_codi' => $fohi_codi, 'fopa_fopa' => $fopa_fopa])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
