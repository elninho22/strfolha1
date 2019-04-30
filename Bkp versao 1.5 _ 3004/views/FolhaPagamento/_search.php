<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FolhaPagamentoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="folha-pagamento-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'fopa_codi') ?>

    <?= $form->field($model, 'fopa_arquivo') ?>

    <?= $form->field($model, 'fopa_data') ?>

    <?= $form->field($model, 'fopa_text') ?>

    <?= $form->field($model, 'fopa_usua') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
