<?php

namespace app\controllers;

use Yii;
use app\models\Usuario;
use app\models\Modalt;
use app\models\UsuarioSearch;
use app\models\GestorUsuario;
use yii\web\Controller;
use yii\app;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\VarDumper;

class ModaltController extends Controller
{

    public function actionCreate()

    {

        $model = new address();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $model->refresh();

            Yii::$app->response->format = 'json';

            return ['message' => Yii::t('app', 'Success Create!'), 'id' => $model->id];
        }

        return $this->renderAjax('create', ['model' => $model]);
    }



    public function actionUpdate($id)

    {

        $model = $this->findModel($id);


        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $model->refresh();

            Yii::$app->response->format = 'json';

            return ['message' => Yii::t('app', 'Success Update!'), 'id' => $model->id];
        }

        return $this->renderAjax('update', ['model' => $model]);
    }


}


?>