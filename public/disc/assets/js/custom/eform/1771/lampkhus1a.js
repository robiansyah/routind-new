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
        {data: 'action', name: 'action', orderable: false, searchable: false, className: "text-center"},
    ]
});

$('#tambahPenyusutan').click(function () {
    $('#penyusutanBtn').val("create");
    $('#penyusutan_id').val('');
    $('#penyusutanForm').trigger("reset");
    $('#penyusutanHeading').html("Tambah Penyusutan Fiskal");
    $('#penyusutanBtn').html('Simpan');
    $('#penyusutanModal').modal('show');
});

$('body').on('click', '.editpenyusutan', function () {
    var penyusutan_id = $(this).data('id');
    $.get('/eform/penyusutan/' + penyusutan_id +'/edit', function (data) {
        $('#penyusutanHeading').html("Edit Penyusutan Fiskal");
        $('#penyusutanBtn').html('Update');
        $('#penyusutanBtn').val("edit-user");
        $('#penyusutanModal').modal('show');
        $('#penyusutan_id').val(data.id);
        $('#nama_harta').val(data.nama_harta);
        $('#jenis_harta').val(data.jenis_harta).change();
        $('#kelompok_harta').val(data.kelompok_harta).change();
        $('#tahun').val(data.tahun);
        $('#bulan').val(data.bulan).change();
        $('#metode_komersial').val(data.metode_komersial).change();
        $('#metode_fiskal').val(data.metode_fiskal).change();
        $('#harga').val(data.harga);
        $('#nilai_sisa').val(data.nilai_sisa);
        $('#fiskal').val(data.fiskal);
        $('#catatan').val(data.catatan);
    })
});

$('#penyusutanBtn').click(function (e) {
    e.preventDefault();
    if($("#penyusutanForm").valid()){
        $.ajax({
            data: $('#penyusutanForm').serialize(),
            url: "/eform/store/penyusutan/"+spt_id,
            type: "POST",
            dataType: 'json',
            success: function (data) {
                $('#penyusutanForm').trigger("reset");
                $('#penyusutanModal').modal('hide');
                penyusutan.draw();
                common.showNotif(data.success, 'success');
                number.setVal('#penyusutan_fiskal', data.fiskal);
                number.setVal('#selisih_penyusutan', data.selisih);
            },
            error: function (data) {
                common.showNotif(data, 'error');
                $('#penyusutanBtn').html('Simpan');
            }
        });
    }
});

$('body').on('click', '.deletepenyusutan', function () {

    var penyusutan_id = $(this).data("id");
    confirm("Apakah Anda yakin akan menghapus data ini !");
    
    $.ajax({
        type: "DELETE",
        url: '/eform/penyusutan/'+penyusutan_id,
        success: function (data) {
            penyusutan.draw();
            common.showNotif(data.success, 'success');
            number.setVal('#penyusutan_fiskal', data.fiskal);
            number.setVal('#selisih_penyusutan', data.selisih);
        },
        error: function (data) {
            common.showNotif(data, 'error');
        }
    });
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
        {data: 'action', name: 'action', orderable: false, searchable: false, className: "text-center"},
    ]
});

$('#tambahAmortisasi').click(function () {
    $('#amortisasiBtn').val("create");
    $('#amortisasi_id').val('');
    $('#amortisasiForm').trigger("reset");
    $('#amortisasiHeading').html("Tambah Amortisasi Fiskal");
    $('#amortisasiBtn').html('Simpan');
    $('#amortisasiModal').modal('show');
});

$('body').on('click', '.editamortisasi', function () {
    var amortisasi_id = $(this).data('id');
    $.get('/eform/amortisasi/' + amortisasi_id +'/edit', function (data) {
        $('#amortisasiHeading').html("Edit Amortisasi Fiskal");
        $('#amortisasiBtn').html('Update');
        $('#amortisasiBtn').val("edit-user");
        $('#amortisasiModal').modal('show');
        $('#amortisasi_id').val(data.id);
        $('#mnama_harta').val(data.nama_harta);
        $('#mjenis_harta').val(data.jenis_harta).change();
        $('#mkelompok_harta').val(data.kelompok_harta).change();
        $('#mtahun').val(data.tahun);
        $('#mbulan').val(data.bulan).change();
        $('#mmetode_komersial').val(data.metode_komersial).change();
        $('#mmetode_fiskal').val(data.metode_fiskal).change();
        $('#mharga').val(data.harga);
        $('#mnilai_sisa').val(data.nilai_sisa);
        $('#mfiskal').val(data.fiskal);
        $('#mcatatan').val(data.catatan);
    })
});

$('#amortisasiBtn').click(function (e) {
    e.preventDefault();
    if($("#amortisasiForm").valid()){
        $.ajax({
            data: $('#amortisasiForm').serialize(),
            url: "/eform/store/amortisasi/"+spt_id,
            type: "POST",
            dataType: 'json',
            success: function (data) {
                $('#amortisasiForm').trigger("reset");
                $('#amortisasiModal').modal('hide');
                amortisasi.draw();
                common.showNotif(data.success, 'success');
                number.setVal('#amortisasi_fiskal', data.fiskal);
                number.setVal('#selisih_amortisasi', data.selisih);
            },
            error: function (data) {
                common.showNotif(data, 'error');
                $('#amortisasiBtn').html('Simpan');
            }
        });
    }
});

$('body').on('click', '.deleteamortisasi', function () {

    var amortisasi_id = $(this).data("id");
    confirm("Apakah Anda yakin akan menghapus data ini !");
    
    $.ajax({
        type: "DELETE",
        url: '/eform/amortisasi/'+amortisasi_id,
        success: function (data) {
            common.showNotif(data.success, 'success');
            amortisasi.draw();
        },
        error: function (data) {
            common.showNotif(data, 'error');
        }
    });
});


$.fn.editable.defaults.mode = 'inline';

$('.xedit').editable({
    url: "/eform/update/lampkhus1a",
    type: 'tel',
    title: 'Update',
    success: function (response) {
        console.log(response);
        var column = response.column;
        number.setVal('#'+column+'_fiskal', response.fiskal);
        number.setVal('#selisih_'+column, response.selisih);
        common.showNotif('Sukses', 'success');
        
    },
    display: function(value) {
        $(this).text(number.setText(value));
    } 
});