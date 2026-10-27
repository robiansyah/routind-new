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
        {data: 'action', name: 'action', orderable: false, searchable: false, className: "text-center"},
    ]
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
    $.get('/eform/utang/' + utang_id +'/edit', function (data) {
        $('#utangHeading').html("Edit Utang Dari Pemegang Saham Dan/Atau Perusahaan Afiliasi");
        $('#utangBtn').html('Update');
        $('#utangBtn').val("edit");
        $('#utangModal').modal('show');
        $('#utang_id').val(data.id);
        $('#unama').val(data.nama);
        $('#unpwp').val(data.npwp);
        $('#ujumlah').val(data.jumlah);
        $('#utahun').val(data.tahun);
        $('#ubunga').val(data.bunga);
    })
});

$('#utangBtn').click(function (e) {
    e.preventDefault();
    if($("#utangForm").valid()){
        $.ajax({
            data: $('#utangForm').serialize(),
            url: "/eform/store/utang/"+spt_id,
            type: "POST",
            dataType: 'json',
            success: function (data) {
                $('#utangForm').trigger("reset");
                $('#utangModal').modal('hide');
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
        url: '/eform/utang/'+utang_id,
        success: function (data) {
            utang.draw();
            common.showNotif(data.success, 'success');
        },
        error: function (data) {
            common.showNotif(data, 'error');
        }
    });
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
        {data: 'action', name: 'action', orderable: false, searchable: false, className: "text-center"},
    ]
});

$('#tambahPiutang').click(function () {
    $('#piutangBtn').val("create");
    $('#piutang_id').val('');
    $('#piutangForm').trigger("reset");
    $('#piutangHeading').html("Tambah Piutang Dari Pemegang Saham Dan/Atau Perusahaan Afiliasi");
    $('#piutangBtn').html('Simpan');
    $('#piutangModal').modal('show');
});

$('body').on('click', '.editpiutang', function () {
    var piutang_id = $(this).data('id');
    $.get('/eform/piutang/' + piutang_id +'/edit', function (data) {
        $('#piutangHeading').html("Edit Piutang Dari Pemegang Saham Dan/Atau Perusahaan Afiliasi");
        $('#piutangBtn').html('Update');
        $('#piutangBtn').val("edit");
        $('#piutangModal').modal('show');
        $('#piutang_id').val(data.id);
        $('#pnama').val(data.nama);
        $('#pnpwp').val(data.npwp);
        $('#pjumlah').val(data.jumlah);
        $('#ptahun').val(data.tahun);
        $('#pbunga').val(data.bunga);
    })
});

$('#piutangBtn').click(function (e) {
    e.preventDefault();
    if($("#piutangForm").valid()){
        $.ajax({
            data: $('#piutangForm').serialize(),
            url: "/eform/store/piutang/"+spt_id,
            type: "POST",
            dataType: 'json',
            success: function (data) {
                $('#piutangForm').trigger("reset");
                $('#piutangModal').modal('hide');
                piutang.draw();
                common.showNotif(data.success, 'success');
            },
            error: function (data) {
                common.showNotif(data, 'error');
                $('#piutangBtn').html('Simpan');
            }
        });
    }
});

$('body').on('click', '.deletepiutang', function () {

    var piutang_id = $(this).data("id");
    confirm("Apakah Anda yakin akan menghapus data ini !");
    
    $.ajax({
        type: "DELETE",
        url: '/eform/piutang/'+piutang_id,
        success: function (data) {
            piutang.draw();
            common.showNotif(data.success, 'success');
        },
        error: function (data) {
            common.showNotif(data, 'error');
        }
    });
});