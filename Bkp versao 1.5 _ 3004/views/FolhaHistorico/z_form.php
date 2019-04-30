<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FolhaHistorico */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="folha-historico-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fohi_data')->textInput() ?>

    <?= $form->field($model, 'fohi_text')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fohi_arq')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fopa_fopa')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <?= Html::activeHiddenInput($model, 'myAttribute') ?>


    <?= Html::button(

        'myAttribute...',

        [
            'value' => $model->isNewRecord

                ? Url::to(['mySecond/create'])  //Put here the url to the Create page

                : Url::to(['mySecond/update', 'id' => $model->myAttribute]), //and here to the update Page with the id attribute

            'id' => 'changeMyAttribute',

            'for' => '#myModel1-myAttribute' //Put here the id of the field you want to update 

        ]
    )

    ?>


    ....




    <?php

    Modal::begin(['id' => 'myModal']);



    echo "<div id='myModalContent'></div>";



    Modal::end();

    ?>


</div>