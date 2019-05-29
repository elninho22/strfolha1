<?php

/* @var $this yii\web\View */
use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use app\assets\AppAsset;
use app\models\Usuario;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use app\models\FolhaPagamento;

//phpinfo();

$this->title = 'Folha de Ponto - Colaborativa';

$this->registerJsFile("@web/js/cadindex.js", [
  'depends' => AppAsset::className(),



  //$usua_codi = $model->usua_codi;


]);
?>


<div class="site-index">

  <div class="well" align=" center">
    <h1>Olá, bem vindo!
    </h1>
  </div>

  <div class="row" align="center">
    <h4>Acesse sua conta</h4>
    <div class="col-xs-2 col-md-12"><a class="btn btn-lg btn-success" href="site/login">Entrar</a></div>

    <br><br><br><br>

    <h4 align="center">1º acesso ? Faça seu cadastro!</h4>
    <div class="col-xs-2 col-md-12" align="center">
      <!-- Trigger the modal with a button -->
      <button type="button" class="btn btn-lg btn-info caduser" data-toggle="modal" data-usuario="modalCadx" title="Cadastro Usuário">
        Cadastre-se</button>


    </div>

  </div>
</div>
<?= $this->render('_modals') ?>