var numFormat = $.fn.dataTable.render.number( '.', ',', 0 ).display;
var pemegang = $('#pemegang').DataTable({
    processing: true,
    serverSide: true,
    "bPaginate": false,
    "bLengthChange": false,
    "bFilter": false,
    "bInfo": false,
    ajax: "/eform/view/pemegang/"+spt_id,
    columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, className: "text-center align-middle"},
        {data: 'nama', name: 'nama', orderable: false, searchable: false, className: "align-middle"},
        {data: 'alamat', name: 'alamat', orderable: false, searchable: false, className: "align-middle"},
        {data: 'npwp', name: 'npwp', orderable: false, searchable: false, className: "align-middle"},
        {data: 'modal', name: 'modal', render: $.fn.dataTable.render.number( '.', ',', 0 ), orderable: false, searchable: false, className: "align-middle text-right"},
        {data: 'persen', name: 'persen', orderable: false, searchable: false, className: "align-middle text-center"},
        {data: 'dividen', name: 'dividen', render: $.fn.dataTable.render.number( '.', ',', 0 ), orderable: false, searchable: false, className: "align-middle text-right"},
    ],
    footerCallback: function (row, data, start, end, display) {
        let api = this.api();

        // Remove the formatting to get integer data for summation
        let intVal = function (i) {
            return typeof i === 'string'
                ? i.replace(/[\$,]/g, '') * 1
                : typeof i === 'number'
                ? i
                : 0;
        };

        // Total over all pages
        total_modal = api
            .column(4)
            .data()
            .reduce((a, b) => intVal(a) + intVal(b), 0);

        total_persen = api
            .column(5)
            .data()
            .reduce((a, b) => intVal(a) + intVal(b), 0);

        total_dividen = api
            .column(6)
            .data()
            .reduce((a, b) => intVal(a) + intVal(b), 0);

        // Update footer
        api.column(4).footer().innerHTML = numFormat(total_modal);
        api.column(5).footer().innerHTML = total_persen;
        api.column(6).footer().innerHTML = numFormat(total_dividen);
    }
});


var pengurus = $('#pengurus').DataTable({
    processing: true,
    serverSide: true,
    "bPaginate": false,
    "bLengthChange": false,
    "bFilter": false,
    "bInfo": false,
    ajax: "/eform/view/pengurus/"+spt_id,
    columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, className: "text-center align-middle"},
        {data: 'nama', name: 'nama', orderable: false, searchable: false, className: "align-middle"},
        {data: 'alamat', name: 'alamat', orderable: false, searchable: false, className: "align-middle"},
        {data: 'npwp', name: 'npwp', orderable: false, searchable: false, className: "align-middle"},
        {data: 'jabatan', name: 'jabatan', orderable: false, searchable: false, className: "align-middle"},
    ]
});