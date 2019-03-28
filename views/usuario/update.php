<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */

$this->title = 'Atualizar usuário: ' . $model->usua_nome;
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->usua_codi, 'url' => ['view', 'id' => $model->usua_codi]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="usuario-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
