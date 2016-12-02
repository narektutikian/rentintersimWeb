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




    /*
     $(document).ready(function() {
     $('#submit').on('submit', function (e) {
     e.preventDefault();
     var name = $('#name').val();
     var type_code = $('#type_code').val();
     var provider_id = $('#provider_id').val();
     var description = $('#description').val();
     $.ajax({
     type: "POST",
     url: <?php// echo url('type')?>,
     data: {name: name, type_code: type_code, provider_id: provider_id, description: description},
     success: function( msg ) {
     $("#ajaxResponse").append("<div>"+msg+"</div>");
     }
     });
     });
     });
     */




});


