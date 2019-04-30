<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FolhaHistorico */

$this->title = 'Update Folha Historico: ' . $model->fohi_codi;
$this->params['breadcrumbs'][] = ['label' => 'Folha Historicos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->fohi_codi, 'url' => ['view', 'fohi_codi' => $model->fohi_codi, 'fopa_fopa' => $model->fopa_fopa]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="folha-historico-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
