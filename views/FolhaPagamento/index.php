<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\PagamentoUtil;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FolhaPagamentoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Folha de Ponto';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="folha-pagamento-index">

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
            
            
            'fopa_usua',
            'fopa_data',
            'fopa_text',
            [
            
            'attribute' => 'fopa_arquivo',
            //'label' => 'fopa_arquivo',
            'format'=> 'raw',
            'value'  => function($model){return "<a href='".Yii::getAlias('@web').$model['fopa_arquivo']."'>Baixar</a>";}
            ],

            [
                'attribute' => 'fopa_stat',
                'format'=> 'raw',
                'value' => ['app\models\PagamentoUtil', 'getStatusValue'],
                /*'value' => function ($data) {
                    if($data->fopa_stat == '1')
                    {
                        return 'Aprovado';
                    }
                    else
                    {
                        return 'Reprovado';
                    }
                }*/
            ],            

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>


