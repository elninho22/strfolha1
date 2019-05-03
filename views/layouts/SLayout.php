<?php

/* @var $this \yii\web\View */
/* @var $content string */

use Yii\app;
use app\models\Usuario;
use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\bootstrap\Modal;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use phpDocumentor\Reflection\Types\Null_;

//use kartik\icons\Icon;


AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>
    <?php $this->beginBody() ?>

    <div class="wrap">
        <?php
        // $model = null;
        // $model = new Usuario($model->usua_codi);
        NavBar::begin([
            'brandLabel' => Yii::$app->name,
            //'brandUrl' => Yii::$app->homeUrl('site/login'),
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]);
        
        
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],

        ]);
        NavBar::end();
        ?>

        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </div>
    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>