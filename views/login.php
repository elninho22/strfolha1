<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */
/* @var $form ActiveForm */
?>
<div class="login">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'usua_dins') ?>
        <?= $form->field($model, 'usua_nivel') ?>
        <?= $form->field($model, 'usua_nome') ?>
        <?= $form->field($model, 'usua_pass') ?>
        <?= $form->field($model, 'usua_mail') ?>
        <?= $form->field($model, 'usua_hash') ?>
        <?= $form->field($model, 'usua_logi') ?>
        <?= $form->field($model, 'usua_foto') ?>
    
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
    <?php ActiveForm::end(); ?>

</div><!-- login -->
