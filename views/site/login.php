<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\LoginForm;

?>
<div class="login">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'usua_mail') ?>
        <?= $form->field($model, 'usua_pass')->passwordInput()
                    ->label('Senha') ?>

        <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>    
            
    <?php ActiveForm::end(); ?>

</div><!-- login -->


