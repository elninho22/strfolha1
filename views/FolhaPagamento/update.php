<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FolhaPagamento */

$this->title = 'Update Folha Pagamento: ' . $model->fopa_codi;
$this->params['breadcrumbs'][] = ['label' => 'Folha Pagamentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->fopa_codi, 'url' => ['view', 'fopa_codi' => $model->fopa_codi, 'fopa_usua' => $model->fopa_usua]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="folha-pagamento-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
