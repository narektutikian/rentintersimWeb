$(document).ready(function () {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    /****** Order Creation ******/
    var package_id;
    var edit_id;
    // console.log("edit id " + edit_id);
    $('#create-order').on('click', function (e) {
        e.stopPropagation(); // Stop stuff happening
        if ($(this).closest(".vd_form").valid()) {

            var departure = $('#departure_date').val() + " " + $("#time_element2").val();
            var landing = $('#landing_date').val() + " " + $("#time_element").val();

            // console.log(departure + " " + landing);
            var data = {
                _token: CSRF_TOKEN,
                sim: $('#sim').val(),
                phone_id: $('#phone_number').val(),
                landing: moment(landing, "DD/MM/YYYY HH:mm").valueOf() / 1000,
                departure: moment(departure, "DD/MM/YYYY HH:mm").valueOf() / 1000,
                landing_string: moment(landing, "DD/MM/YYYY HH:mm").format("DD/MM/YYYY HH:mm"),
                departure_string: moment(departure, "DD/MM/YYYY HH:mm").format("DD/MM/YYYY HH:mm"),
                package_id: package_id, // put package id
                reference_number: $('#reference_number').val(),
                remark: $('#remark').val(),
            };

            // console.log("landing: " + data.landing  + " departure " + data.departure);

            $.ajax({
                type: "POST",
                url: '/order',
                data: data,
                beforeSend: function() {
                    $(".error_response").empty();
                    $(".success_response").empty();
                    $(".success_response").append("Please wait <img src='/img/loader.gif' width='20'/>");
                },
                success: function (msg) {
                    location.reload();
                    /*$(".error_response").empty();
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
                        $(".success_response").append("Order created but there is no available number. Try getting number in Order table.");
                    }*/

                },
                error: function (error) {
                    // console.log(error);
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

/**** Getting all types for provider vodafone ****/
    $.get("/type-provider/1", function (data, status) {
        // console.log("type loading");
        if (status == "success") {
            $.each(data, function (i, item) {

                $(".wrap_package_list").append("<div class='package_item'>" +
                    "<a href='#' data-id='" + item.id + "' title='Basic Package'>" +
                    "<h4>" + item.name + "</h4>" +
                    "<span>" + item.description + "</span>" +
                    "</a>" +
                    "</div>");

            });
/**** SELECT PACKAGE FOR NEW ORDER *****/
            $(document).on('click', '.package_item > a', function () {

                package_id = $(this).attr('data-id');

                var select = $('#phone_number');
                select.find('option').remove();
                $.get("/phone/specials/" + package_id, function (data, status) {
                    if (status == "success"){
                        if (data[0] != null) {

                            var options = "<option value=''></option>";
                            // console.log(data);
                            $.each(data, function (i, item) {
                                options += "<option value=" +item.id +">" + item.phone + "</option>";
                            });

                            select
                                .find('option')
                                .remove()
                                .end()
                                .append(options);

                        }
                        // setTimeout(function(){
                        //     $icon.removeClass('icon-time') ;
                        //     $icon.addClass('icon-username');
                        // }, 500);
                    }
                });
                return false;
            });
        }
    });

    /******* Open Edit modal  *******/

    $('.call_edit').on('click', function () {

        var row_id = $(this).parents('td').attr('data-row-id');
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

                // $.get("/type-provider/1", function (data, type_status) {
                //
                //     if (type_status == "success") {

                        // $.each(data, function (i, item) {

                            // console.log("success dfdfsfsd ");
                            // console.log(order_data.package_id);
                            // console.log(item.id);

                            // if (item.id == order_data[0].package_id) {
                            //     package_id = item.id;
                            //     $(".wrap_package_list").empty();
                            //     $(".wrap_package_list_edit").append("<div class='package_item'>" +
                            //         "<a href='#' data-id='" + item.id + "' class='editable_package' title='Basic Package'>" +
                            //         "<h4>" + item.name + "</h4>" +
                            //         "<span>" + item.description + "</span>" +
                            //         "</a>" +
                            //         "</div>");
                            // }
                            // else {
                            //
                            //     $(".wrap_package_list_edit").append("<div class='package_item'>" +
                            //         "<a href='#' data-id='" + item.id + "' title='Basic Package'>" +
                            //         "<h4>" + item.name + "</h4>" +
                            //         "<span>" + item.description + "</span>" +
                            //         "</a>" +
                            //         "</div>");
                            // }
                        // });

                        $('#wrap_package_list_edit').empty();
                        $('#wrap_package_list_edit').append("<label class='table_label'>Selected Package </label>" +
                            "<a class='selected_package' title='"+ order_data[0].package.name +"'>" +
                            "<h4>"+ order_data[0].package.name +"</h4>" +
                            "<span>"+ order_data[0].package.description +"</span>" +
                            "</a>");

                        $('#sim-edit').val(order_data[0].sim_id);
                        $('#remark-edit').val(order_data[0].remark);
                        $('#reference_number-edit').val(order_data[0].reference_number);
                        $('#order_status-edit').val(order_data[0].status);
                        $('#creator').text(order_data[0].creator.name + " " + order_data[0].created_at);
                        if (order_data[0].editor != null)
                        $('#editor').text(order_data[0].editor.name);
                        $('#edited_at').text(" " + order_data[0].updated_at);
                        $('.landing_date').val(order_data[0].landing.split(' ')[0]);
                        $('.departure_date').val(order_data[0].departure.split(' ')[0]);
                        $('.landing_time_val').val(order_data[0].landing.split(' ')[1]);
                        $('.departure_time_val').val(order_data[0].departure.split(' ')[1]);

                        $('#activate-button').attr("onclick", "activateOrder("+ order_data[0].id +")");
                        $('#suspend-button').attr("onclick", "suspend("+ order_data[0].id +")");

                        if (order_data[0].status != 'pending')
                        $('#activate-button').addClass('disable');

                        if (order_data[0].status != 'active')
                            $('#suspend-button').addClass('disable');
                var select = $("#phone_number-edit");
                if (order_data[0].status != "waiting") {
                    $('#phone_number-edit2').val(order_data[0].phone.phone);
                    select.append($('<option>', {
                        value: order_data[0].phone.id,
                        text: order_data[0].phone.phone
                    }));
                    select.val(order_data[0].phone.id);
                }
                else if (order_data[0].status == "waiting"){

                    select.find('option').remove();
                    select.removeAttr("disabled");
                    $.get("/phone/specials/" + order_data[0].package.id, function (specials, special_status) {
                        if (special_status == "success"){
                            // console.log(specials);
                            if (specials[0] != null) {

                                var options = "<option value=''></option>";
                                // console.log(data);
                                $.each(specials, function (i, item) {
                                    options += "<option value=" +item.id +">" + item.phone + "</option>";
                                });

                                select
                                    .find('option')
                                    .remove()
                                    .end()
                                    .append(options);

                            }
                            // setTimeout(function(){
                            //     $icon.removeClass('icon-time') ;
                            //     $icon.addClass('icon-username');
                            // }, 500);
                        }
                    });
                }


                        // console.log(order_data[0].status)


                //     }
                // });
            }
        });


    });

  /***** Open print modal *******/
    $('.print').on('click', function () {

        var row_id = $(this).parents('td').attr('data-row-id');

        $.get("/order/" + row_id + "/edit", function (order_data, order_status) {
            if (order_status == "success") {

               if (order_data[0].status != "waiting"){
                   $('.email_phone_num').empty();
                   $('.email_phone_num').append("Phone Number : " + order_data[0].phone.phone +
                       " <br/> Sim Number : " + order_data[0].sim.number);
               }

                $('.selected_package_print').empty();
                $('.selected_package_print').append("<label class='table_label'>Selected Package </label>" +
                "<a class='selected_package' title='"+ order_data[0].package.name +"'>" +
                    "<h4>"+ order_data[0].package.name +"</h4>" +
                "<span>"+ order_data[0].package.description +"</span>" +
                "</a>");
                $('.from_print').text(order_data[0].landing);
                $('.to_print').text(order_data[0].departure);
                $('.mail_order').text(" #" + order_data[0].id);

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

            console.log($('#time_element').val());
            var data = {
                _token: CSRF_TOKEN,
                sim: $('#sim-edit').val(),
                phone_id: $('#phone_number-edit').val(),
                landing: moment(landing, "DD/MM/YYYY HH:mm").valueOf() / 1000,
                departure: moment(departure, "DD/MM/YYYY HH:mm").valueOf() / 1000,
                landing_string: moment(landing, "DD/MM/YYYY HH:mm").format("DD/MM/YYYY HH:mm"),
                departure_string: moment(departure, "DD/MM/YYYY HH:mm").format("DD/MM/YYYY HH:mm"),
                package_id: package_id, // put package id
                reference_number: $('#reference_number-edit').val(),
                remark: $('#remark-edit').val(),
            };

            $.ajax({
                type: "PUT",
                url: '/order/' + edit_id,
                data: data,
                success: function (msg) {
                    location.reload();
                    $(".error_response").empty();
                    $(".success_response").empty();
                    $(".success_response").append("DONE");
                    $("#edit-order").remove();
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
                        $(".success_response").append("Order edited but there is no available number. Try getting number in Order table.");
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

    $('.call_mail').on('click', function () {

        var row_id = $(this).attr('data-row-id');
        edit_id = row_id;

        $.get("/order/" + row_id + "/edit", function (order_data, order_status) {

            if (order_status == "success") {

                $.get("/type-provider/1", function (data, type_status) {

                    if (type_status == "success") {

                        $.each(data, function (i, item) {



                            if (item.id == order_data[0].package_id) {
                                package_id = item.id;
                                $(".single_package").empty();
                                $(".single_package").append(
                                    "<a title='Basic Package'  class='selected_package' title='" + item.name + "' > " +
                                    "<h4>" + item.name + "</h4>" +
                                    "<span>" + item.description + "</span>" +
                                    "</a>" );
                            }

                        });

                        $('.phone').val(order_data[0].phone.phone);
                        $('.mail_order').text("#" + order_data[0].id);



                        $('.from').text(order_data[0].landing);
                        $('.to').text(order_data[0].departure);


                        // console.log(order_data[0].status)


                    }
                });
            }
        });


    });

    /***** SEND ORDER *****/

    $('#send-order').on('click', function (e) {
        e.stopPropagation(); // Stop stuff happening
        if ($(this).closest(".vd_form").valid()) {

            // console.log(departure + " " + landing);
            var data = {
                _token: CSRF_TOKEN,
                email: $('#email').val(),
                remark: $('#send_text').val(),
            };

            $.ajax({
                type: "GET",
                url: '/send-mail/' + edit_id,
                data: data,
                beforeSend: function() {
                    $(".error_response").empty();
                    $(".success_response").empty();
                    $(".success_response").append("Please wait <img src='/img/loader.gif' width='20'/>");
                },
                success: function (msg) {
                    location.reload();
                    $(".error_response").empty();
                    $(".success_response").empty();
                    $(".success_response").append("MASSAGE SENT SUCCESSFULLY");
                    $("#edit-order").remove();
                    $(".close").text("close");
                    // $("#create-order").attr("id", "edit-order");

                },
                error: function (error) {
                    $(".error_response").empty();
                    $(".success_response").empty();
                    $(".error_response").append("ERROR SENDING MASSAGE");
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
function getNumber(id) {
    // console.log("get number for " + id)
    $.ajax({
        type: "GET",
        url: '/get-number/' + id,
        beforeSend: function() {
            $(".error_response").empty();
            $(".success_response").empty();
            $(".success_response").append("Please wait <img src='/img/loader.gif' width='20'/>");
        },
        success: function (msg) {
            // console.log(msg);
            $('a#'+ id).remove();
            $("td[data-cell-id='"+ id +"']" ).text(msg.number);
            location.reload();
        },
        error: function (error) {
            // console.log("error " + error);
            $('a#'+ id).html("number not found").css("color", "red");
            $('a#'+ id).parent('td');
        }
    });
}

function activateOrder(id) {
    // console.log("get number for " + id)
    $.ajax({
        type: "GET",
        url: '/activate/' + id,
        beforeSend: function() {
            $(".error_response").empty();
            $(".success_response").empty();
            $(".success_response").append("Please wait <img src='/img/loader.gif' width='20'/>");
        },
        success: function (msg) {
            location.reload();
        },
        error: function (error) {
            $(".error_response").empty();
            $(".success_response").empty();
            $(".error_response").append("ACTIVATION ERROR");
        }
    });
}

    function suspend(id) {
        // console.log("get number for " + id)
        $.ajax({
            type: "GET",
            url: '/deactivate/' + id,
            beforeSend: function() {
                $(".error_response").empty();
                $(".success_response").empty();
                $(".success_response").append("Please wait <img src='/img/loader.gif' width='20'/>");
            },
            success: function (msg) {
                location.reload();
            },
            error: function (error) {
                $(".error_response").empty();
                $(".success_response").empty();
                $(".error_response").append("ACTIVATION ERROR");
            }
        });
}