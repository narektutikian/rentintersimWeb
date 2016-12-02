/**
 * Created by narek on 12/2/16.
 */

$( document ).ready(function() {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $('#submit').on('click', function (e) {
        e.preventDefault();
        var name = $('#name').val();
        var type_code = $('#type_code').val();
        var provider_id = $('#provider_id').val();
        var description = $('#description').val();
        $.ajax({
            type: "POST",
            url: '/type',
            data: {_token: CSRF_TOKEN, name: name, type_code: type_code, provider_id: provider_id, description: description},
            success: function( msg ) {
            $("#ajaxResponse").append("<div>"+"DONE"+"</div>");
                },
            error: function (error) {
                $("#ajaxResponse").append("<div>"+"ERROR"+"</div>");
            }
        });
    });

/****** Order Creation ******/
    $('#create-order').on('click', function (e) {
        e.preventDefault();
        var data = {
            _token : CSRF_TOKEN,
            sim: $('#sim').val(),
            landing: Date.parse($('#landing').val())/1000,
            departure: Date.parse($('#departure').val())/1000,
            package_id: $('#package_id').val(),
            reference_number: $('#reference_number').val(),
            remark: $('#remark').val(),
                    };

        $.ajax({
            type: "POST",
            url: '/order',
            data: data,
            success: function( msg ) {
                $("#order-create-div").append("<div>"+"DONE"+"</div>");
            },
            error: function (error) {
                $("#order-create-div").append("<div>"+"ERROR"+"</div>");
            }
        });
    });

}); // closes document ready


