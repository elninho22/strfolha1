<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\DataColumn;
use app\models\PagamentoUtil;
use app\models\Usuario;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use app\assets\AppAsset;
use app\models\FolhaPagamento;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FolhaPagamentoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Gerencial - Folha de Ponto';


//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="folha-pagamento-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php

    //$usua_codi = $model->usua_codi;

    ?>

    <p>
        <?php
        if (Yii::$app->session->hasFlash('folhaSucesso')) {
            echo '<div class="alert alert-success" role="alert">
            ' . Yii::$app->session->getFlash('folhaSucesso') . '
          </div>';
        } elseif (Yii::$app->session->hasFlash('folhaErro')) {
            echo '<div class="alert alert-danger" role="alert">
            ' . Yii::$app->session->getFlash('folhaErro') . '
          </div>';
        }
        ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        //'layout'=>"{sorter}\n{pager}\n{summary}\n{items}",
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [

                'attribute' => 'fopa_usua',
                'value' => function ($model) {
                    return FolhaPagamento::nomeUsuario($model['fopa_usua'])->usua_nome;
                }
                // 'filter' => ['Usuarios' => 'Usuarios'], //trazer usuarios do banco
            ],

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
                'attribute' => 'fopa_text',
                'format' => 'raw',
                // 'headerOptions' => ['class' => 'text-center', 'style' => 'width: 30%;'],
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
                        return Html::a('<span class="btn-label">Download</span>', [Yii::getAlias('') . $model['fopa_arquivo']], ['class' => 'btn btn-default']);

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
                'header' => 'Opções',
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['class' => 'text-center', 'style' => 'width: 24%;'],
                'contentOptions' => ['class' => 'text-center'],
                'template' => "{view} {update} {delete}", // altera a forma de exibição dos botões
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('Aprovar', ['aprovar', 'id' => $model->fopa_codi], [
                            'class' => 'btn btn-success',
                            "title" => 'Aprovar Folha',
                            'data' => [
                                'confirm' => "Aprovar folha do colaborador: " .  FolhaPagamento::nomeUsuario($model['fopa_usua'])->usua_nome . " ? ",
                                'method' => 'post',
                            ],
                        ]);
                    },
                    //'update' => [], man n ta cansado mao kraai ? 
                    //aqui teria q clicar e abrir a MODAL - com campo texto e o botao reprovar ! em seguida o disparo de amil kkkkk ok
                    'update' => function ($url, $model) {
                        return '<button type="button" id="'.FolhaPagamento::nomeUsuario($model['fopa_usua'])->usua_mail .'" class="btn btn-danger" data-toggle="modal" data-target="#modalReprovar" title="Reprovar Folha">Reprovar</button>';
                        //"title" => 'Visualizar Folha',
                        // return Html::a('Reprovar', ['reprovar', 'id' => $model->fopa_codi], [
                        // 'class' => 'btn btn-danger',
                        // "title" => 'Reprovar Folha',
                        // 'data' => [
                        // 'confirm' => 'Confirma reprovar a folha de ?',
                        // 'method' => 'post',
                        // ],
                        // ]);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('Visualizar', ['view', 'fopa_codi' => $model->fopa_codi, 'fopa_usua' => $model->fopa_usua], [
                            'class' => 'btn btn-primary',
                            "title" => 'Visualizar Folha',
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>
</div>

<?= $this->render('_modals') ?>