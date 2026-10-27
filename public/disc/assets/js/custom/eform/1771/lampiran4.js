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
        total_penghasilan = api
            .column(4)
            .data()
            .reduce((a, b) => intVal(a) + intVal(b), 0);
 
        // Update footer
        api.column(4).footer().innerHTML = numFormat(total_penghasilan);
    }
});

$('#tambahPenghasilan').click(function () {
    $('#penghasilanBtn').val("create");
    $('#penghasilan_id').val('');
    $('#penghasilanForm').trigger("reset");
    $('#penghasilanHeading').html("Tambah Penghasilan Lainnya");
    $('#penghasilanBtn').html('Simpan');
    $('#penghasilanModal').modal('show');
});

$('body').on('click', '.editpenghasilan', function () {
    var penghasilan_id = $(this).data('id');
    $.get('/eform/penghasilan/' + penghasilan_id +'/edit', function (data) {
        $('#penghasilanHeading').html("Edit Penghasilan Lainnya");
        $('#penghasilanBtn').html('Update');
        $('#penghasilanBtn').val("edit");
        $('#penghasilanModal').modal('show');
        $('#penghasilan_id').val(data.id);
        $('#jenis').val(data.jenis);
        $('#pajak').val(data.pajak);
        $('#tarif').val(data.tarif);
    })
});

$('#penghasilanBtn').click(function (e) {
    e.preventDefault();
    if($("#penghasilanForm").valid()){
        $.ajax({
            data: $('#penghasilanForm').serialize(),
            url: "/eform/store/penghasilan/"+spt_id,
            type: "POST",
            dataType: 'json',
            success: function (data) {
                $('#penghasilanForm').trigger("reset");
                $('#penghasilanModal').modal('hide');
                penghasilan.draw();
                common.showNotif(data.success, 'success');
                hitungA(data.total);
            },
            error: function (data) {
                common.showNotif(data, 'error');
                $('#penghasilanBtn').html('Simpan');
            }
        });
    }
});

$('body').on('click', '.deletepenghasilan', function () {

    var penghasilan_id = $(this).data("id");
    confirm("Apakah Anda yakin akan menghapus data ini !");
    
    $.ajax({
        type: "DELETE",
        url: '/eform/penghasilan/'+penghasilan_id,
        success: function (data) {
            penghasilan.draw();
            common.showNotif(data.success, 'success');
            hitungA(data.total);
        },
        error: function (data) {
            common.showNotif(data, 'error');
        }
    });
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
        total_lainnya = api
            .column(2)
            .data()
            .reduce((a, b) => intVal(a) + intVal(b), 0);
 
        // Update footer
        api.column(2).footer().innerHTML = numFormat(total_lainnya);
    }
});

$('#tambahLainnya').click(function () {
    $('#lainnyaBtn').val("create");
    $('#lainnya_id').val('');
    $('#lainnyaForm').trigger("reset");
    $('#lainnyaHeading').html("Tambah Penghasilan Lainnya");
    $('#lainnyaBtn').html('Simpan');
    $('#lainnyaModal').modal('show');
});

$('body').on('click', '.editlainnya', function () {
    var lainnya_id = $(this).data('id');
    $.get('/eform/lainnya/' + lainnya_id +'/edit', function (data) {
        $('#lainnyaHeading').html("Edit Penghasilan Lainnya");
        $('#lainnyaBtn').html('Update');
        $('#lainnyaBtn').val("edit");
        $('#lainnyaModal').modal('show');
        $('#lainnya_id').val(data.id);
        $('#ljenis').val(data.jenis);
        $('#lpenghasilan').val(data.penghasilan);
    })
});

$('#lainnyaBtn').click(function (e) {
    e.preventDefault();
    if($("#lainnyaForm").valid()){
        $.ajax({
            data: $('#lainnyaForm').serialize(),
            url: "/eform/store/lainnya/"+spt_id,
            type: "POST",
            dataType: 'json',
            success: function (data) {
                $('#lainnyaForm').trigger("reset");
                $('#lainnyaModal').modal('hide');
                lainnya.draw();
                common.showNotif(data.success, 'success');
                hitungB(data.total);
            },
            error: function (data) {
                common.showNotif(data, 'error');
                $('#lainnyaBtn').html('Simpan');
            }
        });
    }
});

$('body').on('click', '.deletelainnya', function () {

    var lainnya_id = $(this).data("id");
    confirm("Apakah Anda yakin akan menghapus data ini !");
    
    $.ajax({
        type: "DELETE",
        url: '/eform/lainnya/'+lainnya_id,
        success: function (data) {
            lainnya.draw();
            common.showNotif(data.success, 'success');
            hitungB(data.total);
        },
        error: function (data) {
            common.showNotif(data, 'error');
        }
    });
});

$.fn.editable.defaults.mode = 'inline';

$('.xedit').editable({
    url: "/eform/update/lampiran4a",
    type: 'tel',
    title: 'Update',
    success: function (response) {
        var column = response.column;
        var pph = (response.pajak*response.pph)/100;
        number.setVal('#'+column, pph);
        number.setVal('#terutang', response.jumlah);
        common.showNotif('Sukses', 'success');
        hitungA(total_penghasilan);
    },
    display: function(value) {
        $(this).text(number.setText(value));
    }
});

$('.xpph').editable({
    url: "/eform/update/lampiran4a",
    type: 'tel',
    title: 'Update',
    success: function (response) {
        var column = response.column;
        var pph = (response.pajak*response.pph)/100;
        number.setVal('#'+column, pph);
        number.setVal('#terutang', response.jumlah);
        common.showNotif('Sukses', 'success');
        hitungA(total_penghasilan);
    }
});

$('.xupdate').editable({
    url: "/eform/update/lampiran4b",
    type: 'tel',
    title: 'Update',
    success: function (response) {
        number.setVal('#jbb', response.jumlah);
        common.showNotif('Sukses', 'success');
        hitungB(total_lainnya);
    },
    display: function(value) {
        $(this).text(number.setText(value));
    }
});

function hitungA(total){
    var terutang = number.getVal('#terutang');
    number.setVal('#total_a', parseInt(terutang)+parseInt(total));
}

function hitungB(total){
    var jbb = number.getVal('#jbb');
    number.setVal('#total_b', parseInt(jbb)+parseInt(total));
}
    

