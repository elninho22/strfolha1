<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FolhaPagamento */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="folha-pagamento-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'fopa_arquivo')->fileInput()?> 
    
    <?= $form->field($model, 'fopa_data')->textInput() ?>

    <?= $form->field($model, 'fopa_text')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fopa_usua')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
