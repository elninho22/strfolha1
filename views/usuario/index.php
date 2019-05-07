<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Usuario;
use app\models\UsuarioSearch;
use app\models\GestorUsuario;
use yii\widgets\DetailView;;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usuários';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuario-index">

    <h1><?= Html::encode($this->title) ?></h1>
            <?php
        if (Yii::$app->session->hasFlash('ativuser')) {
            echo '<div class="alert alert-success" role="alert">
            ' . Yii::$app->session->getFlash('ativuser') . '
          </div>';
        } elseif (Yii::$app->session->hasFlash('bloquser')) {
            echo '<div class="alert alert-danger" role="alert">' . Yii::$app->session->getFlash('bloquser') . '
          </div>';
        }
        ?>
    <p>
        <?= Html::a('Novo Usuário', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'usua_nome',
            'usua_mail',
            [
                'attribute' => 'usua_guest',
                'contentOptions' => ['class' => 'text-center'],
                'value' => function ($model) {
                    return Usuario::nomeGestor($model['usua_guest'])->usua_nome;
                    var_dump($model);
                    die('sf');
                }
                /* 'value' => function ($model) {
                    return Usuario::nomeGestor($model['usua_guest'])->usua_nome;
                }*/
            ],
            [

                'header' => 'Edição',
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['class' => 'text-center'],
                // 'headerOptions' => ['style'=>'width: 60%;'],
                'contentOptions' => ['class' => 'text-center'],

                'template' => "{view} {update} {delete}", // altera a forma de exibição dos botões
                'buttons' => [

                    'view' => function ($url, $model) {
                        return Html::a('Visualizar', ['view', 'id' => $model->usua_codi], [
                            'class' => 'btn btn-primary',
                            "title" => 'Ver Usuário',
                        ]);

                        /* <?= Html::Button(Yii::t('app','Apagar'), ['id'=>'btn-confirm','class' => 'btn btn-danger', 'name' => 'apagar','style' => 'width:78px','disabled'=>$desabilitaAPAGA]) ?> */ // DESABILITAR BOTAÃO


                    },
                    'update' => function ($url, $model) {
                        return Html::a('Editar', ['update', 'id' => $model->usua_codi], [
                            'class' => 'btn btn-warning',
                            "title" => 'Editar Usuário',
                        ]);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('Inativar', ['inativar', 'id' => $model->usua_codi], [
                            'class' => 'btn btn-danger',
                            "title " => 'Bloquear usuário',
                            'data' => [
                                'confirm' => "Deseja bloquear usuário: {$model->usua_nome} ?",
                                'method' => 'post',
                            ],
                        ]);
                    },
                ],

            ],

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>