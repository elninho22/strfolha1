<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\DataColumn;
use app\models\PagamentoUtil;
use app\models\Usuario;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FolhaPagamentoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Gerencial - Folha de Ponto';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="folha-pagamento-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php 
        if (Yii::$app->session->hasFlash('folhaSucesso') ){
            echo '<div class="alert alert-success" role="alert">
            '. Yii::$app->session->getFlash('folhaSucesso').'
          </div>';            
        }
        elseif(Yii::$app->session->hasFlash('folhaErro')){
            echo '<div class="alert alert-danger" role="alert">
            '. Yii::$app->session->getFlash('folhaErro').'
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
              //  'filter' => ['Usuarios' => 'Usuarios'], //trazer usuarios do banco
            ],

            [
                'attribute' => 'fopa_data',
                'filter' => ['Janeiro' => 'Janeiro', 'Fevereiro' => 'Fevereiro'],

            ],

            [
                'attribute' => 'fopa_stat',
                'format'=> 'raw',
                'filter' => ['1' => 'Aprovado', '2' => 'Reprovado', '0' => 'Pendente'],
                'value' => ['app\models\PagamentoUtil', 'getStatusValue'],
            ],

            [
               'attribute' => 'fopa_text',
               'format'=> 'raw',
            ],

            [
                //'class' => 'yii\grid\DataColumn',
                'attribute' => 'fopa_arquivo',
                'label' => 'Folha',
                'headerOptions' => ['class' => 'text-center'],
                'format'=> 'raw',
                //'showFooter'=>true,
                'contentOptions' => ['class' => 'text-center'],
                'value'  => function($model){return "<a href='".Yii::getAlias('@web').$model['fopa_arquivo']."'>Download</a>";}
            ],

            /*
            [
                'class' => 'btn btn-success',
                'value'  => function($model){return "<botoes>";},
                'header' => 'Opções',
                'headerOptions' => ['width' => '70'],
            ],*/ // parou aqui

            [
                'header' => 'Opções',
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['class' => 'text-center'],
               // 'headerOptions' => ['style'=>'width: 60%;'],
                'contentOptions' => ['class' => 'text-center'],
                'template' => "{view}     {update}", // altera a forma de exibição dos botões
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('Aprovar', ['aprovar', 'id' => $model->fopa_codi], [
                            'class' => 'btn btn-success',
                            'data' => [
                                'confirm' => 'Confirma Aprovar a folha $model->usua_nome?',
                                'method' => 'post',
                            ],
                        ]);

                    /* <?= Html::Button(Yii::t('app','Apagar'), ['id'=>'btn-confirm','class' => 'btn btn-danger', 'name' => 'apagar','style' => 'width:78px','disabled'=>$desabilitaAPAGA]) ?> */ // DESABILITAR BOTAÃO

                        
                    },
                    'update' => function ($url, $model) {
                        return Html::a('Reprovar', ['reprovar', 'id' => $model->fopa_codi], [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => 'Confirma Reprovar a folha de ?',
                                'method' => 'post',
                            ],
                        ]);

                    },
                ],
            ],
        

        ],
    ]); ?>


</div>


