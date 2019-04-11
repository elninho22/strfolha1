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
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="folha-pagamento-usuario-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Nova Folha', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
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
              // 'class' => 'yii\grid\SerialColumn',
               'attribute' => 'fopa_text',
               'format'=> 'raw',

            ],

            [
                'attribute' => 'fopa_arquivo',
                'label' => 'Folha',
                'headerOptions' => ['class' => 'text-center'],
                'format'=> 'raw',
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
                'header' => 'Edição',
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['class' => 'text-center'],
                'headerOptions' => ['width' => '80','class' => 'text-center'],
            ],

        ],
    ]); ?>


</div>


