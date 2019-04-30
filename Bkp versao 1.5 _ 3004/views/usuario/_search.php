<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UsuarioSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuario-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'usua_codi') ?>

    <?= $form->field($model, 'usua_nome') ?>

    <?php // echo $form->field($model, 'usua_dins') ?>

    <?= $form->field($model, 'usua_pass') ?>

    <?= $form->field($model, 'usua_mail') ?>

    <?php // echo $form->field($model, 'usua_hash') ?>

    <?php // echo $form->field($model, 'usua_nivel') ?>

    <?php // echo $form->field($model, 'usua_foto') ?>

    <?php // echo $form->field($model, 'usua_logi') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
