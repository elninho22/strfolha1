<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FolhaHistorico */

$this->title = 'Create Folha Historico';
$this->params['breadcrumbs'][] = ['label' => 'Folha Historicos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="folha-historico-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
