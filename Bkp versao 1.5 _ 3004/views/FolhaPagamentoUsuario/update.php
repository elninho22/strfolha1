<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FolhapagamentoUsuario */

$this->title = 'Editar folha: ' . $model->fopa_data;
$this->params['breadcrumbs'][] = ['label' => 'Folha Pagamentos', 'url' => ['index']];

$this->params['breadcrumbs'][] = 'Update';
?>
<div class="folha-pagamento-usuario-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
