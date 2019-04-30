$(document).ready(function () {
    $(".reprovar-user").on('click', function () {
        var mail = $(this).attr('data-usuario');
        var fopacodi = $(this).attr('id');

        $('#modalReprovar').modal("show");

        $('input[name="usua_mail"]').val(mail);
        $('input[name="id"]').val(fopacodi);

    });

    var formData;
    $('form#_reprovacao').submit(function (event) {
        event.preventDefault();
        formData = new FormData($(this)[0]);
        $.ajax({
            url: "/strfolha/web/folhapagamento/reprovar-folha",
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
        }, 10000);
        
        return false;
        
       // location.reload();
    });
}); //fim do documento



