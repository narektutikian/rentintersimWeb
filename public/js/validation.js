$( document ).ready(function() {
    // console.log("validation!");

    var validator;
    // var thisForm;
    $('.vd_form').each(function() {   // <- selects every <form> on page
        $(this).validate({
            rules: {
                password_confirmation: {
                    equalTo: "#set_password"
                }
            }
        });
        validator = $(this).validate();
    });

    var thisForm = $('.vd_form').validate();

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
    $('.vd_form .vd_non_empty').each(function() {
        $(this).rules('add', {
            required: true
        });
    });
    $('.vd_form .vd_time_required').each(function() {
        $(this).rules('add', {
            required: true,
            minlength: 2,
            messages: {
                required: "Time required",
            }
        });
    });
    $('.vd_form .vd_date_required').each(function() {
        $(this).rules('add', {
            required: true,
            minlength: 2,
            messages: {
                required: "Date required",
            }
        });
    });

    /* Reset form fields after modal has been closed */
    $(document).on('click', '.vd_form_reset', function () {

        console.log('vd_form_reset ');
        thisForm.resetForm();
    });
    $(document).on('hide.bs.modal', '.modal', function () {

        console.log('hide modal ');
        console.log('validator ', validator);

        thisForm.resetForm();
    });




});