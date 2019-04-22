<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\DataColumn;
use app\models\PagamentoUtil;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FolhaPagamentoUsuarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
//var_dump(Yii::$app->user->identity);
//die('04');
$this->title = 'Folha de Ponto';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="folha-pagamento-usuario-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php
    ?>

    <p>
        <?= Html::a('Nova Folha', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],



            [
                'attribute' => 'fopa_data',
                'filter' => ['Janeiro' => 'Janeiro', 'Fevereiro' => 'Fevereiro', 'Março' => 'Março', 'Abril' => 'Abril', 'Maio' => 'Maio', 'Junho' => 'Junho', 'Julho' => 'Julho', 'Agosto' => 'Agosto', 'Setembro' => 'Setembro', 'Outubro' => 'Outubro', 'Novembro' => 'Novembro', 'Dezembro' => 'Dezembro'],

            ],

            [
                'attribute' => 'fopa_stat',
                'format' => 'raw',
                'filter' => ['1' => 'Aprovado', '2' => 'Reprovado', '0' => 'Pendente'],
                'value' => ['app\models\PagamentoUtil', 'getStatusValue'],
            ],

            [
                // 'class' => 'yii\grid\SerialColumn',
                'attribute' => 'fopa_text',
                'format' => 'raw',

            ],

            [
                'header' => 'Folha',
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['class' => 'text-center'],
                //'format' => 'raw',
                //'showFooter'=>true,
                'template' => "{view}",
                'contentOptions' => ['class' => 'text-center'],
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="btn-label">Download</span>', [Yii::getAlias('') . $model['fopa_arquivo']], ['class' => 'btn btn-default', 'title' => 'Baixar Folha',]);

                        //DOWNLOAD SEM UTILIZAR METODO 
                        /* Html::a('Download', ['download', 'id' => $model->fopa_codi], [
                            'class' => 'btn btn-primary',
                            "title" => 'Aprovar Folha', */
                        /*                             'data' => [
                                'confirm' => " Confirma aprovar a folh a ?", // {Usuario::$usua_nome}",
                                'method' => '"<a href=' " . Yii::getAlias('@web') . $model['fopa_arquivo'] . " '></a>";',
                            ], */
                        //]);
                    },
                ],
            ],


            [

                'header' => 'Edição',
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['class' => 'text-center'],
                // 'headerOptions' => ['style'=>'width: 60%;'],
                'contentOptions' => ['class' => 'text-center'],

                'template' => " {view} {update}", // altera a forma de exibição dos botões
                'buttons' => [

                    'view' => function ($url, $model) {
                        return Html::a('Visualizar', ['view', 'fopa_codi' => $model->fopa_codi, 'fopa_usua' => $model->fopa_usua], [
                            'class' => 'btn btn-primary',
                            "title" => 'Ver Folha',
                        ]);

                        /* <?= Html::Button(Yii::t('app','Apagar'), ['id'=>'btn-confirm','class' => 'btn btn-danger', 'name' => 'apagar','style' => 'width:78px','disabled'=>$desabilitaAPAGA]) ?> */ // DESABILITAR BOTAÃO


                    },
                    'update' => function ($url, $model) {
                        return Html::a('Editar', ['update', 'fopa_codi' => $model->fopa_codi, 'fopa_usua' => $model->fopa_usua], [
                            'class' => 'btn btn-warning',
                            "title" => 'Editar Folha',
                        ]);
                    },

                    //POR PADRAO OPCAO DELETAR ESTA INATIVA NAS RULES

                    /*'delete' => function ($url, $model) {
    return Html::a('Deletar', ['delete', 'id' => $model->fopa_codi], [
    'class' => 'btn btn-danger',
    "title " => 'Excluir usuário',
    'data' => [
    'confirm' => "Deseja excluir usuário: {$model->fopa_codi} ?",
    'method' => 'post',
    ],
    ]);
    },*/
                ],

            ],

        ],
    ]); ?>


</div>