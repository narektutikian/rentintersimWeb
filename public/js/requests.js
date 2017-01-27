/**
 * Created by narek on 12/2/16.
 */

$(document).ready(function () {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    //$('.close').click(function () {
        //location.reload();
    //});

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
                        $(".success_response").append("DONE ");
                        location.reload();
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
                url: '/import-type',
                type: 'POST',
                data: new FormData($("#insert-type")[0]),
                cache: false,
                dataType: 'json',
                processData: false, // Don't process the files
                contentType: false, // Set content type to false as jQuery will tell the server its a query string request
                success: function (msg) {
                    $(".error_response").empty();
                    $(".success_response").empty();
                    $(".success_response").append("DONE ");
                    location.reload();
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
                    $(".success_response").append("DONE ");
                    location.reload();
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
/*
    /!****** Order Creation ******!/
    var package_id;
    $('#create-order').on('click', function (e) {
        e.stopPropagation(); // Stop stuff happening
        if ($(this).closest(".vd_form").valid()) {

            var departure = $('#departure_date').val() + " "
                + $('#departure_hour').text() + ":" + $('#departure_minute').text();
             var landing = $('#landing_date').val() + " "
                + $('#landing_hour').text() + ":" + $('#landing_minute').text();

            console.log(departure + " " + landing);
            var data = {
                _token: CSRF_TOKEN,
                sim: $('#sim').val(),
                phone_id: $('#phone_number').val(),
                landing: moment(landing, "DD/MM/YYYY HH:mm").valueOf() / 1000,
                departure: moment(departure, "DD/MM/YYYY HH:mm").valueOf() / 1000,
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

    $('.call_edit').on('click', function () {

        var row_id = $(this).attr('data-row-id');
        var editable_form = $(this).attr('data-form');
        var from = [], to = [];

        $(this).closest('td').siblings('.table_time_cell_large.from').each(function () {

            var self = $(this);
            var k = 0;
            split_date(self);

            $(editable_form).find('.wrap_time.from').each(function () {

                $(this).find('.vdf_hour').text(from[k]);
                $(this).find('.vdf_min').text(to[k]);
            });

        });

        $(this).closest('td').siblings('.table_time_cell_large.to').each(function () {

            var self = $(this);
            var j = 1;
            split_date(self);

            $(editable_form).find('.wrap_time.to').each(function () {

                $(this).find('.vdf_hour').text(from[j]);
                $(this).find('.vdf_min').text(to[j]);
            });

        });

        function split_date(self) {

            var full_date = self.text().trim();
            var time_cell = full_date.split(' ')[1];
            var hour_cell = time_cell.split(':')[0];
            var min_cell = time_cell.split(':')[1];

            from.push(hour_cell);
            to.push(min_cell);
        }

        $.get("/order/" + row_id +"/edit", function (order_data, order_status) {

            if (order_status == "success") {

                $.get("/type-provider/1", function (data, type_status) {

                    if (type_status == "success") {

                        $.each(data, function (i, item) {

                            // console.log("success dfdfsfsd ");
                            // console.log(order_data.package_id);
                            // console.log(item.id);

                            if (item.id == order_data[0].package_id) {

                                $(".wrap_package_list_edit").append("<div class='package_item'>" +
                                        "<a href='#' data-id='" + item.id + "' class='editable_package' title='Basic Package'>" +
                                        "<h4>" + item.name + "</h4>" +
                                        "<span>" + item.description + "</span>" +
                                        "</a>" +
                                    "</div>");
                            } else {

                                $(".wrap_package_list_edit").append("<div class='package_item'>" +
                                        "<a href='#' data-id='" + item.id + "' title='Basic Package'>" +
                                        "<h4>" + item.name + "</h4>" +
                                        "<span>" + item.description + "</span>" +
                                        "</a>" +
                                    "</div>");
                            }
                        });

                        $('#sim-edit').val(order_data[0].sim_id);
                        $('#remark-edit').val(order_data[0].remark);
                        $('#reference_number-edit').val(order_data[0].reference_number);
                        if (order_data[0].status != "waiting"){
                            $('#phone_number-edit2').val(order_data[0].phone.phone);
                            $('#phone_number-edit').append($('<option>', {
                                value: order_data[0].phone.id,
                                text: order_data[0].phone.phone
                            }));
                            $("#phone_number-edit").val(order_data[0].phone.id);
                        }
                        $('#order_status-edit').val(order_data[0].status);
                        $('#creator').text(order_data[0].creator.name + " " + order_data[0].created_at);
                        $('#editor').text(order_data[0].editor.name + " " + order_data[0].updated_at);

                        // console.log(order_data[0].status)


                    }
                });
            }
        });


    });*/


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
                    is_parking: $('#is-parking').is(":checked")
                };
                console.log(data.is_parking);

                $.ajax({
                    type: "POST",
                    url: '/sim',
                    data: data,
                    success: function (msg) {
                        $(".error_response").empty();
                        $(".success_response").empty();
                        $(".success_response").append("DONE ");
                        location.reload();
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
                url: '/import-sim',
                type: 'POST',
                data: new FormData($("#insert-sim")[0]),
                cache: false,
                dataType: 'json',
                processData: false, // Don't process the files
                contentType: false, // Set content type to false as jQuery will tell the server its a query string request
                success: function (msg) {
                    $(".error_response").empty();
                    $(".success_response").empty();
                    $(".success_response").append("DONE ");
                    location.reload();
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
                is_parking: $('#is_parking-edit').is(":checked")
            };
            var id = $('#id').val();

            $.ajax({
                type: "PUT",
                url: '/sim/' + id,
                data: data,
                success: function (msg) {
                    $(".error_response").empty();
                    $(".success_response").empty();
                    $(".success_response").append("DONE ");
                    location.reload();
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
                    is_special: $('#is_special').is(":checked")
                };
                // console.log(data);

                $.ajax({
                    type: "POST",
                    url: '/number',
                    data: data,
                    success: function (msg) {
                        $(".error_response").empty();
                        $(".success_response").empty();
                        $(".success_response").append("DONE " );
                        location.reload();
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
                url: '/import-number',
                type: 'POST',
                data: new FormData($("#add-number-form")[0]),
                cache: false,
                dataType: 'json',
                processData: false, // Don't process the files
                contentType: false, // Set content type to false as jQuery will tell the server its a query string request
                success: function (msg) {
                    $(".error_response").empty();
                    $(".success_response").empty();
                    $(".success_response").append("DONE " );
                    location.reload();
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
                is_special: $('#is_special-edit').is(":checked")
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
                    $(".success_response").append("DONE " );
                    location.reload();
                },
                error: function (error) {
                    $(".error_response").empty();
                    $(".success_response").empty();
                    $(".error_response").append("ERROR " + error.responseText);
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
                url: '/user',
                type: 'POST',
                data: new FormData($("#add-user")[0]),
                cache: false,
                dataType: 'json',
                processData: false, // Don't process the files
                contentType: false, // Set content type to false as jQuery will tell the server its a query string request
                success: function (msg) {
                    $(".error_response").empty();
                    $(".success_response").empty();
                    $(".success_response").append("DONE");
                    location.reload();
                },
                error: function (error) {
                    // console.log(error);
                    $(".error_response").empty();
                    $(".success_response").empty();
                    $(".error_response").append("ERROR " + error.responseText);
                    // $("#sim-edit-response").append("<div>"+"ERROR "+ error.responseJSON.number[0]+ " ," +error.responseJSON.provider_id[0] +"</div>");
                    // console.log(error.responseJSON.number[0]);
                }
            });
        }
    });

    /* User Management Nested Table */
    $.ajax({
        url: '/user-tree',
        success: function (json) {

            var string = '';
            var desabled_class = '';
            if (json[0]["level"] != "Super admin")
                desabled_class  = 'disable';

            function recursiveIteration(json) {

                for (var prop in json) {
                    var icon = '<a href="#" class="open_nested" data-toggle="collapse" data-target="#demo' + (json[prop]["id"] || "0") + '"><i class="icon-dropdown"></i></a>';
                    icon = (json[prop]["child"])? icon : '';
                    var status_text =  ' Active ';

                    string += '<tr>' +
                        '<td class="w25">' +
                        icon +
                        '</td>' +
                            '<td class="editable_cell">' + json[prop]["name"] + ' (' + json[prop]["type"] + ') ' + '</td>' +
                            '<td class="w160 editable_cell">' + json[prop]["login"] + '</td>' +
                            '<td class="w110left editable_cell">' + json[prop]["level"] + '</td>' +
                            '<td class="w65">' + json[prop]["active"] + '</td>' +
                            '<td class="w80">' + json[prop]["pending"] + '</td>' +
                            '<td class="w65">' + json[prop]["waiting"] + '</td>' +
                            '<td class="w60c table_action_cell">' +
                                '<span class="table_icon edit" data-toggle="modal"' +
                        'data-target="#modal_edit_user" data-form="#modal_edit_user" onclick="editUser('+ json[prop]["id"] +')"><i class="icon-edit"></i></span>' +
                            '</td>' +
                            '<td class="w_70_status table_status_cell">' +
                                '<span class="status_text_small not_used">' + status_text + '</span>' +
                            '</td>' +
                            '<td class="table_status_cell w_70_status '+ desabled_class +' ">' +
                                '<span class="remove_row" data-toggle="modal" data-target="#confirm_delete" data-row-id="' + json[prop]["id"]+ '">' +
                                    '<i class="icon-delete"></i>' +
                                '</span>' +
                            '</td>' +
                        '</tr>';

                    if (json[prop]["child"]) {
                        string += '<tr class="nested_row">' +
                                '<td></td>' +
                                '<td colspan="9" class="nested_cell">' +
                                '<div class="collapse nested_div" id="demo' + (json[prop]["id"] || "0") + '">' +
                            '<table class="responsive_table table user_management_table" data-toggle="table">' +
                            '<thead>' +
                            '</thead>' +
                            '<tbody>';
                        recursiveIteration(json[prop]["child"]);
                        string += '</tbody></table></div></td></tr>';
                    }

                }

            }

            recursiveIteration(json);

            $('#wrap_tree_table').prepend(
                '<table class="responsive_table table user_management_table" data-toggle="table" data-page="user">' +
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
                        '<th>' +
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



    /* Remove Row */
    $(document).on('click', '.remove_row', function () {


        $('#hidden-req-id').val('');
        $('#hidden-req-url').val('');
        var self =  $(this);

        var id = self.attr('data-row-id');
        var page = self.parents('table').attr('data-page');


        $('#hidden-req-id').val(id);
        $('#hidden-req-url').val(page);

    });


    $(document).one('click', '#delete', function () {

        var newId = $('#hidden-req-id').val();
        var newPage = $('#hidden-req-url').val();

        var url = '/' + newPage + '/' + newId;

        console.log('NEW url ', url);

        $.ajax({
            url: url,
            type: 'DELETE',
            data : {_token : CSRF_TOKEN},
            success: function(result) {
                // Do something with the result
                console.log('success ');
                //location.reload();
            }
        });

        return false;

    });

    $('#confirm_delete').one("hidden.bs.modal", function () {

        $('#hidden-req-id').val('');
        $('#hidden-req-url').val('');

    });

    /* Remove Row */
    $(document).on('click', '.recover_row', function () {

        var self =  $(this);
        var id = self.attr('data-row-id');
        var page = self.parents('table').attr('data-page');

        var url = '/' + page + '/recover/' + id;
        $('#confirm_recover').modal({ backdrop: 'static', keyboard: false })
            .one('click', '#recover', function () {

                $.ajax({
                    url: url,
                    type: 'post',
                    data : {_token : CSRF_TOKEN},
                    success: function(result) {
                        // Do something with the result
                        // console.log('success ' + result);
                        // self.closest('tr').remove();
                        location.reload();
                    }
                });
            });

    });

    /***** EDIT USER  *****/
    $('#edit_user_submit').on('click', function (e) {
        e.stopPropagation(); // Stop stuff happening
        console.log('user edit bef vald');
        if ($(this).closest(".vd_form").valid()) {
            console.log('user edit');
            var data = {
                _token: CSRF_TOKEN,
                name: $(".name").val(),
                level: $(".level").val(),
                type: $(".type").val(),
                supervisor_id: $(".supervisor_id").val(),
                email: $(".email").val(),
                email2: $(".email2").val(),
                username: $(".login").val(),
                password: $(".password").val()
            };

            $.ajax({
                url: '/user/' + $(".user_edit_id").val(),
                type: 'PUT',
                data: data,
                // cache: false,
                // dataType: 'json',
                // processData: false, // Don't process the files
                // contentType: false, // Set content type to false as jQuery will tell the server its a query string request
                success: function (msg) {
                    $(".error_response").empty();
                    $(".success_response").empty();
                    $(".success_response").append("DONE ");
                    location.reload();
                },
                error: function (error) {
                    // console.log(error);
                    $(".error_response").empty();
                    $(".success_response").empty();
                    $(".error_response").append("ERROR " + error.responseText);
                    // $("#sim-edit-response").append("<div>"+"ERROR "+ error.responseJSON.number[0]+ " ," +error.responseJSON.provider_id[0] +"</div>");
                    // console.log(error.responseJSON.number[0]);
                }
            });
        }
    });

    $('.number_edit').on('click', function () {
        var row_id = $(this).parents('td').attr('data-row-id');

        $.get("/number/" + row_id + "/edit", function (order_data, order_status) {
            if (order_status == "success") {

                $("#sim_id-edit").append($('<option>', {
                    value: order_data[0].initial_sim_id,
                    text: order_data[0].current_sim_id
                }));
                $("#sim_id-edit").val(order_data[0].initial_sim_id);


                if(order_data[0].is_special == 1){

                    $("#is_special-edit").attr("checked", true);
                }
                else if (order_data[0].is_special == 0)
                $("#is_special-edit").prop('checked', false);
            }

        });

    });

}); // closes document ready

function editUser(id) {
    $.get("/user/" + id + "/edit", function (data, status) {
        if (status == "success"){
            $(".name").val(data.name);
            $(".user_edit_id").val(data.id);
            $(".level").val(data.level);
            $(".type").val(data.type);
            $(".supervisor_id").val(data.supervisor_id);
            $(".email").val(data.email);
            $(".email2").val(data.email2);
            $(".login").val(data.login);

        }
    });
}

function filterLevel(level) {

    var $icon = $('#user-select>i');

    $icon.removeClass('icon-username');
    $icon.addClass('icon-time');

    $.get("/user-by-level/" + level, function (data, status) {
        if (status == "success"){
            // console.log(data);
            var options = "<option value=''>All</option>";
            // console.log(data);
            $.each(data, function (i, item) {
                options += "<option value=" +item.id +">" + item.login + "</option>";
            });

            $('.username')
                .find('option')
                .remove()
                .end()
                .append(options);

        }
        setTimeout(function(){
            $icon.removeClass('icon-time') ;
            $icon.addClass('icon-username');
        }, 500);

    });

}
