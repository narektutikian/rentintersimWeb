/**
 * Created by narek on 2/10/17.
 */
// $('#order_table').bootstrapTable({
//     url: '/api/order',
//     columns: [{
//         field: 'phone.phone',
//         title: 'Phone'
//     }, {
//         field: 'sim.number',
//         title: 'SIM number'
//     }, {
//         field: 'sim.provider.name',
//         title: 'Provider'
//     }, {
//          field: 'landing',
//          title: 'From'
//     },{
//         field: 'departure',
//         title: 'To'
//     },{
//         field: 'creator.name',
//         title: 'Dealer'
//     },{
//         field: '',
//         title: 'Action'
//     },{
//         field: 'status',
//         title: 'Status'
//     },{
//         field: '',
//         title: ''
//     },]
// });

var filter_dlogal = '';

function formatActions(value, row, index) {
    var dis = "";
    if (row.status == "active" && auth_level != "Super admin" || row.status == "done")
        dis = "disable";

    return [
        '<span class="table_icon call_edit ',
        dis,
        '" data-toggle="modal"  data-target="#modal_edit_order" data-form="#modal_edit_order">',
        '<i class="icon-edit"></i>',
        '</span>',
        '<span class="table_icon print" data-toggle="modal" data-target="#modal_print_order" data-form="modal_print_order">',
        '<i class="icon-print"></i>',
        '</span>',
        '<span class="table_icon call_mail"  data-toggle="modal" data-target="#modal_order_email">',
        ' <i class="icon-email"></i>',
        '  </span>'

    ].join('');
}

function formatDelete(value, row, index) {
    var dis = "";
    if (row.status == "active" || auth_level != "Super admin" && row.status == "done")
        dis = "disable";

    return [
        '<span class="remove_row  '+ dis +'" data-toggle="modal" data-target="#confirm_delete" data-row-id="">',
        '<i class="icon-delete"></i>',
        '</span>'
    ]
}

function filter(filter) {
    console.log(filter);
    filter_dlogal = filter;
    var data;
    $.get("/api/order?filter=active&offset=0&limit=15", function(data, status){
        if (status == "success"){
            $('#order_table_html').bootstrapTable('load', data);
        }
    });
}


$('#order_table_html').bootstrapTable({
    queryParams: function (p) {
        return {
            limit: p.limit,
            offset: p.offset,
            sort: p.sort,
            order: p.order,
            search: p.search,
            filter: filter_dlogal
        };
    }
});
// {{ ($order[\'status\'] == \'active\' && Auth::user()->level != \'Super admin\' || $order['status'] == 'done') ? 'disable' : ''
// {{ ($order['status'] == 'active' || (Auth::user()->level != 'Super admin' && $order['status'] == 'done')) ? 'disable' : '' }}}}




