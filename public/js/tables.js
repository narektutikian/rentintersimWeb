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

var filter_global = '';

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
        ' </span>'

    ].join('');
}

function formatDelete(value, row, index) {
    var dis = "";
    if (row.status == "active" || auth_level != "Super admin" && row.status == "done")
        dis = "disable";

    return [
        '<span class="remove_row  '+ dis +'" data-toggle="modal" data-target="#confirm_delete" data-row-id="'+ row.id +'">',
        '<i class="icon-delete"></i>',
        '</span>'
    ]
}

function formatNumber(value, row, index) {

    if (row.status == 'waiting')
        return '<a id="'+ row.id +'" onClick = "getNumber('+ row.id +');">In process</a>';
    else
        return value;

}

function formatReference(value, row, index) {
    if (row.reference_number != ''){
        return '<span class="hint_text ref_number" data-toggle="tooltip"  data-trigger="click" data-original-title="'+ row.reference_number +'">' +
            row.reference_number.substr(0, 9) +
            '<span class="hint">i</span></span>';
    }
    else return '';
}


function filter(filter) {
    console.log(filter);
    filter_global = filter;
    $('#order_table_html').bootstrapTable('refresh');
    setFilterClass();

}


$('#order_table_html').bootstrapTable({
    queryParams: function (p) {
        return {
            limit: p.limit,
            offset: p.offset,
            sort: p.sort,
            order: p.order,
            search: p.search,
            filter: filter_global
        };
    }
});

function setFilterClass() {
    $('.filter_buttons a').removeClass('blue');
    switch (filter_global) {
        case '':
            $('#filter_all').addClass('blue');
            break;
        case 'pending':
            $('#filter_pending').addClass('blue');
            break;
        case 'active':
            $('#filter_active').addClass('blue');
            break;
        case 'waiting':
            $('#filter_waiting').addClass('blue');
            break;
        case 'done':
            $('#filter_done').addClass('blue');
            break;
    }
}





