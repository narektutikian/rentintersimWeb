/**
 * Created by narek on 3/17/17.
 */
$(document).ready(function () {
    if (window.location.pathname == "/price-list") {
       var $PL = "";
       var $plItemColumns = [{
               title: "Item",
               field: "item"
           },{
                title: "Cost",
                field: "cost"
            },{
               title: "Sell price",
               field: "sell"
           }

       ];
        var $bsTable = $('#pl_item_table');
        var $plTable = [];
        $bsTable.bootstrapTable({
            data:$plTable,
            columns:$plItemColumns
        });
        $bsTable.bootstrapTable({
            data:$plTable,
            columns:$plItemColumns
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
                $plTable.push({
                    item: "SIM card",
                    cost: pl_data.pl_cost.cost,
                    sell: pl_data.cost
                });

                $.each(pl_data.price_lists, function (key, item) {
                    $plTable.push({
                        item: item.package.name,
                        cost: pl_data.pl_cost.price_lists[key].cost,
                        sell:item.cost
                    })
                });
                console.log($plTable);
                refreshItemsTable($plTable);
            });


        });
        function refreshItemsTable(data) {
            $bsTable.bootstrapTable('load', data);
        }
    }
});

