var reload = false;
var edit_id;
$(document).ready(function () {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    /****** Order Creation ******/
    var package_id;

    // console.log("edit id " + edit_id);
    $('#create-order').on('click', function (e) {
        e.stopPropagation(); // Stop stuff happening
        $('.timepicker_wrap').fadeOut();
        if ($(this).closest(".vd_form").valid()) {


            var departure = $('#departure_date').val() + " " + $("#time_element2").val();
            var landing = $('#landing_date').val() + " " + $("#time_element").val();

            if ($("#time_element2").val() != "00:00" && $("#time_element").val() != "00:00") {



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
                    beforeSend: function () {

                        $(".error_response").empty();
                        $(".success_response").empty();
                        $(".success_response").append("Please wait <img src='/img/loader.gif' width='20'/>");
                    },
                    success: function (msg) {
                        // location.reload();
                        reload = true;
                        $(".error_response").empty();
                         $(".success_response").empty();
                         $(".success_response").append("DONE");
                         $("#create-order").remove();
                         $(".ok").text("OK").attr("onClick", "window.location.reload()");
                         $("#new_actions").css("visibility","visible");
                         // $("#create-order").attr("id", "edit-order");
                         var order_new;
                         if (Array.isArray(msg)){
                         order_new = msg[0];
                         } else {
                         order_new = msg;
                         }
                        $(".print_new").attr("onClick", "initPrintForm(" + order_new.id + ")");
                        $(".call_mail_new").attr("onClick", "initEmailForm(" + order_new.id + ", 'new_order')");
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
                         }

                    },
                    error: function (error) {
                        // console.log(error);
                        $(".error_response").empty();
                        $(".success_response").empty();
                        $(".error_response").append("ERROR  ");
                        if ('sim' in error.responseJSON)
                            $(".error_response").append(error.responseJSON.sim);
                        else if ('package_id' in error.responseJSON)
                            $(".error_response").append(" Please select SIM Package");
                        else
                            $(".error_response").append(error.responseText);

                        // console.log(error.responseJSON.number[0]);
                    }
                });
            }
            else {
                $(".error_response").empty();
                $(".success_response").empty();
                $(".error_response").append("ERROR  Time can not be 00:00");

            }
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





  /***** Open print modal *******/




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
                    $('#modal_order_email').modal('toggle');
                    // location.reload();
                    $(".error_response").empty();
                    $(".success_response").empty();
                    $(".success_response").append("MASSAGE SENT SUCCESSFULLY");
                    // $("#send-order").remove();
                    $(".close_print").text("close");
                    if ($("#refresh").val() == "list"){
                        $("#refresh").val("refresh");
                    }
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

    $('#sort_order_phone').on('click', function (e) {
       $order = $(this).attr('asc');
        console.log('order dir', $order);
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

function build_orders_table(json) {
    console.log(json);
}
window.operateEvent = {
    'click .call_edit': function (e, value, row, index) {
        // console.log('You click like icon, row: ' + JSON.stringify(row));
        // console.log(value, row, index);
        // var row_id = $(this).parents('td').attr('data-row-id');
        var row_id = $(this).closest('tr').attr('data-uniqueid');
        console.log("row.id " + row.id);
        console.log("row_id " + row_id);

        edit_id = row_id;
        $.get("/order/" + row_id + "/edit", function (order_data, order_status) {

            if (order_status == "success") {



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

                if (order_data[0].status != 'pending'){
                    $('#activate-button').addClass('disable');
                    $('#suspend-button').removeClass('disable');
                }

                if (order_data[0].status != 'active'){
                    $('#suspend-button').addClass('disable');
                    $('#activate-button').removeClass('disable');
                }

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
                    $('#activate-button').addClass('disable');
                    $('#suspend-button').addClass('disable');

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


    },
    'click .print': function (e, value, row, index) {
        var row_id = $(this).closest('tr').attr('data-uniqueid');
        // console.log(row_id);
        initPrintForm(row_id);

        //



    },
    'click .call_mail': function (e, value, row, index) {
        var row_id = $(this).closest('tr').attr('data-uniqueid');
        // edit_id = row_id;
        initEmailForm(row_id, "list");




    }
};

function initEmailForm(orderId, from) {
    edit_id = orderId;
    $.get("/order/" + orderId + "/edit", function (order_data, order_status) {

        if (order_status == "success") {

            $.get("/type-provider/1", function (data, type_status) {

                if (type_status == "success") {

                    if (from == "new_order"){
                        $("#refresh").val("new_order");
                    }
                    else if (from == "list"){
                        $("#refresh").val("list");
                    }

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
                    if (order_data[0].status != "waiting"){

                        $('.phone').val(order_data[0].phone.phone);
                    }
                    else {
                        $('.phone').val("No number");
                    }
                    $('.mail_order').text("#" + order_data[0].id);



                    $('.from').text(order_data[0].landing);
                    $('.to').text(order_data[0].departure);


                    // console.log(order_data[0].status)


                }
            });
        }
    });

}

function initPrintForm(orderId) {

    $.get("/order/" + orderId + "/edit", function (order_data, order_status) {
        if (order_status == "success") {

            $('.email_phone_num').empty();

            if (order_data[0].status != "waiting"){

                $('.email_phone_num').append("Phone Number : " + order_data[0].phone.phone +
                    " <br/> Sim Number : " + order_data[0].sim.number);
            }
            else {
                $('.email_phone_num').append("Sim Number : " + order_data[0].sim.number);
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

}
