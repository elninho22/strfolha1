<?php

use yii\helpers\Html;
use app\assets\AppAsset;

$this->registerJsFile("@web/js/index.js", [
    'depends' => AppAsset::className(),
]);

$this->title = 'Editar folha: ' . $model->fopa_data;
$this->params['breadcrumbs'][] = ['label' => 'Folha Pagamentos', 'url' => ['index']];

$this->params['breadcrumbs'][] = 'Update';
?>
<div class="folha-pagamento-usuario-update">

    <h1><?= Html::encode($this->title) ?></h1>
    ]<?php
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