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
    var package_id;
    $('#create-order').on('click', function (e) {

        if($(this).closest('.vd_form').find('.error')){

            console.log('has error');
        }else{

            var data = {
                _token : CSRF_TOKEN,
                sim: $('#sim').val(),

                landing: moment($('#landing_date').val(), "DD/MM/YYYY HH:mm").valueOf()/1000,
                departure: moment($('#departure_date').val(), "DD/MM/YYYY HH:mm").valueOf()/1000,
                package_id: package_id, // put package id
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
        }

    });

    $.get("/type-provider/1", function(data, status){
        if (status == "success"){
            $.each(data, function(i, item) {
                console.log(item.name + "\n");

                $("#wrap_package_list").append("<div class='package_item'>" +
                    "<a href='#' data-id='" + item.id + "' title='Basic Package'>" +
                        "<h4>"+ item.name +"</h4>" +
                        "<span>" + item.description + "</span>" +
                    "</a>" +
                "</div>");

                /*
                     <div id="wrap_package_list">
                         <div class="package_item">
                             <a href="#" title="Basic Package">
                                 <h4>Basic Package</h4>
                                 <span>8 Mb Data</span>
                                 <span>Unlimited local</span>
                                 <span>Call + SMS</span>
                             </a>
                        </div>
                     </div>
                 */

            });

            $(document).on('click', '.package_item > a', function () {

                package_id = $(this).attr('data-id');
                console.log('package_id ', package_id);
                return false;
            });
        }
    });

    /***** ADD NEW SIM *****/

    $('#add-sim').on('click', function (e) {
        e.preventDefault();
        // console.log('clicked');
        var fileVal = $('#sim-file').val();
        if (fileVal == '') {

            var data = {
                _token : CSRF_TOKEN,
                number: $('#sim-number').val(),
                provider_id: $('#provider-id').val(),
                is_parking: $('#is-parking').val()
            };

               $.ajax({
             type: "POST",
             url: '/sim',
             data: data,
             success: function (msg) {
             $("#response-add-sim").append("<div>" + "DONE" + "</div>");
             },
             error: function (error) {
             $("#response-add-sim").append("<div>" + "ERROR" + "</div>");
             }
             });

        }
        else {
                // alert($('#sim-file').val());

                e.stopPropagation(); // Stop stuff happening

               //  var files = new FormData($("#sim-file")[0]);
               //  console.log(files.name);
               //  var data = new FormData();
               // /* $.each(files, function(key, value)
               //  {
               //      data.append(key, value);
               //
               //  });*/
               //      data.append('_token', CSRF_TOKEN);
            $.ajax({
                url: 'import-sim',
                type: 'POST',
                data: new FormData($("#insert-sim")[0]),
                cache: false,
                dataType: 'json',
                processData: false, // Don't process the files
                contentType: false, // Set content type to false as jQuery will tell the server its a query string request
                success: function(data, textStatus, jqXHR)
                {
                    if(typeof data.error === 'undefined')
                    {
                        // Success so call function to process the form
                        // submitForm(event, data);
                    }
                    else
                    {
                        // Handle errors here
                        console.log('ERRORS: ' + data.error);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                    // Handle errors here
                    console.log('ERRORS: ' + textStatus);
                    // STOP LOADING SPINNER
                }
            });


            }
    });

}); // closes document ready


