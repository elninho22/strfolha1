<?php

/* @var $this yii\web\View */
use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\widgets\ActiveForm;

$this->title = 'SigFolha - Studiorama';
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
      <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">
        Cadastre-se</button>
    </div>
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

              <center> <b>Em manutenção :´( </center>

            </p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
          </div>
        </div>

      </div>
    </div><!-- FIM Modal -->
  </div>
</div>