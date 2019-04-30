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
            //'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]);
        $guest = [
            ['label' => /*Icon::show('home') .*/ 'Login', 'url' => ['site/login/']],
            Yii::$app->user->isGuest ? (['label' => '', 'url' => ['/site']]) : ('<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Sair (' . Yii::$app->user->identity->usua_nome . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>')
        ];
        $id = isset(Yii::$app->user->identity->usua_codi) ? Yii::$app->user->identity->usua_codi : null;
        $useruser = [
            ['label' => 'Perfil', 'url' => ['/usuario/view?id=' . $id]],
            ['label' =>  'Folha de Ponto', 'url' => ['/folhapagamentousuario/']],

            Yii::$app->user->isGuest ? (['label' => 'Login', 'url' => ['/site/losgin']]) : ('<li>'

                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Sair (' . Yii::$app->user->identity->usua_nome . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'),
        ];
        $admin = [
            ['label' => 'Perfil', 'url' => ['/usuario/view?id=' . $id]],
            ['label' => /*Icon::show('home') .*/ 'Usuarios', 'url' => ['/usuario/']],
            ['label' => /*Icon::show('home') .*/ 'Folha de Ponto', 'url' => ['/folhapagamento/']],
            Yii::$app->user->isGuest ? (['label' => 'Login', 'url' => ['/site/losgin']]) : ('<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Sair (' . Yii::$app->user->identity->usua_nome . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>')
        ];
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => Yii::$app->user->isGuest  ? $guest : (Yii::$app->user->identity->usua_nivel == 99 ? $useruser : $admin) /* [

                deslogadoo kkkk

                ['label' => 'Usuarios', 'url' => ['/usuario/']],
                ['label' => 'Folha de Ponto', 'url' => ['/folhapagamento/']],
                ['label' => 'Relatórios', 'url' => ['/relatorios/']],
                Yii::$app->user->isGuest ? (['label' => 'Login', 'url' => ['/site/login']]) : ('<li>'
                    . Html::beginForm(['/site/logout'], 'post')
                    . Html::submitButton(
                        'Sair (' . Yii::$app->user->identity->usua_nome . ')',
                        ['class' => 'btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>')
            ],*/
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