<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\GestorUsuario;
use yii\helpers\ArrayHelper;
use app\models\Usuario;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */

$this->title = $model->usua_nome;

$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="usuario-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Editar', ['update', 'id' => $model->usua_codi], ['class' => 'btn btn-primary']) ?>
        <?php echo '' /* Html::a('Deletar', ['delete', 'id' => $model->usua_codi], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => "Deseja excluir usuário: {$model->usua_nome} ?",
                'method' => 'post',
            ],
        ])*/ ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'usua_codi',
            'usua_nome',
            'usua_mail',
            [
                'attribute' => 'usua_guest', // => $gestor = new GestorUsuario(),
                'value' => function ($model) {
                    return Usuario::nomeGestor($model['usua_guest'])->usua_nome;
                }
            ],
            'usua_insc',
        ],
    ]) ?>

</div>