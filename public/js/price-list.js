/**
 * Created by narek on 3/17/17.
 */
$(document).ready(function () {
    if (window.location.pathname == "/price-list") {
       var $PL = "";
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

            // console.log($PL);
           var $plName = $('#pl_name');
            $plTable = [];
            $.get("/price-list/" + $plId, function (pl_data, pl_status) {
                if (pl_status == "success"){
                    console.log(pl_data);
                    $('#pl_provider_name').text("Provider: " + pl_data.provider.name);
                    if ($PL == "My Price List")
                        $plName.text("Price List: My Price List");
                    else
                        $plName.text("Price List: " + pl_data.name);
                }
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
                else if (USER.level != "Super admin" && $PL == "Default"){
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
                console.log($plTable);

                        $bsTable.bootstrapTable('refreshOptions', {columns: plItemColumns});
                if ($PL == "Default"){
                    if (USER.level == "Super admin"){
                        $bsTable.bootstrapTable('refreshOptions', {columns: plItemColumnsSuper});
                    }
                    else
                        $bsTable.bootstrapTable('refreshOptions', {columns: plItemColumnsDefault});
                }

                refreshUsersTable(pl_data.users);
                refreshItemsTable($plTable);

                $('.pl_id').attr('data-pl-id', pl_data.id);
            });


        });
        function refreshItemsTable(data) {
            $bsTable.bootstrapTable('load', data);
        }
        function refreshUsersTable(data) {
            $bsUsersTable.bootstrapTable('load', data);
        }

        $bsTable.on('editable-save.bs.table', function (e, field, row, old, $el) {
            var data = {row: row, old: old, field: field, _token: CSRF_TOKEN};
            $.ajax({
                    type: 'PUT',
                    url: '/price-list/' + row.plId,
                    data: data,
                    success: function (msg) {},
                    error: function (error) {location.reload();}
            });
            console.log(data);

            return 'edited';
        });

        $('#pl_new_submit_button').on('click', function (e){
            if ($(this).closest(".vd_form").valid()) {
                console.log("submit new PL");
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
});

