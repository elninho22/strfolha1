<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usuários';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuario-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php
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
            'usua_guest',
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
                        return Html::a('Deletar', ['delete', 'id' => $model->usua_codi], [
                            'class' => 'btn btn-danger',
                            "title " => 'Excluir usuário',
                            'data' => [
                                'confirm' => "Deseja excluir usuário: {$model->usua_nome} ?",
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