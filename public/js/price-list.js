/**
 * Created by narek on 3/17/17.
 */
$(document).ready(function () {
    if (window.location.pathname == "/price-list") {
       var $PL = "";
        var $currentPL;
       var plItemColumns = [{
               title: "Item",
               field: "item"
           },{
                title: "Cost",
                field: "cost"

            },{
               title: "Sell price",
               field: "sell",
           editable: {
               type: 'text',
               title: 'Item Price',
               validate: function (value) {
                   value = $.trim(value);
                   if (!value) {
                       return 'This field is required';
                   }
                   if (!$.isNumeric(value)){
                       return 'Please enter valid number';
                   }
                   return '';
               }
           }
           }];
        var plItemColumnsSuper = [{
            title: "Item",
            field: "item"
        },{
            title: "Cost",
            field: "cost",
            editable: {
                type: 'text',
                title: 'Item Price',
                validate: function (value) {
                    value = $.trim(value);
                    if (!value) {
                        return 'This field is required';
                    }
                    if (!$.isNumeric(value)){
                        return 'Please enter valid number';
                    }
                    return '';
                }
            }
        },{
            title: "Sell price",
            field: "sell",
            editable: {
                type: 'text',
                title: 'Item Price',
                validate: function (value) {
                    value = $.trim(value);
                    if (!value) {
                        return 'This field is required';
                    }
                    if (!$.isNumeric(value)){
                        return 'Please enter valid number';
                    }
                    return '';
                }
            }
        }];
        var plItemColumnsDefault = [{
            title: "Item",
            field: "item"
        },{
            title: "Cost",
            field: "cost"
        },{
            title: "Sell price",
            field: "sell"
        }];

        var $plUsersColumns = [{
            title: "User",
            field: "login"
        },{
            title: "Level",
            field: "level"
        }];

        var $bsTable = $('#pl_item_table');
        var $bsUsersTable = $('#pl_users_table');
        var $plTable = [];
        var $plUsers = [];
        $bsUsersTable.bootstrapTable({
            data:$plUsers,
            columns:$plUsersColumns
        });

        $bsTable.bootstrapTable({
            uniqueId: 'id',
            idField: 'id'
            });

        console.log("price_list");


/****** Open Price List ******/
        $('.pl_li').on('click', function (e) {
            $plId = $(this).attr('data-pl-id');
            // console.log($(this));
            $PL = $(this).text();
            $('.wrap_icon').addClass('disable');
            if ($PL == 'Default' || $PL == 'My Price List')
                $('#pl_copy_button').removeClass('disable');
            else
            $('.wrap_icon').removeClass('disable');

            if(!$(this).hasClass('active')){
                $(this).closest('.main_nested_list').find('li').removeClass('active');
                $(this).addClass('active');
            }

            // console.log($PL);
           var $plName = $('#pl_name');
            $plTable = [];
            e.stopPropagation(); // Stop stuff happening
            $.get("/price-list/" + $plId, function (pl_data, pl_status) {
                if (pl_status == "success") {
                    $currentPL = pl_data;
                    // console.log(pl_data);
                    $('#pl_provider_name').text("Provider: " + pl_data.provider.name + " / ");
                    if ($PL == "My Price List")
                        $plName.text("Price List: My Price List");
                    else
                        $plName.text("Price List: " + pl_data.name);

                    if (USER.level == "Super admin" && $PL == "Default") {
                        $plTable.push({
                            plId: pl_data.id,
                            id: pl_data.id,
                            item: "SIM card",
                            cost: pl_data.pl_cost.cost,
                            sell: pl_data.cost
                        });

                        $.each(pl_data.provider.packages, function (key, item) {
                            var thisCost = 0;
                            if (typeof pl_data.pl_cost.price_lists[key] != "undefined")
                                thisCost = pl_data.pl_cost.price_lists[key].cost;
                            var sell = 0;
                            if (typeof pl_data.price_lists[key] != "undefined")
                                sell = pl_data.price_lists[key].cost;
                            else sell = thisCost;
                            $plTable.push({
                                plId: pl_data.id,
                                id: item.id,
                                item: item.name,
                                cost: thisCost,
                                sell: sell
                            })
                        });
                    }
                    else if (USER.level != "Super admin" && $PL == "Default") {
                        $plTable.push({
                            plId: pl_data.id,
                            id: pl_data.id,
                            item: "SIM card",
                            cost: pl_data.cost,
                            sell: pl_data.cost
                        });

                        $.each(pl_data.provider.packages, function (key, item) {
                            var thisCost = 0;
                            if (typeof pl_data.pl_cost.price_lists[key] != "undefined")
                                thisCost = pl_data.pl_cost.price_lists[key].cost;
                            var sell = 0;
                            if (typeof pl_data.price_lists[key] != "undefined")
                                sell = pl_data.price_lists[key].cost;
                            else sell = thisCost;
                            $plTable.push({
                                plId: pl_data.id,
                                id: item.id,
                                item: item.name,
                                cost: sell,
                                sell: sell
                            })
                        });
                    }
                    else {
                        $plTable.push({
                            plId: pl_data.id,
                            id: pl_data.id,
                            item: "SIM card",
                            cost: pl_data.pl_cost.cost,
                            sell: pl_data.cost
                        });

                        $.each(pl_data.provider.packages, function (key, item) {
                            var thisCost = 0;
                            if (typeof pl_data.pl_cost.price_lists[key] != "undefined")
                                thisCost = pl_data.pl_cost.price_lists[key].cost;
                            var sell = 0;
                            if (typeof pl_data.price_lists[key] != "undefined")
                                sell = pl_data.price_lists[key].cost;
                            else sell = thisCost;
                            $plTable.push({
                                plId: pl_data.id,
                                id: item.id,
                                item: item.name,
                                cost: thisCost,
                                sell: sell
                            })
                        });
                    }
                    // console.log($plTable);

                    $bsTable.bootstrapTable('refreshOptions', {columns: plItemColumns});
                    if ($PL == "Default") {
                        if (USER.level == "Super admin") {
                            $bsTable.bootstrapTable('refreshOptions', {columns: plItemColumnsSuper});
                        }
                        else
                            $bsTable.bootstrapTable('refreshOptions', {columns: plItemColumnsDefault});
                    }

                    if ($PL == "My Price List")
                        refreshUsersTable([{login: USER.login, level: USER.level}]);
                    else
                    refreshUsersTable(pl_data.users);
                    refreshItemsTable($plTable);

                    $('.pl_id').attr('data-pl-id', pl_data.id);
                    $('.editable').addClass('icon-edit2');
                }
                else
                    location.reload();
            });


        });
        function refreshItemsTable(data) {
            $bsTable.bootstrapTable('load', data);
        }
        function refreshUsersTable(data) {
            $bsUsersTable.bootstrapTable('load', data);
        }

        $bsTable.on('editable-save.bs.table', function (e, field, row, old, $el) {
            e.stopPropagation(); // Stop stuff happening
            var data = {row: row, old: old, field: field, _token: CSRF_TOKEN};
            $.ajax({
                    type: 'PUT',
                    url: '/price-list/' + row.plId,
                    data: data,
                    success: function (msg) {},
                    error: function (error) {location.reload();}
            });
            // console.log(data);

            return 'edited';
        });

        $('#pl_new_submit_button').on('click', function (e){
            e.stopPropagation(); // Stop stuff happening
            if ($(this).closest(".vd_form").valid()) {
                // console.log("submit new PL");
                $.ajax({
                    url: '/price-list',
                    type: 'POST',
                    data: new FormData($("#pl_new_form")[0]),
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

    }
    /**** Open Copy Modal  ****/
    $('#pl_copy_button').on('click', function (e) {
        $('.pl_name').text($currentPL.name);
        $('.pl_id').val($currentPL.id);
    });

    /**** Open delete Modal  ****/
    $('#pl_delete_button').on('click', function (e) {
        $('#hidden-req-id').val($currentPL.id);
        $('#hidden-req-url').val('price-list');
    });
    /**** Open user Modal  ****/
    $('#pl_user_button').on('click', function (e) {
        $('#pl_assigned_users > tbody').empty();
        $('.pl_id').val($currentPL.id);
       $.get('/pl-users/' + $currentPL.id, function (pl_users, status) {
           if (status == 'success'){
                console.log(pl_users);
               $.each(pl_users, function (key, item) {
                    var checked = '';
                   if (item.price_list.length !== 0)
                       checked = 'checked';
                   $('#pl_assigned_users').append('<tr>'+
                       '<td>'+
                       '<label class="checkbox_wrapper">'+
                       '<input type="checkbox" name="' + item.id + '" class="checkbox_hide" '+ checked +'>'+
                       '<span class="checkbox_replace"></span>'+
                       '</label>'+
                       '</td>'+
                       '<td>' + item.login + '</td>'+
                       '<td>' + item.level + '</td>'+
                       '</tr>');
               });

           }
       });
    });



    /**** Copy PL submiy  ****/
    $('.vd_form_submit').on('click', function (e) {
        e.stopPropagation(); // Stop stuff happening
        if ($(this).closest(".vd_form").valid()) {
            // console.log("submit new PL");
            $.ajax({
                url: $(this).closest(".vd_form").attr('action'),
                type: $(this).closest(".vd_form").attr('method'),
                data: new FormData($(this).closest(".vd_form")[0]),
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




    $(document).on('click', '.nested_list_brand', function () {

        $(this).next('.nested_list.expandable').slideToggle();
        $(this).find('.icon-dropdown').toggleClass('expanded');
    });

    $('.lists_users_table').mCustomScrollbar({ axis: "y"});

    if (typeof $currentPL === "undefined"){
        $('.wrap_icon').addClass('disable');
    }

});
