<?php

/* @var $this yii\web\View */
use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\widgets\ActiveForm;

$this->title = 'SigFolha - Studiorama ';
?>
<div class="site-index">

    <div class="well">
        <h1>Olá, bem vindo! 



        </h1>
	</div>


<div class="row">
  <div class="col-xs-9 col-md-2"><h4>Acesse sua conta</h4></div>
  <div class="col-xs-3 col-md-3"><h4>1º acesso ? Faça seu cadastro!</h4></div>
</div>

<div class="row">
  <div class="col-xs-6 col-md-2"><a class="btn btn-lg btn-success" href="site/login">Entrar</a></div>
  <div class="col-xs-6 col-md-4"><!-- Trigger the modal with a button -->
<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">
 Cadastrar</button>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Cadastro de usuário</h4>
      </div>
      <div class="modal-body">
        <p>



      </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
      </div>
    </div>

  </div>
</div><!-- FIM Modal --></div>
</div>

