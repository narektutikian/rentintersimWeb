/**
 * Created by narek on 2/10/17.
 */

var filter_global = '';

/************* EVENT Handlers  **************/

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

var simActionEvents = {
    'click .sim_edit': function (e, value, row, index) {
        $('#provider_id').val(row.provider.id);
        $('#number').val(row.number);
        $('#id').val(row.id);

        if(row.state == 'parking'){
            $("#is_parking-edit").prop("checked", true);
        }
        else{
            $("#is_parking-edit").prop('checked', false);
        }
    }
};


/*********  Columns *********/

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
    formatter: statusFormatter
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
    formatter: statusFormatter
},{
    field: '',
    title: '',
    formatter: numberDeleteFormatter
}];


var simColumns = [{
    field: 'id',
    title: 'ID',
    sortable: true
}, {
    field: 'number',
    title: 'Sim Number',
    sortable: true
}, {
    field: 'provider.name',
    title: 'Provider',
    sortable: true
}, {
    field: '',
    title: 'Action',
    formatter: simActionFormatter,
    events: simActionEvents
}, {
    field: 'state',
    title: 'Status',
    sortable: true,
    formatter: statusFormatter
}, {
    field: '',
    title: '',
    formatter: simDeleteFormatter
}];

var simColumnsDeleted = [{
    field: 'id',
    title: 'ID',
    sortable: true
}, {
    field: 'number',
    title: 'Sim Number',
    sortable: true
}, {
    field: 'provider.name',
    title: 'Provider',
    sortable: true
}, {
    field: 'deleted_at',
    title: 'Deleted at',
    sortable: true
}, {
    field: '',
    title: 'Action',
    formatter: simActionFormatter,
    events: simActionEvents
}, {
    field: 'state',
    title: 'Status',
    formatter: statusFormatter
}, {
    field: '',
    title: '',
    formatter: simDeleteFormatter
}];

/****** Formators ******/

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

function simDeleteFormatter(value, row, index) {
    if (row.deleted_at == null){
        var dis = '';
        if (row.editable != 1)
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



function statusFormatter(value, row, index) {
    if (row.deleted_at != null)
        return 'Deleted';
    else return value;

}

function simActionFormatter(value, row, index) {
    var dis = '';
    if (row.editable != 1 || row.deleted_at != null)
        dis = 'disable';
    return '<span class="table_icon edit sim_edit '+ dis +'" data-toggle="modal" data-target="#modal_edit_sim" data-form="#modal_edit_sim">' +
            '<i class="icon-edit"></i></span>';

}


/******  Filters ******/

function filter(filter) {
    console.log(filter);
    filter_global = filter;
    $('#order_table_html').bootstrapTable('refresh');
    setFilterClass();

}



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
        case 'parking':
            $('.filter_parking').addClass('blue');
            break;
        case 'available':
            $('.filter_available').addClass('blue');
            break;

    }
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

}

function filterSims(filter) {
    filter_global = filter;
    if (filter == 'deleted'){
        $('#sim_table').bootstrapTable('refreshOptions', {
            columns: simColumnsDeleted
        });
    }
    else {
        $('#sim_table').bootstrapTable('refreshOptions', {
            columns: simColumns
        });
    }
    $('#number_table').bootstrapTable('refresh');
    setFilterClass();

    console.log(filter);

}

/***** Init Tables *****/

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

$('#sim_table').bootstrapTable({
    url: '/api/sim',
    columns: simColumns,
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



