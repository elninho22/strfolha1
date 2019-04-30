

    <?php $form = ActiveForm::begin([

        'id' => $model->formName()

    ]); ?>

    

    

    <?php

    //beforeSubmit

    $js = "

        $('form#" . $model->formName() . "').on('beforeSubmit', function(e){

            var \$form = $(this);

            submitMySecondForm(\$form);

        }).on('submit', function(e){

            e.preventDefault();

        });";

    $this->registerJs($js);

    ?>
