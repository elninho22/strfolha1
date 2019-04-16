<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\FolhaPagamento */

$this->title = $model->fopa_usua;
$this->params['breadcrumbs'][] = ['label' => 'Gerencial', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);


//var_dump($url);
//die('4');
?>
<div class="folha-pagamento-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Editar', ['update', 'fopa_codi' => $model->fopa_codi, 'fopa_usua' => $model->fopa_usua], ['class' => 'btn btn-warning']) ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'fopa_codi',
            'fopa_usua',
            'fopa_data', // mes de referencia na TABELA
            [
                'attribute' => 'fopa_arquivo',
                //'label' => 'fopa_arquivo',
                'format' => 'raw',
                'value'  => function ($model) {
                    return "<a href='" . Yii::getAlias('@web') . $model['fopa_arquivo'] . "'>Baixar</a>";
                }
            ],
            //'fopa_arquivo',
            'fopa_text',
            [
                'fopa_dins',
                'attribute' => 'fopa_dins',
                'label' => 'Data de Envio',
            ],
        ],
    ]) ?>

</div>