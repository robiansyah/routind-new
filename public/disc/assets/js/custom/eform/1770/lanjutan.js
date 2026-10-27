var numFormat = $.fn.dataTable.render.number( '.', ',', 0 ).display;
var pekerjaan = $('#pekerjaan').DataTable({
    processing: true,
    serverSide: true,
    "bPaginate": false,
    "bLengthChange": false,
    "bFilter": false,
    "bInfo": false,
    ajax: "/eform/1770/view/pekerjaan/"+spt_id,
    columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, className: "text-center align-middle"},
        {data: 'nama', name: 'nama', orderable: false, searchable: false, className: "align-middle"},
        {data: 'npwp', name: 'npwp', orderable: false, searchable: false, className: "align-middle"},
        {data: 'penghasilan', name: 'penghasilan', render: $.fn.dataTable.render.number( '.', ',', 0 ), orderable: false, searchable: false, className: "align-middle"},
        {data: 'pengurangan', name: 'pengurangan', render: $.fn.dataTable.render.number( '.', ',', 0 ), orderable: false, searchable: false, className: "align-middle"},
        {data: 'neto', name: 'neto', render: $.fn.dataTable.render.number( '.', ',', 0 ), orderable: false, searchable: false, className: "align-middle text-right"},
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
        total_pekerjaan = api
            .column(5)
            .data()
            .reduce((a, b) => intVal(a) + intVal(b), 0);
 
        // Update footer
        api.column(5).footer().innerHTML = numFormat(total_pekerjaan);
    }
});

$('#tambahPekerjaan').click(function () {
    $('#pekerjaanBtn').val("create");
    $('#pekerjaan_id').val('');
    $('#pekerjaanForm').trigger("reset");
    $('#pekerjaanHeading').html("Tambah Penghasilan Neto Dalam Negeri Sehubungan dengan Pekerjaan");
    $('#pekerjaanBtn').html('Simpan');
    $('#pekerjaanModal').modal('show');
});

$('body').on('click', '.editpekerjaan', function () {
    var pekerjaan_id = $(this).data('id');
    $.get('/eform/1770/pekerjaan/' + pekerjaan_id +'/edit', function (data) {
        $('#pekerjaanHeading').html("Edit Penghasilan Neto Dalam Negeri Sehubungan dengan Pekerjaan");
        $('#pekerjaanBtn').html('Update');
        $('#pekerjaanBtn').val("edit");
        $('#pekerjaanModal').modal('show');
        $('#pekerjaan_id').val(data.id);
        $('#nama').val(data.nama);
        $('#npwp').val(data.npwp);
        $('#penghasilan').val(data.penghasilan);
        $('#pengurangan').val(data.pengurangan);
    })
});

$('#pekerjaanBtn').click(function (e) {
    e.preventDefault();
    if($("#pekerjaanForm").valid()){
        $.ajax({
            data: $('#pekerjaanForm').serialize(),
            url: "/eform/1770/store/pekerjaan/"+spt_id,
            type: "POST",
            dataType: 'json',
            success: function (data) {
                $('#pekerjaanForm').trigger("reset");
                $('#pekerjaanModal').modal('hide');
                pekerjaan.draw();
                common.showNotif(data.success, 'success');
            },
            error: function (data) {
                common.showNotif(data, 'error');
                $('#pekerjaanBtn').html('Simpan');
            }
        });
    }
});

$('body').on('click', '.deletepekerjaan', function () {

    var pekerjaan_id = $(this).data("id");
    confirm("Apakah Anda yakin akan menghapus data ini !");
    
    $.ajax({
        type: "DELETE",
        url: '/eform/1770/pekerjaan/'+pekerjaan_id,
        success: function (data) {
            pekerjaan.draw();
            common.showNotif(data.success, 'success');
        },
        error: function (data) {
            common.showNotif(data, 'error');
        }
    });
});

$.fn.editable.defaults.mode = 'inline';

$('.xedit').editable({
    url: "/eform/1770/update/lampiran1b",
    type: 'tel',
    title: 'Update',
    success: function (response) {
        number.setVal('#peredaran_jumlah', response.peredaran_jumlah);
        number.setVal('#penghasilan_jumlah', response.penghasilan_jumlah);
        common.showNotif('Sukses', 'success');
    },
    display: function(value) {
        $(this).text(number.setText(value));
    }
});

$('.xupdate').editable({
    url: "/eform/1770/update/lampiran1d",
    type: 'tel',
    title: 'Update',
    success: function (response) {
        number.setVal('#jbd', response.jumlah);
        common.showNotif('Sukses', 'success');
    },
    display: function(value) {
        $(this).text(number.setText(value));
    }
});

$('input[type=radio][name=jenis_lapor]').change(function() {
    if (this.value == 'Pembukuan') {
        $('.pembukuan').show();
        $('.pencatatan').hide();
    }else if (this.value == 'Pencatatan') {
        $('.pembukuan').hide();
        $('.pencatatan').show();
        $('#penghasilan_dagang').editable('setValue', 0);
        $('#peredaran_dagang').editable('setValue', 0);
        $('#norma_dagang').editable('setValue', 0);
        $('#penghasilan_industri').editable('setValue', 0);
        $('#peredaran_industri').editable('setValue', 0);
        $('#norma_industri').editable('setValue', 0);
        $('#penghasilan_jasa').editable('setValue', 0);
        $('#peredaran_jasa').editable('setValue', 0);
        $('#norma_jasa').editable('setValue', 0);
        $('#penghasilan_bebas').editable('setValue', 0);
        $('#peredaran_bebas').editable('setValue', 0);
        $('#norma_bebas').editable('setValue', 0);
        $('#penghasilan_lainnya').editable('setValue', 0);
        $('#peredaran_lainnya').editable('setValue', 0);
        $('#norma_lainnya').editable('setValue', 0);
        $('#peredaran_jumlah').val(0)
        $('#penghasilan_jumlah').val(0)
    }
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
    

