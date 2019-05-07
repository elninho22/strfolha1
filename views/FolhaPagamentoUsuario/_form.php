<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Usuario;
use app\assets\AppAsset;

$this->registerJsFile("@web/js/index.js", [
    'depends' => AppAsset::className(),
]);
?>

<div class="folha-pagamento-usuario-form">
    <div class="msg_ajax"></div>

    <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'arquivo')->fileInput()?>
            <p style="color:red;font-size:11px;font-family:verdana;"><strong>arquivos válido (.pdf, .jpg, .jpeg, .png)</strong><p>
            <?= $form->field($model, 'fopa_data')->dropDownlist(['Janeiro' => 'Janeiro', 'Fevereiro' => 'Fevereiro', 'Março' => 'Março', 'Abril' => 'Abril', 'Maio' => 'Maio', 'Junho' => 'Junho', 'Julho' => 'Julho', 'Agosto' => 'Agosto', 'Setembro' => 'Setembro', 'Outubro' => 'Outubro', 'Novembro' => 'Novembro', 'Dezembro' => 'Dezembro'], ['prompt' => 'Selecione Mês Referencia']) ?>
            <?= $form->field($model, 'fopa_guest')->dropDownlist(ArrayHelper::map(Usuario::find()->where(['usua_ngest' => '98'])->all(), 'usua_codi', 'usua_nome'), ['prompt' => 'Selecione seu Gestor'])
            ->label('Gestor') ?>
            <?= $form->field($model, 'fopa_text')->textInput() ?>

    <div class="form-group">
            <?= Html::submitButton('Enviar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>