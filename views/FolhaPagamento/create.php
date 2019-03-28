<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FolhaPagamento */

$this->title = 'Criar Folha de Presença';
$this->params['breadcrumbs'][] = ['label' => 'Inicio', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="folha-pagamento-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
