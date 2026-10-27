var numFormat = $.fn.dataTable.render.number( '.', ',', 0 ).display;
var pemotongan = $('#pemotongan').DataTable({
    processing: true,
    serverSide: true,
    "bPaginate": false,
    "bLengthChange": false,
    "bFilter": false,
    "bInfo": false,
    ajax: "/eform/view/pemotongan/"+spt_id,
    columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, className: "text-center align-middle"},
        {data: 'nama', name: 'nama', orderable: false, searchable: false, className: "align-middle"},
        {data: 'npwp', name: 'npwp', orderable: false, searchable: false, className: "align-middle"},
        {data: 'jenis', name: 'jenis', orderable: false, searchable: false, className: "align-middle"},
        {data: 'potongan', name: 'potongan', render: $.fn.dataTable.render.number( '.', ',', 0 ), orderable: false, searchable: false, className: "align-middle text-center"},
        {data: 'pph', name: 'pph', render: $.fn.dataTable.render.number( '.', ',', 0 ), orderable: false, searchable: false, className: "align-middle text-center"},
        {data: 'no_bukti', name: 'no_bukti', orderable: false, searchable: false, className: "align-middle"},
        {data: 'tanggal', name: 'tanggal', orderable: false, searchable: false, className: "align-middle"},
        {data: 'alamat', name: 'alamat', orderable: false, searchable: false, className: "align-middle"},
        {data: 'ntpn', name: 'ntpn', orderable: false, searchable: false, className: "align-middle"},
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
            .column(5)
            .data()
            .reduce((a, b) => intVal(a) + intVal(b), 0);

        // Update footer
        api.column(5).footer().innerHTML = numFormat(total);
    }
});