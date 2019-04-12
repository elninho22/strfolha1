<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FolhaHistoricoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="folha-historico-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'fohi_codi') ?>

    <?= $form->field($model, 'fohi_data') ?>

    <?= $form->field($model, 'fohi_text') ?>

    <?= $form->field($model, 'fohi_arq') ?>

    <?= $form->field($model, 'fopa_fopa') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
