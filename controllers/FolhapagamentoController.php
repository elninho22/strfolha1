<?php

namespace app\controllers;

use Yii;
use app\models\FolhaPagamento;
use app\models\FolhaPagamentoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FolhaPagamentoController implements the CRUD actions for FolhaPagamento model.
 */
class FolhapagamentoController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all FolhaPagamento models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FolhaPagamentoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }



    /**
     * Displays a single FolhaPagamento model.
     * @param integer $fopa_codi
     * @param integer $fopa_usua
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($fopa_codi, $fopa_usua)
    {
        return $this->render('view', [
            'model' => $this->findModel($fopa_codi, $fopa_usua),
        ]);
    }

    /**
     * Creates a new FolhaPagamento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FolhaPagamento();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'fopa_codi' => $model->fopa_codi, 'fopa_usua' => $model->fopa_usua]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing FolhaPagamento model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $fopa_codi
     * @param integer $fopa_usua
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($fopa_codi, $fopa_usua)
    {
        $model = $this->findModel($fopa_codi, $fopa_usua);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'fopa_codi' => $model->fopa_codi, 'fopa_usua' => $model->fopa_usua]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing FolhaPagamento model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $fopa_codi
     * @param integer $fopa_usua
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($fopa_codi, $fopa_usua)
    {
        $this->findModel($fopa_codi, $fopa_usua)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the FolhaPagamento model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $fopa_codi
     * @param integer $fopa_usua
     * @return FolhaPagamento the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($fopa_codi, $fopa_usua)
    {
        if (($model = FolhaPagamento::findOne(['fopa_codi' => $fopa_codi, 'fopa_usua' => $fopa_usua])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
