<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FolhaPagamento */

$this->title = 'Editar Folha de Ponto: ' . $model->fopa_text;
$this->params['breadcrumbs'][] = ['label' => 'Folha Pagamentos', 'url' => ['index']];

$this->params['breadcrumbs'][] = 'Update';
?>
<div class="folha-pagamento-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
