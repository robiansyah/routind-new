var numFormat = $.fn.dataTable.render.number( '.', ',', 0 ).display;
var harta = $('#harta').DataTable({
    processing: true,
    serverSide: true,
    "bPaginate": false,
    "bLengthChange": false,
    "bFilter": false,
    "bInfo": false,
    ajax: "/eform/1770/view/harta/"+spt_id,
    columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, className: "text-center align-middle"},
        {data: 'kodeHarta', name: 'kodeHarta', orderable: false, searchable: false, className: "align-middle text-center"},
        {data: 'jnsHarta', name: 'jnsHarta', orderable: false, searchable: false, className: "align-middle"},
        {data: 'thPerolehan', name: 'thPerolehan', orderable: false, searchable: false, className: "align-middle text-center"},
        {data: 'harga', name: 'harga', render: $.fn.dataTable.render.number( '.', ',', 0 ), orderable: false, searchable: false, className: "align-middle text-right"},
        {data: 'ket', name: 'ket', orderable: false, searchable: false, className: "align-middle text-center"},
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
    ajax: "/eform/1770/view/utang/"+spt_id,
    columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, className: "text-center align-middle"},
        {data: 'kodeUtang', name: 'kodeUtang', orderable: false, searchable: false, className: "align-middle text-center"},
        {data: 'nmPbrPinjam', name: 'nmPbrPinjam', orderable: false, searchable: false, className: "align-middle"},
        {data: 'almtPbrPinjam', name: 'almtPbrPinjam', orderable: false, searchable: false, className: "align-middle"},
        {data: 'thPinjam', name: 'thPinjam', orderable: false, searchable: false, className: "align-middle text-center"},
        {data: 'jmlPinjam', name: 'jmlPinjam', render: $.fn.dataTable.render.number( '.', ',', 0 ), orderable: false, searchable: false, className: "align-middle text-right"},
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
        total_utang = api
            .column(5)
            .data()
            .reduce((a, b) => intVal(a) + intVal(b), 0);

        // Update footer
        api.column(5).footer().innerHTML = numFormat(total_utang);
    }
});

var keluarga = $('#keluarga').DataTable({
    processing: true,
    serverSide: true,
    "bPaginate": false,
    "bLengthChange": false,
    "bFilter": false,
    "bInfo": false,
    ajax: "/eform/1770/view/keluarga/"+spt_id,
    columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, className: "text-center align-middle"},
        {data: 'nmAgKel', name: 'nmAgKel', orderable: false, searchable: false, className: "align-middle"},
        {data: 'nik', name: 'nik', orderable: false, searchable: false, className: "align-middle"},
        {data: 'hubKel', name: 'hubKel', orderable: false, searchable: false, className: "align-middle"},
        {data: 'kerja', name: 'kerja', orderable: false, searchable: false, className: "align-middle"},
    ]
});