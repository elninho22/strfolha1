<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Usuario;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuario-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'usua_nome')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'usua_mail')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'usua_pass')->passwordInput()
        ->hint('Senha deve ter no mínimo 6 digitos')
        ->label('Senha') ?>


    <?php 
    ?>
    <?= $form->field($model, 'usua_nome')->dropDownlist(ArrayHelper::map(Usuario::find()->all(), 'id', 'usua_nome'))->label('Gestor') ?>

    <?= $form->field($model, 'usua_foto')->FileInput() ?>

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


