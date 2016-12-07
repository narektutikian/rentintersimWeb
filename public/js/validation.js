$( document ).ready(function() {
    console.log("validation!");

    var validator
    $('.vd_form').each(function() {   // <- selects every <form> on page
        $(this).validate({
            rules: {
                password: "required",
                password_confirmation: {
                    equalTo: "#set_password"
                }
            }
        });
        validator = $(this).validate();
    });

    $('.vd_form .vd_required').each(function() {
        $(this).rules('add', {
            required: true,
            minlength: 2
        });
    });
    $('.vd_form .vd_select').each(function() {
        $(this).rules('add', {
            required: true
        });
    });
    $('.vd_form .vd_email').each(function() {
        $(this).rules('add', {
            email: true
        });
    });
    $('.vd_form .vd_number').each(function() {
        $(this).rules('add', {
            required: true,
            number: true,
            minlength: 2
        });
    });

    $('.vd_form_submit').click(function(e) {

        e.preventDefault();
        $(this).closest(".vd_form").valid();
    });


    /* Reset form fields after modal has been closed */
    $(document).on('click', '.vd_form_reset', function () {

        validator.resetForm();
    });
    $(document).on('hide.bs.modal', '.modal', function () {

        validator.resetForm();
    });




});