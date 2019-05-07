<?php
use app\models\FolhaPagamento;
use app\assets\AppAsset;

$this->registerJsFile("@web/js/index.js", [
    'depends' => AppAsset::className(),
]);
?>

<div class="modal fade" id="modalReprovar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Confirma reprovar folha ?</h4>
            </div>
            <div class="modal-body">
                <div class="msg_ajax"></div>
                <form id="_reprovacao" method="POST" action="">
                    <div class="form-group">
                        <label for="message-text" class="control-label">Motivo:</label>
                        <textarea class="form-control" name="motivo" rows="6" id="message-text" placeholder="Informe o motivo"></textarea>
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-default fechar" data-dismiss="modal">Fechar</button>
                        <button type="submit" name="enviar" class="btn btn-primary">Enviar</button>
                    </div>
                    <input name="usua_mail" val="" id="usua_mail" type="hidden" />
                    <input name="id" val="" id="fopa_codi" type="hidden" />
                    

                </form>
            </div>

        </div>
    </div>
</div>