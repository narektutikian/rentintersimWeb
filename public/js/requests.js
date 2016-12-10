/**
 * Created by narek on 12/2/16.
 */

$( document ).ready(function() {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $('.close').click(function() {
        location.reload();
    });

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

        if(!$(this).closest('.vd_form').find('.error')){

            console.log('has error');

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
                //console.log(item.name + "\n");

                $(".wrap_package_list").append("<div class='package_item'>" +
                    "<a href='#' data-id='" + item.id + "' title='Basic Package'>" +
                        "<h4>"+ item.name +"</h4>" +
                        "<span>" + item.description + "</span>" +
                    "</a>" +
                "</div>");

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

    /******  Edit sim ********/

    $('#edit-sim').on('click', function (e) {

        var this_id = $(this).attr('id');
            var data = {
                _token : CSRF_TOKEN,
                number: $('#number').val(),
                provider_id: $('#provider_id').val(),
                is_parking: $('#is_parking').val()
            };
            var id = $('#id').val();

            $.ajax({
                type: "PUT",
                url: '/sim/'+id,
                data: data,
                success: function( msg ) {
                    $(".error_response").empty();
                    $(".success_response").empty();
                    $(".success_response").append("DONE "+msg);
                },
                error: function (error) {


                    $(".error_response").empty();
                    $(".success_response").empty();
                    $(".error_response").append("ERROR");
                    // $("#sim-edit-response").append("<div>"+"ERROR "+ error.responseJSON.number[0]+ " ," +error.responseJSON.provider_id[0] +"</div>");
                    console.log(error.responseJSON.number[0]);
                }
            });
        // }

    });

    /* User Management Nested Table */
    $.ajax({
        url: 'http://localhost:8000/user-tree',
        //dataType: 'jsonp',
        success: function(json) {

            console.log(json);

            var string = '';
            function recursiveIteration(json) {

                string +=
                    '<table class="responsive_table table user_management_table" data-toggle="table" id="tree_table">' +
                        '<thead>' +
                        '</thead>' +
                    '<tbody>';

                for(var prop in json){
                    var icon = '<a href="#" class="open_nested" data-toggle="collapse" data-target="#demo' + (json[prop]["id"] || "0") + '"><i class="icon-dropdown"></i></a>';
                    icon = (json[prop]["child"])? icon : '';

                    string += '<tr>' +
                            '<td>' +
                                  icon +
                            '</td>' +
                            '<td>' + json[prop]["name"] + '</td><td>' + json[prop]["name"] + '</td><td>' + json[prop]["level"] + '</td><td>15</td>' +
                            '<td>24</td><td>0</td><td>' +
                            '<span class="table_icon"><i class="icon-edit"></i></span>' +
                            '</td>' +
                            '<td>' +
                            '<div class="vdf_radio">' +
                                '<div class="toggle_container">' +
                                    '<label class="label_unchecked">' +
                                        '<input type="radio" name="toggle" value="1"><span></span>' +
                                    '</label>' +
                                    '<label class="label_checked">' +
                                        '<input type="radio" name="toggle" value="0"><span></span>' +
                                        '</label>' +
                                    '</div>' +
                                '</div>' +
                            '</div>' +

                            // '<div class="vdf_radio">' +
                            // '<div class="toggle_container disabled">' +
                            // '<label><input type="radio" name="toggle" value="1"><span></span></label>' +
                            // '<label><input type="radio" name="toggle" value="0"><span class="input-checked"></span></label>' +
                            // '</div>' +
                            // '</div>' +
                            '<span class="status_text_small not_used">Not in use</span>' +
                            '</td>' +
                        '</tr>';

                    if(json[prop]["child"]) {
                        string += '<tr class="nested_row">' +
                            '<td></td><td colspan="8" class="nested_cell">' +
                            '<div class="collapse nested_div" id="demo' + (json[prop]["id"] || "0") + '">';
                                recursiveIteration(json[prop]["child"]);
                        string += '</div></td></tr>';
                    }

                }

                string += '</tbody></table>';

            }

           recursiveIteration(json);

            $('#wrap_tree_table').prepend(
                string
            );

        }
    }).fail(function (jqXHR, textStatus, errorThrown) {

        console.log(jqXHR);
        console.log(textStatus);
        console.log(errorThrown);
    });

}); // closes document ready


