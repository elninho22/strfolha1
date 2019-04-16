<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;


$this->title = 'Ops...';
?>
<div class="site-error">


    <h1>:'(</h1>

    <div class="alert alert-danger">
       <b> <?= nl2br(Html::encode($message)) ?>
    </div>


    <p>
        <div style="color:#999;">
            Version: 1.0.4.7
        </div>
    </p>

</div>