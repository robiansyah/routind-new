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
        {data: 'action', name: 'action', orderable: false, searchable: false, className: "text-center"},
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

$('#tambahHarta').click(function () {
    $('#hartaBtn').val("create");
    $('#harta_id').val('');
    $('#hartaForm').trigger("reset");
    $('#hartaHeading').html("Tambah Harta");
    $('#hartaBtn').html('Simpan');
    $('#hartaModal').modal('show');
});

$('body').on('click', '.editharta', function () {
    var harta_id = $(this).data('id');
    $.get('/eform/1770/harta/' + harta_id +'/edit', function (data) {
        $('#hartaHeading').html("Edit Harta");
        $('#hartaBtn').html('Update');
        $('#hartaBtn').val("edit");
        $('#hartaModal').modal('show');
        $('#harta_id').val(data.id);
        $('#kodeHarta').val(data.kodeHarta).change();
        $('#jnsHarta').val(data.jnsHarta);
        $('#thPerolehan').val(data.thPerolehan);
        $('#harga').val(data.harga);
        $('#ket').val(data.ket);
    })
});

$('#hartaBtn').click(function (e) {
    e.preventDefault();
    if($("#hartaForm").valid()){
        $.ajax({
            data: $('#hartaForm').serialize(),
            url: "/eform/1770/store/harta/"+spt_id,
            type: "POST",
            dataType: 'json',
            success: function (data) {
                $('#hartaForm').trigger("reset");
                $('#hartaModal').modal('hide')
                harta.draw();
                common.showNotif(data.success, 'success');
            },
            error: function (data) {
                common.showNotif(data, 'error');
                $('#hartaBtn').html('Simpan');
            }
        });
    }
});

$('body').on('click', '.deleteharta', function () {

    var harta_id = $(this).data("id");
    confirm("Apakah Anda yakin akan menghapus data ini !");
    
    $.ajax({
        type: "DELETE",
        url: '/eform/1770/harta/'+harta_id,
        success: function (data) {
            harta.draw();
            common.showNotif(data.success, 'success');
        },
        error: function (data) {
            common.showNotif(data, 'error');
        }
    });
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
        {data: 'action', name: 'action', orderable: false, searchable: false, className: "text-center"},
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

$('#tambahUtang').click(function () {
    $('#utangBtn').val("create");
    $('#utang_id').val('');
    $('#utangForm').trigger("reset");
    $('#utangHeading').html("Tambah Utang Dari Pemegang Saham Dan/Atau Perusahaan Afiliasi");
    $('#utangBtn').html('Simpan');
    $('#utangModal').modal('show');
});

$('body').on('click', '.editutang', function () {
    var utang_id = $(this).data('id');
    $.get('/eform/1770/utang/' + utang_id +'/edit', function (data) {
        $('#utangHeading').html("Edit Utang Dari Pemegang Saham Dan/Atau Perusahaan Afiliasi");
        $('#utangBtn').html('Update');
        $('#utangBtn').val("edit");
        $('#utangModal').modal('show');
        $('#utang_id').val(data.id);
        $('#kodeUtang').val(data.kodeUtang).change();
        $('#nmPbrPinjam').val(data.nmPbrPinjam);
        $('#almtPbrPinjam').val(data.almtPbrPinjam);
        $('#thPinjam').val(data.thPinjam);
        $('#jmlPinjam').val(data.jmlPinjam);
    })
});

$('#utangBtn').click(function (e) {
    e.preventDefault();
    if($("#utangForm").valid()){
        $.ajax({
            data: $('#utangForm').serialize(),
            url: "/eform/1770/store/utang/"+spt_id,
            type: "POST",
            dataType: 'json',
            success: function (data) {
                $('#utangForm').trigger("reset");
                $('#utangModal').modal('hide')
                utang.draw();
                common.showNotif(data.success, 'success');
            },
            error: function (data) {
                common.showNotif(data, 'error');
                $('#utangBtn').html('Simpan');
            }
        });
    }
});

$('body').on('click', '.deleteutang', function () {

    var utang_id = $(this).data("id");
    confirm("Apakah Anda yakin akan menghapus data ini !");
    
    $.ajax({
        type: "DELETE",
        url: '/eform/1770/utang/'+utang_id,
        success: function (data) {
            utang.draw();
            common.showNotif(data.success, 'success');
        },
        error: function (data) {
            common.showNotif(data, 'error');
        }
    });
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
        {data: 'action', name: 'action', orderable: false, searchable: false, className: "text-center"},
    ]
});

$('#tambahKeluarga').click(function () {
    $('#keluargaBtn').val("create");
    $('#keluarga_id').val('');
    $('#keluargaForm').trigger("reset");
    $('#keluargaHeading').html("Tambah Keluarga");
    $('#keluargaBtn').html('Simpan');
    $('#keluargaModal').modal('show');
});

$('body').on('click', '.editkeluarga', function () {
    var keluarga_id = $(this).data('id');
    $.get('/eform/1770/keluarga/' + keluarga_id +'/edit', function (data) {
        $('#keluargaHeading').html("Edit Keluarga");
        $('#keluargaBtn').html('Update');
        $('#keluargaBtn').val("edit");
        $('#keluargaModal').modal('show');
        $('#keluarga_id').val(data.id);
        $('#nmAgKel').val(data.nmAgKel);
        $('#nik').val(data.nik);
        $('#hubKel').val(data.hubKel);
        $('#kerja').val(data.kerja);
    })
});

$('#keluargaBtn').click(function (e) {
    e.preventDefault();
    if($("#keluargaForm").valid()){
        $.ajax({
            data: $('#keluargaForm').serialize(),
            url: "/eform/1770/store/keluarga/"+spt_id,
            type: "POST",
            dataType: 'json',
            success: function (data) {
                $('#keluargaForm').trigger("reset");
                $('#keluargaModal').modal('hide')
                keluarga.draw();
                common.showNotif(data.success, 'success');
            },
            error: function (data) {
                common.showNotif(data, 'error');
                $('#keluargaBtn').html('Simpan');
            }
        });
    }
});

$('body').on('click', '.deletekeluarga', function () {

    var keluarga_id = $(this).data("id");
    confirm("Apakah Anda yakin akan menghapus data ini !");
    
    $.ajax({
        type: "DELETE",
        url: '/eform/1770/keluarga/'+keluarga_id,
        success: function (data) {
            keluarga.draw();
            common.showNotif(data.success, 'success');
        },
        error: function (data) {
            common.showNotif(data, 'error');
        }
    });
});

$('input[type=radio][name=jenis_lapor]').change(function() {
    $.ajax({
        data: {jenis_lapor: this.value, type: 'jenis_lapor'},
        url: "/eform/1770/store/jenis_lapor/"+spt_id,
        type: "POST",
        dataType: 'json',
        success: function (data) {
            common.showNotif(data.success, 'success');
        },
    });
});