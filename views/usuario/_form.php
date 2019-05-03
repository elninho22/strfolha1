<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Usuario;
use app\assets\AppAsset;
use yii\bootstrap\Modal;

?>

<div class="ussuario-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'usua_nome')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'usua_insc')->textInput(['maxlength' => 9]) ?>
    <?= $form->field($model, 'usua_mail')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'usua_pass')->passwordInput()
        ->hint('Senha deve ter no mínimo 6 digitos')
        ->label('Senha') ?>
    <?php
    ?>
    <?= $form->field($model, 'usua_guest')->dropDownlist(ArrayHelper::map(Usuario::find()->where(['usua_ngest' => '98'])->all(), 'usua_codi', 'usua_nome'), ['prompt' => 'Selecione seu Gestor'])
        ->label('Gestor') ?>
    <?php echo ''
    ?>

    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>