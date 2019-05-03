<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Usuario;

?>

<div class="usuario-form" align="center">
    <div class="form-group">
        <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'usua_nome')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'usua_mail')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'usua_pass')->passwordInput()
            ->hint('Senha deve ter no mínimo 6 digitos')
            ->label('Senha') ?>
        <?= $form->field($model, 'usua_nome')->dropDownlist(ArrayHelper::map(Usuario::find()->all(), 'id', 'usua_nome'))->label('Gestor') ?>
        <?= $form->field($model, 'usua_foto')->FileInput() ?>

        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>