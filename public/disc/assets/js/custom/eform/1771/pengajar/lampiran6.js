var numFormat = $.fn.dataTable.render.number( '.', ',', 0 ).display;
var modal = $('#modal').DataTable({
    processing: true,
    serverSide: true,
    "bPaginate": false,
    "bLengthChange": false,
    "bFilter": false,
    "bInfo": false,
    ajax: "/eform/view/modal/"+spt_id,
    columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, className: "text-center align-middle"},
        {data: 'nama', name: 'nama', orderable: false, searchable: false, className: "align-middle"},
        {data: 'alamat', name: 'alamat', orderable: false, searchable: false, className: "align-middle"},
        {data: 'npwp', name: 'npwp', orderable: false, searchable: false, className: "align-middle"},
        {data: 'rupiah', name: 'rupiah', render: $.fn.dataTable.render.number( '.', ',', 0 ), orderable: false, searchable: false, className: "align-middle text-right"},
        {data: 'persen', name: 'persen', orderable: false, searchable: false, className: "align-middle text-center"},
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
        total = api
            .column(4)
            .data()
            .reduce((a, b) => intVal(a) + intVal(b), 0);

        // Update footer
        api.column(4).footer().innerHTML = numFormat(total);
    }
});

var utang = $('#utang').DataTable({
    processing: true,
    serverSide: true,
    "bPaginate": false,
    "bLengthChange": false,
    "bFilter": false,
    "bInfo": false,
    ajax: "/eform/view/utang/"+spt_id,
    columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, className: "text-center align-middle"},
        {data: 'nama', name: 'nama', orderable: false, searchable: false, className: "align-middle"},
        {data: 'npwp', name: 'npwp', orderable: false, searchable: false, className: "align-middle"},
        {data: 'jumlah', name: 'jumlah', orderable: false, searchable: false, className: "align-middle"},
        {data: 'tahun', name: 'tahun', orderable: false, searchable: false, className: "align-middle"},
        {data: 'bunga', name: 'bunga', orderable: false, searchable: false, className: "align-middle"},
    ]
});

var piutang = $('#piutang').DataTable({
    processing: true,
    serverSide: true,
    "bPaginate": false,
    "bLengthChange": false,
    "bFilter": false,
    "bInfo": false,
    ajax: "/eform/view/piutang/"+spt_id,
    columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, className: "text-center align-middle"},
        {data: 'nama', name: 'nama', orderable: false, searchable: false, className: "align-middle"},
        {data: 'npwp', name: 'npwp', orderable: false, searchable: false, className: "align-middle"},
        {data: 'jumlah', name: 'jumlah', orderable: false, searchable: false, className: "align-middle"},
        {data: 'tahun', name: 'tahun', orderable: false, searchable: false, className: "align-middle"},
        {data: 'bunga', name: 'bunga', orderable: false, searchable: false, className: "align-middle"},
    ]
});