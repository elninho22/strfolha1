<?php

use yii\helpers\Html;
use app\assets\AppAsset;

$this->registerJsFile("@web/js/index.js", [
    'depends' => AppAsset::className(),
]);

$this->title = 'Nova Folha';
$this->params['breadcrumbs'][] = ['label' => 'Inicio', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="folha-pagamento-usuario-create">


    <h1><?= Html::encode($this->title) ?></h1>
    <?php
    if (Yii::$app->session->hasFlash('arqvazio')) {
        echo '<div class="alert alert-danger" role="alert">
            ' . Yii::$app->session->getFlash('arqvazio') . '
          </div>';
    } elseif (Yii::$app->session->hasFlash('arqvazio')) {
        echo '<div class="alert alert-danger" role="alert">' . Yii::$app->session->getFlash('arqvazio') . '
          </div>';
    }
    ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>