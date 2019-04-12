<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\FolhaHistorico */

$this->title = $model->fohi_codi;
$this->params['breadcrumbs'][] = ['label' => 'Folha Historicos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="folha-historico-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'fohi_codi' => $model->fohi_codi, 'fopa_fopa' => $model->fopa_fopa], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'fohi_codi' => $model->fohi_codi, 'fopa_fopa' => $model->fopa_fopa], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'fohi_codi',
            'fohi_data',
            'fohi_text',
            'fohi_arq',
            'fopa_fopa',
        ],
    ]) ?>

</div>
