$(document).ready(function () {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    /****** Order Creation ******/
    var package_id;
    var edit_id;
    console.log("edit id " + edit_id);
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
                    $("#create-order").remove();
                    $(".close").text("close");
                    // $("#create-order").attr("id", "edit-order");
                    var order_new;
                    if (Array.isArray(msg)){
                        order_new = msg[0];
                    } else {
                        order_new = msg;
                        }
                    $('#order_status').val(order_new.status);
                    if (order_new.status != "waiting") {
                        $('#phone_number2').val(order_new.phone.phone);
                        $('#phone_number').append($('<option>', {
                            value: order_new.phone.id,
                            text: order_new.phone.phone
                        }));
                        $("#phone_number").val(order_new.phone.id);
                        // edit_id = msg[0].id;
                        // console.log("edit id " + edit_id);
                        // edit_id = msg.id;
                        // console.log("edit id " + edit_id);
                    } else {
                        $(".error_response").empty();
                        $(".success_response").empty();
                        $(".success_response").append("Order created but there is no available number. Try getting number in Order table or edit order in edit form.");
                    }

                },
                error: function (error) {
                    console.log(error);
                    $(".error_response").empty();
                    $(".success_response").empty();
                    $(".error_response").append("ERROR  ");
                    if('sim' in error.responseJSON)
                        $(".error_response").append(error.responseJSON.sim);
                    else if('package_id' in error.responseJSON)
                        $(".error_response").append(" Please select SIM Package");
                    else
                    $(".error_response").append(error.responseText);

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
        edit_id = row_id;
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

        $.get("/order/" + row_id + "/edit", function (order_data, order_status) {

            if (order_status == "success") {

                $.get("/type-provider/1", function (data, type_status) {

                    if (type_status == "success") {

                        $.each(data, function (i, item) {

                            // console.log("success dfdfsfsd ");
                            // console.log(order_data.package_id);
                            // console.log(item.id);

                            if (item.id == order_data[0].package_id) {
                                package_id = item.id;
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
                        if (order_data[0].status != "waiting") {
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
                        $('.landing_date').val(order_data[0].landing.split(' ')[0]);
                        $('.departure_date').val(order_data[0].departure.split(' ')[0]);


                        // console.log(order_data[0].status)


                    }
                });
            }
        });


    });

    /***** EDIT ORDER *****/

    $('#edit-order').on('click', function (e) {
        e.stopPropagation(); // Stop stuff happening
        if ($(this).closest(".vd_form").valid()) {

            var departure = $('#departure_date-edit').val() + " "
                + $('#departure_hour-edit').text() + ":" + $('#departure_minute-edit').text();
            var landing = $('#landing_date-edit').val() + " "
                + $('#landing_hour-edit').text() + ":" + $('#landing_minute-edit').text();

            console.log(departure + " " + landing);
            var data = {
                _token: CSRF_TOKEN,
                sim: $('#sim-edit').val(),
                phone_id: $('#phone_number-edit').val(),
                landing: moment(landing, "DD/MM/YYYY HH:mm").valueOf() / 1000,
                departure: moment(departure, "DD/MM/YYYY HH:mm").valueOf() / 1000,
                package_id: package_id, // put package id
                reference_number: $('#reference_number-edit').val(),
                remark: $('#remark-edit').val(),
            };

            $.ajax({
                type: "PUT",
                url: 'order/' + edit_id,
                data: data,
                success: function (msg) {
                    $(".error_response").empty();
                    $(".success_response").empty();
                    $(".success_response").append("DONE");
                    $("#create-order").remove();
                    // $("#create-order").attr("id", "edit-order");
                    if (Array.isArray(msg))
                    {
                        // edit_id = msg[0].id;

                    } else {


                    }

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

});
/**
 * Created by narek on 12/16/16.
 */
