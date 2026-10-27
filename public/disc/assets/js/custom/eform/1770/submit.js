var numFormat = $.fn.dataTable.render.number( '.', ',', 0 ).display;
var setor = $('#setor').DataTable({
    processing: true,
    serverSide: true,
    "bPaginate": false,
    "bLengthChange": false,
    "bFilter": false,
    "bInfo": false,
    ajax: "/eform/1770/view/setor/"+spt_id,
    columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, className: "text-center align-middle"},
        {data: 'kode_map', name: 'kode_map', orderable: false, searchable: false, className: "align-middle"},
        {data: 'kode_jenis', name: 'kode_jenis', orderable: false, searchable: false, className: "align-middle"},
        {data: 'tanggal', name: 'tanggal', orderable: false, searchable: false, className: "align-middle"},
        {data: 'bayar', name: 'bayar', render: $.fn.dataTable.render.number( '.', ',', 0 ), orderable: false, searchable: false, className: "align-middle text-center"},
        {data: 'ntpn', name: 'ntpn', orderable: false, searchable: false, className: "align-middle"},
        {data: 'action', name: 'action', orderable: false, searchable: false, className: "text-center"},
    ]
});

$('#tambahSetor').click(function () {
    $('#setorBtn').val("create");
    $('#setor_id').val('');
    $('#setorForm').trigger("reset");
    $('#setorHeading').html("Tambah Bukti Bayar");
    $('#setorBtn').html('Simpan');
    $('#setorModal').modal('show');
});

$('body').on('click', '.editsetor', function () {
    var setor_id = $(this).data('id');
    $.get('/eform/1770/setor/' + setor_id +'/edit', function (data) {
        $('#setorHeading').html("Edit Bukti Setor");
        $('#setorBtn').html('Update');
        $('#setorBtn').val("edit");
        $('#setorModal').modal('show');
        $('#setor_id').val(data.id);
        $('#kode_map').val(data.kode_map);
        $('#kode_jenis').val(data.kode_jenis);
        $('#tanggal').val(data.tanggal);
        $('#bayar').val(data.bayar);
        $('#ntpn').val(data.ntpn);
    })
});

$('#setorBtn').click(function (e) {
    e.preventDefault();
    if($("#setorForm").valid()){
        $.ajax({
            data: $('#setorForm').serialize(),
            url: "/eform/1770/store/setor/"+spt_id,
            type: "POST",
            dataType: 'json',
            success: function (data) {
                $('#setorForm').trigger("reset");
                $('#setorModal').modal('hide');
                common.showNotif(data.success, 'success');
                number.setVal('#pembayaran', data.pembayaran);
                setor.draw();
                common.showNotif(data.success, 'success');
                checking();
            },
            error: function (data) {
                common.showNotif(data, 'error');
                $('#setorBtn').html('Simpan');
            }
        });
    }
});

$('body').on('click', '.deletesetor', function () {

    var setor_id = $(this).data("id");
    confirm("Apakah Anda yakin akan menghapus data ini !");

    $.ajax({
        type: "DELETE",
        url: '/eform/1770/setor/'+setor_id,
        success: function (data) {
            common.showNotif(data.success, 'success');
            number.setVal('#pembayaran', data.pembayaran);
            setor.draw();
            common.showNotif(data.success, 'success');
            checking();
        },
        error: function (data) {
            common.showNotif(data, 'error');
        }
    });
});

$(document).ready(function () {
    checking();
});

function checking() {
    var pembayaran = number.getVal('#pembayaran');
    var kurang = number.getVal('#kurang');

    if(pembayaran>=kurang){
        $('#submit').removeAttr("disabled");
        $('#kurang_bayar').text('');
    }else{
        $('#submit').attr("disabled", "disabled");
        $('#kurang_bayar').text('Jumlah Setor Lebih Kecil dari Kurang Bayar, Silakan Tambah Setoran');
    }
}


