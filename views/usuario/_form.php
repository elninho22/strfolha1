<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Usuario;
use app\assets\AppAsset;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ussuario-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'usua_nome')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'usua_mail')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'usua_pass')->passwordInput()
        ->hint('Senha deve ter no mínimo 6 digitos')
        ->label('Senha') ?>
    <?php echo ''
    ?>

    <?php
    ?>
    <?= $form->field($model, 'usua_guest')->dropDownlist(ArrayHelper::map(Usuario::find()->where(['usua_nivel' => '98'])->all(), 'usua_codi', 'usua_nome'), ['prompt' => 'Selecione seu Gestor'])
        ->label('Gestor') ?>
    <?php echo ''
    ?>

    <?php echo ''
    ?>
    <?php echo ''
    ?>
    <?php echo ''
    ?>

    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

