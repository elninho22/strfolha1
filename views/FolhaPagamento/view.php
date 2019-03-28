<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\FolhaPagamento */

$this->title = $model->fopa_codi;
$this->params['breadcrumbs'][] = ['label' => 'Inicio', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="folha-pagamento-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'fopa_codi' => $model->fopa_codi, 'fopa_usua' => $model->fopa_usua], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'fopa_codi' => $model->fopa_codi, 'fopa_usua' => $model->fopa_usua], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Confirma a exclusão ?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'fopa_codi',
            'fopa_arquivo',
            'fopa_data',
            'fopa_text',
            'fopa_usua',
        ],
    ]) ?>

</div>
