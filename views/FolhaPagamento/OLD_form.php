<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Usuario;

/* @var $this yii\web\View */
/* @var $model app\models\FolhaPagamento */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="folha-pagamento-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fopa_arquivo')->fileInput() ?>

    <?= $form->field($model, 'fopa_data')->dropDownlist(['Janeiro' => 'Janeiro', 'Fevereiro' => 'Fevereiro', 'Março' => 'Março', 'Abril' => 'Abril', 'Maio' => 'Maio', 'Junho' => 'Junho', 'Julho' => 'Julho', 'Agosto' => 'Agosto', 'Setembro' => 'Setembro', 'Outubro' => 'Outubro', 'Novembro' => 'Novembro', 'Dezembro' => 'Dezembro'], ['prompt' => 'Selecione Mês Referencia']) ?>
    <?= $form->field($model, 'fopa_text')->textInput() ?>

    <?= $form->field($model, 'fopa_guest')->dropDownlist(ArrayHelper::map(Usuario::find()->where(['usua_nivel' => '98'])->all(), 'usua_codi', 'usua_nome'), ['prompt' => 'Selecione seu Gestor'])
        ->label('Gestor') ?>

    


    <div class="form-group">
        <?= Html::submitButton('Enviar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>