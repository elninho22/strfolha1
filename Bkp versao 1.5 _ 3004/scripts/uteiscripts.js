$("#changeMyAttribute").click(function () {

    $("#myModal").modal('show')

        .find("#myModalContent")

        .load($(this).attr('value'));

});


function submitMySecondForm($form) {

    $.post(

        $form.attr("action"),

        $form.serialize()

    )

        .done(function (result) {

            $form.parent().html(result.message);

            $($("#changeMyAttribute").attr('for')).attr('value', result.id); //actualize the ID on the input hidden

            $("#changeMyAttribute").attr('value', '/index.php?r=mySecond%2Fupdate&id=' + result.id); //change here to the url of update view.

            $('#myModal').modal('hide');

        })

        .fail(function () {

            console.log("server error");

            $form.replaceWith('<button>Fail</button>').fadeOut()

        });

    return false;

}