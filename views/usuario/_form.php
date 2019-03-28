<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuario-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'usua_nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'usua_dins')->textInput() ?>

    <?= $form->field($model, 'usua_pass')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'usua_mail')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'usua_hash')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'usua_nivel')->textInput() ?>

    <?= $form->field($model, 'usua_foto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'usua_logi')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
