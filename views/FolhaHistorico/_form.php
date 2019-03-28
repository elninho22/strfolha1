<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FolhaHistorico */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="folha-historico-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fohi_data')->textInput() ?>

    <?= $form->field($model, 'fohi_text')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fohi_arq')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fopa_fopa')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
