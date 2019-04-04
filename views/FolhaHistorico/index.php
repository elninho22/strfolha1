<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FolhaHistoricoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Folhas Studiorama';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="folha-historico-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'fohi_codi',
            'fohi_data',
            'fohi_text',
            'fohi_arq',
            'fopa_fopa',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
