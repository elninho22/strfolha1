<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usuários';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuario-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php //  echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Novo Usuário', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'usua_codi',
            'usua_nome',
            'usua_dins',
            'usua_pass',
            'usua_mail',
            //'usua_hash',
            //'usua_nivel',
            //'usua_foto',
            //'usua_logi',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
