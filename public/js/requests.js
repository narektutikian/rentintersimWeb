/**
 * Created by narek on 12/2/16.
 */

$(document).ready(function () {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $('.close').click(function () {
        location.reload();
    });
    /****** type Creation ******/

    $('#add-type').on('click', function (e) {
        e.preventDefault();

        var fileVal = $('#type-file').val();
        if (fileVal == '') {
            if ($(this).closest(".vd_form").valid()) {
                var name = $('#name').val();
                var type_code = $('#type_code').val();
                var provider_id = $('#provider_id').val();
                var description = $('#description').val();
                $.ajax({
                    type: "POST",
                    url: '/type',
                    data: {
                        _token: CSRF_TOKEN,
                        name: name,
                        type_code: type_code,
                        provider_id: provider_id,
                        description: description
                    },
                    success: function (msg) {
                        $(".error_response").empty();
                        $(".success_response").empty();
                        $(".success_response").append("DONE " + msg);
                    },
                    error: function (error) {
                        $(".error_response").empty();
                        $(".success_response").empty();
                        $(".error_response").append("ERROR");
                        // $("#sim-edit-response").append("<div>"+"ERROR "+ error.responseJSON.number[0]+ " ," +error.responseJSON.provider_id[0] +"</div>");
                        // console.log(error.responseJSON.number[0]);
                    }
                });
            }
        }
        else {

            e.stopPropagation(); // Stop stuff happening

            $.ajax({
                url: 'import-type',
                type: 'POST',
                data: new FormData($("#insert-type")[0]),
                cache: false,
                dataType: 'json',
                processData: false, // Don't process the files
                contentType: false, // Set content type to false as jQuery will tell the server its a query string request
                success: function (msg) {
                    $(".error_response").empty();
                    $(".success_response").empty();
                    $(".success_response").append("DONE " + msg);
                },
                error: function (error) {
                    $(".error_response").empty();
                    $(".success_response").empty();
                    $(".error_response").append("ERROR");
                    // $("#sim-edit-response").append("<div>"+"ERROR "+ error.responseJSON.number[0]+ " ," +error.responseJSON.provider_id[0] +"</div>");
                    // console.log(error.responseJSON.number[0]);
                }
            });
        }
    });

    /***** EdIT TYPE  *****/

    $('#type-edit').on('click', function (e) {
        e.stopPropagation(); // Stop stuff happening
        if ($(this).closest(".vd_form").valid()) {

            var this_id = $(this).attr('id');
            // console.log(this_id);
            var data = {
                _token: CSRF_TOKEN,
                name: $('#name-edit').val(),
                type_code: $('#type_code-edit').val(),
                provider_id: $('#provider_id-edit').val(),
                description: $('#description-edit').val()
            };
            var id = $('#id-edit').val();
            // console.log( new FormData($("#edit-number-form")[0]));
            $.ajax({
                type: "PUT",
                url: '/type/' + id,
                // data: new FormData($("#edit-number-form")[0]),
                data: data,
                // cache: false,
                // dataType: 'json',
                // processData: false, // Don't process the files
                // contentType: false, // Set content type to false as jQuery will tell the server its a query string request
                success: function (msg) {
                    $(".error_response").empty();
                    $(".success_response").empty();
                    $(".success_response").append("DONE " + msg);
                },
                error: function (error) {
                    $(".error_response").empty();
                    $(".success_response").empty();
                    $(".error_response").append("ERROR");
                    // $("#sim-edit-response").append("<div>"+"ERROR "+ error.responseJSON.number[0]+ " ," +error.responseJSON.provider_id[0] +"</div>");
                    // console.log(error.responseJSON.number[0]);
                }
            });
        }
    });

    /****** Order Creation ******/
    var package_id;
    $('#create-order').on('click', function (e) {
        e.stopPropagation(); // Stop stuff happening
        if ($(this).closest(".vd_form").valid()) {

            var data = {
                _token: CSRF_TOKEN,
                sim: $('#sim').val(),

                landing: moment($('#landing_date').val(), "DD/MM/YYYY HH:mm").valueOf() / 1000,
                departure: moment($('#departure_date').val(), "DD/MM/YYYY HH:mm").valueOf() / 1000,
                package_id: package_id, // put package id
                reference_number: $('#reference_number').val(),
                remark: $('#remark').val(),
            };

            $.ajax({
                type: "POST",
                url: 'order',
                data: data,
                success: function (msg) {
                    $(".error_response").empty();
                    $(".success_response").empty();
                    $(".success_response").append("DONE");
                },
                error: function (error) {
                    $(".error_response").empty();
                    $(".success_response").empty();
                    $(".error_response").append("ERROR");
                    // $("#sim-edit-response").append("<div>"+"ERROR "+ error.responseJSON.number[0]+ " ," +error.responseJSON.provider_id[0] +"</div>");
                    // console.log(error.responseJSON.number[0]);
                }
            });
        }
    });

    $.get("/type-provider/1", function (data, status) {
        if (status == "success") {
            $.each(data, function (i, item) {
                //console.log(item.name + "\n");

                $(".wrap_package_list").append("<div class='package_item'>" +
                    "<a href='#' data-id='" + item.id + "' title='Basic Package'>" +
                    "<h4>" + item.name + "</h4>" +
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

    $.get("/type-provider/1", function (data, status) {
        if (status == "success") {
            $.each(data, function (i, item) {
                //console.log(item.name + "\n");

                $(".wrap_package_list_edit").append("<div class='package_item'>" +
                    "<a href='#' data-id='" + item.id + "' title='Basic Package'>" +
                    "<h4>" + item.name + "</h4>" +
                    "<span>" + item.description + "</span>" +
                    "</a>" +
                    "</div>");



            });

        }
    });

    /***** ADD NEW SIM *****/

    $('#add-sim').on('click', function (e) {
        e.preventDefault();


        var fileVal = $('#sim-file').val();
        if (fileVal == '') {
            if ($(this).closest(".vd_form").valid()) {
                var data = {
                    _token: CSRF_TOKEN,
                    number: $('#sim-number').val(),
                    provider_id: $('#provider-id').val(),
                    is_parking: $('#is-parking').val()
                };

                $.ajax({
                    type: "POST",
                    url: '/sim',
                    data: data,
                    success: function (msg) {
                        $(".error_response").empty();
                        $(".success_response").empty();
                        $(".success_response").append("DONE " + msg);
                    },
                    error: function (error) {
                        $(".error_response").empty();
                        $(".success_response").empty();
                        $(".error_response").append("ERROR");
                        // $("#sim-edit-response").append("<div>"+"ERROR "+ error.responseJSON.number[0]+ " ," +error.responseJSON.provider_id[0] +"</div>");
                    }
                });
            }
        }
        else {
            e.stopPropagation(); // Stop stuff happening
            $.ajax({
                url: 'import-sim',
                type: 'POST',
                data: new FormData($("#insert-sim")[0]),
                cache: false,
                dataType: 'json',
                processData: false, // Don't process the files
                contentType: false, // Set content type to false as jQuery will tell the server its a query string request
                success: function (msg) {
                    $(".error_response").empty();
                    $(".success_response").empty();
                    $(".success_response").append("DONE " + msg);
                },
                error: function (error) {
                    $(".error_response").empty();
                    $(".success_response").empty();
                    $(".error_response").append("ERROR");
                    // $("#sim-edit-response").append("<div>"+"ERROR "+ error.responseJSON.number[0]+ " ," +error.responseJSON.provider_id[0] +"</div>");
                    console.log(error.responseJSON.number[0]);
                }
            });
        }

    });

    /******  Edit sim ********/

    $('#edit-sim').on('click', function (e) {
        e.stopPropagation(); // Stop stuff happening
        if ($(this).closest(".vd_form").valid()) {

            var this_id = $(this).attr('id');
            var data = {
                _token: CSRF_TOKEN,
                number: $('#number').val(),
                provider_id: $('#provider_id').val(),
                is_parking: $('#is_parking').val()
            };
            var id = $('#id').val();

            $.ajax({
                type: "PUT",
                url: '/sim/' + id,
                data: data,
                success: function (msg) {
                    $(".error_response").empty();
                    $(".success_response").empty();
                    $(".success_response").append("DONE " + msg);
                },
                error: function (error) {
                    $(".error_response").empty();
                    $(".success_response").empty();
                    $(".error_response").append("ERROR");
                    // $("#sim-edit-response").append("<div>"+"ERROR "+ error.responseJSON.number[0]+ " ," +error.responseJSON.provider_id[0] +"</div>");
                    // console.log(error.responseJSON.number[0]);
                }
            });
        }

    });

    /***** ADD NEW NUMBER *****/

    $('#add-number').on('click', function (e) {
        e.preventDefault();


        var fileVal = $('#number-file').val();
        if (fileVal == '') {
            if ($(this).closest(".vd_form").valid()) {
                var data = {
                    _token: CSRF_TOKEN,
                    phone: $('#number').val(),
                    provider_id: $('#provider_id').val(),
                    package_id: $('#package_id').val(),
                    initial_sim_id: $('#sim_id').val(),
                    is_special: $('#is_special').val()
                };
                // console.log(data);

                $.ajax({
                    type: "POST",
                    url: '/number',
                    data: data,
                    success: function (msg) {
                        $(".error_response").empty();
                        $(".success_response").empty();
                        $(".success_response").append("DONE " + msg);
                    },
                    error: function (error) {
                        $(".error_response").empty();
                        $(".success_response").empty();
                        $(".error_response").append("ERROR");
                        // $("#sim-edit-response").append("<div>"+"ERROR "+ error.responseJSON.number[0]+ " ," +error.responseJSON.provider_id[0] +"</div>");

                    }
                });
            }
        }
        else {
            // alert($('#sim-file').val());

            e.stopPropagation(); // Stop stuff happening
            $.ajax({
                url: 'import-number',
                type: 'POST',
                data: new FormData($("#add-number-form")[0]),
                cache: false,
                dataType: 'json',
                processData: false, // Don't process the files
                contentType: false, // Set content type to false as jQuery will tell the server its a query string request
                success: function (msg) {
                    $(".error_response").empty();
                    $(".success_response").empty();
                    $(".success_response").append("DONE " + msg);
                },
                error: function (error) {
                    $(".error_response").empty();
                    $(".success_response").empty();
                    $(".error_response").append("ERROR");
                    // $("#sim-edit-response").append("<div>"+"ERROR "+ error.responseJSON.number[0]+ " ," +error.responseJSON.provider_id[0] +"</div>");
                    // console.log(error.responseJSON.number[0]);
                }
            });
        }
    });


    /******  Edit number ********/

    $('#edit-number').on('click', function (e) {
        e.stopPropagation(); // Stop stuff happening
        if ($(this).closest(".vd_form").valid()) {

            var this_id = $(this).attr('id');
            // console.log(this_id);
            var data = {
                _token: CSRF_TOKEN,
                phone: $('#number-edit').val(),
                initial_sim_id: $('#sim_id-edit').val(),
                package_id: $('#package_id-edit').val(),
                provider_id: $('#provider_id-edit').val(),
                is_special: $('#is_special-edit').val()
            };
            var id = $('#id').val();
            // console.log( new FormData($("#edit-number-form")[0]));
            $.ajax({
                type: "PUT",
                url: '/number/' + id,
                // data: new FormData($("#edit-number-form")[0]),
                data: data,
                // cache: false,
                // dataType: 'json',
                // processData: false, // Don't process the files
                // contentType: false, // Set content type to false as jQuery will tell the server its a query string request
                success: function (msg) {
                    $(".error_response").empty();
                    $(".success_response").empty();
                    $(".success_response").append("DONE " + msg);
                },
                error: function (error) {
                    $(".error_response").empty();
                    $(".success_response").empty();
                    $(".error_response").append("ERROR");
                    // $("#sim-edit-response").append("<div>"+"ERROR "+ error.responseJSON.number[0]+ " ," +error.responseJSON.provider_id[0] +"</div>");
                    // console.log(error.responseJSON.number[0]);
                }
            });
        }

    });

    /***** ADD NEW USER  *****/
    $('#create-user').on('click', function (e) {
        e.stopPropagation(); // Stop stuff happening
        if ($(this).closest(".vd_form").valid()) {
            console.log('user create');
            $.ajax({
                url: 'user',
                type: 'POST',
                data: new FormData($("#add-user")[0]),
                cache: false,
                dataType: 'json',
                processData: false, // Don't process the files
                contentType: false, // Set content type to false as jQuery will tell the server its a query string request
                success: function (msg) {
                    $(".error_response").empty();
                    $(".success_response").empty();
                    $(".success_response").append("DONE " + msg);
                },
                error: function (error) {
                    $(".error_response").empty();
                    $(".success_response").empty();
                    $(".error_response").append("ERROR" + error);
                    // $("#sim-edit-response").append("<div>"+"ERROR "+ error.responseJSON.number[0]+ " ," +error.responseJSON.provider_id[0] +"</div>");
                    // console.log(error.responseJSON.number[0]);
                }
            });
        }
    });

    /* User Management Nested Table */
    $.ajax({
        url: '/user-tree',
        //dataType: 'jsonp',
        success: function (json) {

            var string = '';

            function recursiveIteration(json) {


                for (var prop in json) {
                    var icon = '<a href="#" class="open_nested" data-toggle="collapse" data-target="#demo' + (json[prop]["id"] || "0") + '"><i class="icon-dropdown"></i></a>';
                    icon = (json[prop]["child"])? icon : '';
                    var status_text = (json[prop]["is_active"] == 1) ? ' Active ' : '';

                    string += '<tr>' +
                        '<td class="w25">' +
                        icon +
                        '</td>' +
                            '<td class="editable_cell" data-th="Name">' + json[prop]["name"] + ' (' + json[prop]["type"] + ') ' + '</td>' +
                            '<td class="w160 editable_cell" data-th="Username">' + json[prop]["login"] + '</td>' +
                            '<td class="w110left editable_cell" data-th="Level">' + json[prop]["level"] + '</td>' +
                            '<td class="w65" data-th="Active">' + json[prop]["active"] + '</td>' +
                            '<td class="w80" data-th="Pending">' + json[prop]["pending"] + '</td>' +
                            '<td class="w65" data-th="Waiting">' + json[prop]["waiting"] + '</td>' +
                            '<td class="w60c table_action_cell" data-th="Action">' +
                                '<span class="table_icon edit" data-toggle="modal" data-target="#modal_edit_user" data-form="#modal_edit_user"><i class="icon-edit"></i></span>' +
                            '</td>' +
                            '<td class="w_160_status table_status_cell" data-th="Status">' +
                                '<div class="vdf_radio">' +
                                    '<div class="toggle_container disabled">' +
                                        '<label class="label_unchecked">' +
                                            '<input type="radio" name="toggle" value="1"><span></span>' +
                                        '</label>' +
                                        '<label class="label_checked">' +
                                            '<input type="radio" name="toggle" value="0"><span></span>' +
                                        '</label>' +
                                    '</div>' +
                                '</div>' +
                            '<span class="status_text_small not_used">' + status_text + '</span>' +
                            '</td>' +
                        '</tr>';

                    if (json[prop]["child"]) {
                        string += '<tr class="nested_row">' +
                            '<td></td><td colspan="8" class="nested_cell">' +
                            '<div class="collapse nested_div" id="demo' + (json[prop]["id"] || "0") + '">' +
                            '<table class="responsive_table table user_management_table" data-toggle="table">' +
                            '<thead>' +
                            '</thead>' +
                            '<tbody>';
                        recursiveIteration(json[prop]["child"]);
                        string += '</tbody></table></div></td></tr>';
                    }

                }

                //string += '</tbody></table>';

            }

            recursiveIteration(json);

            $('#wrap_tree_table').prepend(
                '<table class="responsive_table table user_management_table" data-toggle="table">' +
                    '<thead>' +
                        '<tr>' +
                        '<th>' +
                            '<div class="th-inner"></div>' +
                            '<div class="fht-cell"></div>' +
                        '</th>' +
                        '<th>' +
                            '<div class="th-inner">Name</div>' +
                            '<div class="fht-cell"></div>' +
                        '</th>' +
                        '<th>' +
                            '<div class="th-inner">Username</div>' +
                            '<div class="fht-cell"></div>' +
                        '</th>' +
                        '<th>' +
                            '<div class="th-inner">Level</div>' +
                            '<div class="fht-cell"></div>' +
                        '</th>' +
                        '<th>' +
                            '<div class="th-inner">Active</div>' +
                            '<div class="fht-cell"></div>' +
                        '</th>' +
                        '<th>' +
                            '<div class="th-inner">Pending</div>' +
                            '<div class="fht-cell"></div>' +
                        '</th>' +
                        '<th>' +
                            '<div class="th-inner">Waiting</div>' +
                            '<div class="fht-cell"></div>' +
                        '</th>' +
                        '<th>' +
                            '<div class="th-inner">Action</div>' +
                            '<div class="fht-cell"></div>' +
                        '</th>' +
                        '<th>' +
                            '<div class="th-inner">Status</div>' +
                            '<div class="fht-cell"></div>' +
                        '</th>' +
                        '</tr>' +
                    '</thead>' +
                '<tbody>' +
                string +
                '</tbody></table>'
            );

            $('.open_nested').closest('td').css('border', '1px solid #ddd')

        }
    }).fail(function (jqXHR, textStatus, errorThrown) {

        console.log(errorThrown);
    });

}); // closes document ready


