$('#modalReprovar').on('show.bs.modal', function (event) {
    var modal = $(this);
    console.log($(this).attr('id'));
});




$(document).ready(function () {
    var formData;
    $('form#_reprovacao').submit(function (event) {
        event.preventDefault();
        formData = new FormData($(this)[0]);
        $.ajax({
            url: "/strfolha/web/folhapagamento/email",
            dataType: "json",
            type: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (responseText) {
                console.log(responseText);
                /*  if (responseText.acao_java == 'create') {
                    $('.aviso').html(responseText.msg).fadeIn('slow');
                    window.setTimeout(function () {
                        $('.aviso').empty().fadeOut(1000);
                        $('input[type=text],textarea').val("");
                        $('form[name="cadForm"]').find(".has-success").removeClass('has-success');
                    }, 3000);
                } else if (responseText.acao_java == 'update') {
                    $('.aviso').html(responseText.msg).fadeIn('slow');
                    window.setTimeout(function () {
                        $('.aviso').empty().fadeOut(1000);
                        $('form[name="cadForm"]').find(".has-success").removeClass('has-success');
                        // $(location).href(responseText.urlRedirect);
                        window.location.href = responseText.urlRedirect;
                    }, 3000);
                }  */
            },
            beforeSend: function () { console.log("enviadno..."); },
            complete: function () { },
            error: function (e) { console.log(e); }
        });
        return false;
    });
}); //fim do documento




