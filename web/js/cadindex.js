$(document).ready(function () {
    $(".caduser").on('click', function () {
        //alert('ok');
        //log.console($('caduser'));
        var nome = $(this).attr('usua_nome');
        var usua_codi = $(this).attr('id');

        $('#modalCad').modal("show");
        

       $('input[name="usua_nome"]').val(nome);
       //$('input[name="id"]').val(usua_codi);

    });

    var formData;
    $('form#_cad').submit(function (event) {
        event.preventDefault();
        
        formData = new FormData($(this)[0]);
        $.ajax({
            url: "/strfolha/web/usuario/cad-usuario",
            dataType: "json",
            type: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (responseText) {
                console.log(responseText);
                $('.msg_ajax').html(' ');
                if (responseText.success) {
                    $('.msg_ajax').html('<div class="alert alert-success">' + responseText.mensagem + '</div>').fadeIn('slow');
                    $('textarea[name="motivo"]').val();
                    //$('#modalReprovar').modal("hide");

                } else {
                    $('.msg_ajax').html('<div class="alert alert-warning">' + responseText.mensagem + '</div>').fadeIn('slow');
                }

            },
            beforeSend: function () {
                $('.msg_ajax').html(' ');
                $('.msg_ajax').html('<div class="alert alert-info"><b>Aguarde</b>, processando sua solicitaçao...</div>').fadeIn('slow');
            },
            complete: function () { },
            error: function (e) { console.log(e); }
        });

        setTimeout(function () {
            window.location.reload(1);
        }, 90000);

        return false;

        // location.reload();
    });
}); //fim do documento




