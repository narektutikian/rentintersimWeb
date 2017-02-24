/**
 * Created by narek on 2/10/17.
 */

var filter_global = '';

var numberActionEvents = {
    'click .number_edit': function (e, value, row, index) {
                // console.log(order_data);
                $("#sim_id-edit").append($('<option>', {
                    value: row.parking_sim.id,
                    text: row.parking_sim.number
                }));
                $("#sim_id-edit").val(row.parking_sim.id);


                if(row.is_special == 1){
                    $("#is_special-edit").prop("checked", true);
                }
                else if (row.is_special == 0){
                    $("#is_special-edit").prop('checked', false);
                }

                $('#number-edit').val(row.phone);
                $('#provider_id-edit').val(row.sim.provider.id);
                $('#package_id-edit').val(row.package.id);
                $('#id').val(row.id);
    }
};

var columns_all = [{
    field: 'id',
    title: 'ID',
    sortable: true
}, {
    field: 'phone',
    title: 'Phone Number',
    sortable: true
}, {
    field: 'sim.number',
    title: 'SIM Number',
    sortable: true
}, {
    field: 'parking_sim.number',
    title: 'Parking SIM Number'
},{
    field: 'sim.provider.name',
    title: 'Provider',
    sortable: true
},{
    field: 'package.name',
    title: 'Type',
    sortable: true
},{
    field: '',
    title: 'Action',
    events: numberActionEvents,
    formatter: numberActionFormatter
},{
    field: 'state',
    title: 'Status',
    sortable: true,
    formatter: numberStatusFormatter
},{
    field: '',
    title: '',
    formatter: numberDeleteFormatter
}];

var columnsDeleted = [{
    field: 'id',
    title: 'ID',
    sortable: true
}, {
    field: 'phone',
    title: 'Phone Number',
    sortable: true
}, {
    field: 'sim.number',
    title: 'SIM Number',
    sortable: true
}, {
    field: 'parking_sim.number',
    title: 'Parking SIM Number'
},{
    field: 'sim.provider.name',
    title: 'Provider',
    sortable: true
},{
    field: 'package.name',
    title: 'Type',
    sortable: true
},{
    field: 'deleted_at',
    title: 'Deleted at',
    sortable: true
},{
    field: '',
    title: 'Action',
    events: numberActionEvents,
    formatter: numberActionFormatter
},{
    field: 'state',
    title: 'Status',
    formatter: numberStatusFormatter
},{
    field: '',
    title: '',
    formatter: numberDeleteFormatter
}];



$('#number_table').bootstrapTable({
    url: '/api/number',
    columns: columns_all,
    queryParams: function(p) {
        return {
            limit: p.limit,
            offset: p.offset,
            sort: p.sort,
            order: p.order,
            search: p.search,
            filter: filter_global
        }
    }
});



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
            $('.filter_all').addClass('blue');
            break;
        case 'pending':
            $('.filter_pending').addClass('blue');
            break;
        case 'active':
            $('.filter_active').addClass('blue');
            break;
        case 'waiting':
            $('.filter_waiting').addClass('blue');
            break;
        case 'done':
            $('.filter_done').addClass('blue');
            break;
        case 'not in use':
            $('.filter_notinuse').addClass('blue');
            break;
        case 'specials':
            $('.filter_special').addClass('blue');
            break;
         case 'deleted':
            $('.filter_deleted').addClass('blue');
            break;

    }
}

function numberActionFormatter(value, row, index) {
    var dis = '';
    var special = '';
    if (row.state != 'not in use' || row.deleted_at != null)
        dis = 'disable';
    if (row.is_special == 1)
        special = 'checked';
    return [
        '<span class="table_icon edit number_edit ' + dis + '" data-toggle="modal" data-target="#modal_edit_number" data-form="#modal_edit_number">',
        '<i class="icon-edit"></i></span>',
        '<label class="vdf_checkbox disable">',
        '<input type="checkbox" name="num_chkb' + row.id + '" value="" ' + special +'/>',
        '<i class="icon-special"></i></label>'
    ].join('');
}

function numberDeleteFormatter(value, row, index) {
if (row.deleted_at == null){
    var dis = '';
    if (row.state != 'not in use')
        dis = 'disable';
    return '<span class="remove_row ' +  dis  +'" data-toggle="modal" data-target="#confirm_delete" data-row-id="'+ row.id +'">' +
            '<i class="icon-delete"></i></span>';
}
else if (row.deleted_at != null){
    return '<span class="recover_row" data-toggle="modal" data-target="#confirm_recover" data-row-id=" ' + row.id + '">' +
            '<i class="icon-delete"></i></span>';
}
    return false;
}

function numberStatusFormatter(value, row, index) {
    if (row.deleted_at != null)
        return 'Deleted';
    else return value;

}

function filterNumbers(filter) {
      filter_global = filter;
    if (filter == 'deleted'){
        $('#number_table').bootstrapTable('refreshOptions', {
            columns: columnsDeleted
        });
    }
    else {
        $('#number_table').bootstrapTable('refreshOptions', {
            columns: columns_all
        });
    }
        $('#number_table').bootstrapTable('refresh');
        setFilterClass();

    console.log(filter);

}

