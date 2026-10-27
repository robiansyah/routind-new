var numFormat = $.fn.dataTable.render.number( '.', ',', 0 ).display;
var penghasilan = $('#penghasilan').DataTable({
    processing: true,
    serverSide: true,
    "bPaginate": false,
    "bLengthChange": false,
    "bFilter": false,
    "bInfo": false,
    ajax: "/eform/view/penghasilan/"+spt_id,
    columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, className: "text-center align-middle"},
        {data: 'jenis', name: 'jenis', orderable: false, searchable: false, className: "align-middle"},
        {data: 'pajak', name: 'pajak', render: $.fn.dataTable.render.number( '.', ',', 0 ), orderable: false, searchable: false, className: "align-middle"},
        {data: 'tarif', name: 'tarif', orderable: false, searchable: false, className: "align-middle"},
        {data: 'terutang', name: 'terutang', render: $.fn.dataTable.render.number( '.', ',', 0 ), orderable: false, searchable: false, className: "align-middle text-right"},
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
        total_penghasilan = api
            .column(4)
            .data()
            .reduce((a, b) => intVal(a) + intVal(b), 0);

        // Update footer
        api.column(4).footer().innerHTML = numFormat(total_penghasilan);
    }
});

var lainnya = $('#lainnya').DataTable({
    processing: true,
    serverSide: true,
    "bPaginate": false,
    "bLengthChange": false,
    "bFilter": false,
    "bInfo": false,
    ajax: "/eform/view/lainnya/"+spt_id,
    columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, className: "text-center align-middle"},
        {data: 'jenis', name: 'jenis', orderable: false, searchable: false, className: "align-middle"},
        {data: 'penghasilan', name: 'penghasilan', render: $.fn.dataTable.render.number( '.', ',', 0 ), orderable: false, searchable: false, className: "align-middle text-right"},
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
        total_lainnya = api
            .column(2)
            .data()
            .reduce((a, b) => intVal(a) + intVal(b), 0);

        // Update footer
        api.column(2).footer().innerHTML = numFormat(total_lainnya);
    }
});