<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

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
        <?= Html::a('Deletar', ['delete', 'id' => $model->usua_codi], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => "Desejar deletar {$model->usua_nome} ?",
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'usua_codi',
            'usua_nome',
            'usua_dins',
            'usua_pass',
            'usua_mail',
            'usua_hash',
            'usua_nivel',
            'usua_foto',
            'usua_logi',
        ],
    ]) ?>

</div>
