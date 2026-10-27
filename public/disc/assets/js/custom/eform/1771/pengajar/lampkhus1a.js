var penyusutan = $('#penyusutan').DataTable({
    processing: true,
    serverSide: true,
    "bPaginate": false,
    "bLengthChange": false,
    "bFilter": false,
    "bInfo": false,
    ajax: "/eform/view/penyusutan/"+spt_id,
    columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, className: "text-center align-middle"},
        {data: 'jenis_harta', name: 'jenis_harta', orderable: false, searchable: false, className: "align-middle"},
        {data: 'kelompok_harta', name: 'kelompok_harta', orderable: false, searchable: false, className: "align-middle"},
        {data: 'nama_harta', name: 'nama_harta', orderable: false, searchable: false, className: "align-middle"},
        {data: 'bulan', name: 'bulan', orderable: false, searchable: false, className: "align-middle text-center"},
        {data: 'tahun', name: 'tahun', orderable: false, searchable: false, className: "align-middle text-center"},
        {data: 'harga', name: 'harga', render: $.fn.dataTable.render.number( '.', ',', 0 ), orderable: false, searchable: false, className: "align-middle text-right"},
        {data: 'nilai_sisa', name: 'nilai_sisa', render: $.fn.dataTable.render.number( '.', ',', 0 ), orderable: false, searchable: false, className: "align-middle text-right"},
        {data: 'metode_komersial', name: 'metode_komersial', orderable: false, searchable: false, className: "align-middle"},
        {data: 'metode_fiskal', name: 'metode_fiskal', orderable: false, searchable: false, className: "align-middle"},
        {data: 'fiskal', name: 'fiskal', render: $.fn.dataTable.render.number( '.', ',', 0 ), orderable: false, searchable: false, className: "align-middle text-center"},
        {data: 'catatan', name: 'catatan', orderable: false, searchable: false, className: "align-middle"},
    ]
});

var amortisasi = $('#amortisasi').DataTable({
    processing: true,
    serverSide: true,
    "bPaginate": false,
    "bLengthChange": false,
    "bFilter": false,
    "bInfo": false,
    ajax: "/eform/view/amortisasi/"+spt_id,
    columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, className: "text-center align-middle"},
        {data: 'jenis_harta', name: 'jenis_harta', orderable: false, searchable: false, className: "align-middle"},
        {data: 'kelompok_harta', name: 'kelompok_harta', orderable: false, searchable: false, className: "align-middle"},
        {data: 'nama_harta', name: 'nama_harta', orderable: false, searchable: false, className: "align-middle"},
        {data: 'bulan', name: 'bulan', orderable: false, searchable: false, className: "align-middle text-center"},
        {data: 'tahun', name: 'tahun', orderable: false, searchable: false, className: "align-middle text-center"},
        {data: 'harga', name: 'harga', render: $.fn.dataTable.render.number( '.', ',', 0 ), orderable: false, searchable: false, className: "align-middle text-right"},
        {data: 'nilai_sisa', name: 'nilai_sisa', render: $.fn.dataTable.render.number( '.', ',', 0 ), orderable: false, searchable: false, className: "align-middle text-right"},
        {data: 'metode_komersial', name: 'metode_komersial', orderable: false, searchable: false, className: "align-middle"},
        {data: 'metode_fiskal', name: 'metode_fiskal', orderable: false, searchable: false, className: "align-middle"},
        {data: 'fiskal', name: 'fiskal', render: $.fn.dataTable.render.number( '.', ',', 0 ), orderable: false, searchable: false, className: "align-middle text-center"},
        {data: 'catatan', name: 'catatan', orderable: false, searchable: false, className: "align-middle"},
    ]
});