var numFormat = $.fn.dataTable.render.number( '.', ',', 0 ).display;
var setor = $('#setor').DataTable({
    processing: true,
    serverSide: true,
    "bPaginate": false,
    "bLengthChange": false,
    "bFilter": false,
    "bInfo": false,
    ajax: "/eform/view/setor/"+spt_id,
    columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, className: "text-center align-middle"},
        {data: 'kode_map', name: 'kode_map', orderable: false, searchable: false, className: "align-middle"},
        {data: 'kode_jenis', name: 'kode_jenis', orderable: false, searchable: false, className: "align-middle"},
        {data: 'tanggal', name: 'tanggal', orderable: false, searchable: false, className: "align-middle"},
        {data: 'bayar', name: 'bayar', render: $.fn.dataTable.render.number( '.', ',', 0 ), orderable: false, searchable: false, className: "align-middle text-center"},
        {data: 'ntpn', name: 'ntpn', orderable: false, searchable: false, className: "align-middle"},
    ]
});