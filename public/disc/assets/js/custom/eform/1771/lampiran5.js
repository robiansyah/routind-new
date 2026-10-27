var numFormat = $.fn.dataTable.render.number( '.', ',', 0 ).display;
var pemegang = $('#pemegang').DataTable({
    processing: true,
    serverSide: true,
    "bPaginate": false,
    "bLengthChange": false,
    "bFilter": false,
    "bInfo": false,
    ajax: "/eform/view/pemegang/"+spt_id,
    columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, className: "text-center align-middle"},
        {data: 'nama', name: 'nama', orderable: false, searchable: false, className: "align-middle"},
        {data: 'alamat', name: 'alamat', orderable: false, searchable: false, className: "align-middle"},
        {data: 'npwp', name: 'npwp', orderable: false, searchable: false, className: "align-middle"},
        {data: 'modal', name: 'modal', render: $.fn.dataTable.render.number( '.', ',', 0 ), orderable: false, searchable: false, className: "align-middle text-right"},
        {data: 'persen', name: 'persen', orderable: false, searchable: false, className: "align-middle text-center"},
        {data: 'dividen', name: 'dividen', render: $.fn.dataTable.render.number( '.', ',', 0 ), orderable: false, searchable: false, className: "align-middle text-right"},
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
        total_modal = api
            .column(4)
            .data()
            .reduce((a, b) => intVal(a) + intVal(b), 0);
        
        total_persen = api
            .column(5)
            .data()
            .reduce((a, b) => intVal(a) + intVal(b), 0);

        total_dividen = api
            .column(6)
            .data()
            .reduce((a, b) => intVal(a) + intVal(b), 0);
 
        // Update footer
        api.column(4).footer().innerHTML = numFormat(total_modal);
        api.column(5).footer().innerHTML = total_persen;
        api.column(6).footer().innerHTML = numFormat(total_dividen);
    }
});

$('#tambahPemegang').click(function () {
    $('#pemegangBtn').val("create");
    $('#pemegang_id').val('');
    $('#pemegangForm').trigger("reset");
    $('#pemegangHeading').html("Tambah Pemegang Saham/Pemilik Modal Dan Jumlah Dividen Yang Dibagikan");
    $('#pemegangBtn').html('Simpan');
    $('#pemegangModal').modal('show');
});

$('body').on('click', '.editpemegang', function () {
    var pemegang_id = $(this).data('id');
    $.get('/eform/pemegang/' + pemegang_id +'/edit', function (data) {
        $('#pemegangHeading').html("Edit Pemegang Saham/Pemilik Modal Dan Jumlah Dividen Yang Dibagikan");
        $('#pemegangBtn').html('Update');
        $('#pemegangBtn').val("edit");
        $('#pemegangModal').modal('show');
        $('#pemegang_id').val(data.id);
        $('#nama').val(data.nama);
        $('#npwp').val(data.npwp);
        $('#alamat').val(data.alamat);
        $('#modal').val(data.modal);
        $('#persen').val(data.persen);
        $('#dividen').val(data.dividen);
    })
});

$('#pemegangBtn').click(function (e) {
    e.preventDefault();
    if($("#pemegangForm").valid()){
        $.ajax({
            data: $('#pemegangForm').serialize(),
            url: "/eform/store/pemegang/"+spt_id,
            type: "POST",
            dataType: 'json',
            success: function (data) {
                $('#pemegangForm').trigger("reset");
                $('#pemegangModal').modal('hide');
                pemegang.draw();
                common.showNotif(data.success, 'success');
            },
            error: function (data) {
                common.showNotif(data, 'error');
                $('#pemegangBtn').html('Simpan');
            }
        });
    }
});

$('body').on('click', '.deletepemegang', function () {

    var pemegang_id = $(this).data("id");
    confirm("Apakah Anda yakin akan menghapus data ini !");
    
    $.ajax({
        type: "DELETE",
        url: '/eform/pemegang/'+pemegang_id,
        success: function (data) {
            pemegang.draw();
            common.showNotif(data.success, 'success');
        },
        error: function (data) {
            common.showNotif(data, 'error');
        }
    });
});

var pengurus = $('#pengurus').DataTable({
    processing: true,
    serverSide: true,
    "bPaginate": false,
    "bLengthChange": false,
    "bFilter": false,
    "bInfo": false,
    ajax: "/eform/view/pengurus/"+spt_id,
    columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, className: "text-center align-middle"},
        {data: 'nama', name: 'nama', orderable: false, searchable: false, className: "align-middle"},
        {data: 'alamat', name: 'alamat', orderable: false, searchable: false, className: "align-middle"},
        {data: 'npwp', name: 'npwp', orderable: false, searchable: false, className: "align-middle"},
        {data: 'jabatan', name: 'jabatan', orderable: false, searchable: false, className: "align-middle"},
        {data: 'action', name: 'action', orderable: false, searchable: false, className: "text-center"},
    ]
});

$('#tambahPengurus').click(function () {
    $('#pengurusBtn').val("create");
    $('#pengurus_id').val('');
    $('#pengurusForm').trigger("reset");
    $('#pengurusHeading').html("Tambah Pengurus dan Komisaris");
    $('#pengurusBtn').html('Simpan');
    $('#pengurusModal').modal('show');
});

$('body').on('click', '.editpengurus', function () {
    var pengurus_id = $(this).data('id');
    $.get('/eform/pengurus/' + pengurus_id +'/edit', function (data) {
        $('#pengurusHeading').html("Edit Pengurus dan Komisaris");
        $('#pengurusBtn').html('Update');
        $('#pengurusBtn').val("edit");
        $('#pengurusModal').modal('show');
        $('#pengurus_id').val(data.id);
        $('#pnama').val(data.nama);
        $('#pnpwp').val(data.npwp);
        $('#palamat').val(data.alamat);
        $('#pjabatan').val(data.jabatan);
    })
});

$('#pengurusBtn').click(function (e) {
    e.preventDefault();
    if($("#pengurusForm").valid()){
        $.ajax({
            data: $('#pengurusForm').serialize(),
            url: "/eform/store/pengurus/"+spt_id,
            type: "POST",
            dataType: 'json',
            success: function (data) {
                $('#pengurusForm').trigger("reset");
                $('#pengurusModal').modal('hide');
                pengurus.draw();
                common.showNotif(data.success, 'success');
            },
            error: function (data) {
                common.showNotif(data, 'error');
                $('#pengurusBtn').html('Simpan');
            }
        });
    }
});

$('body').on('click', '.deletepengurus', function () {

    var pengurus_id = $(this).data("id");
    confirm("Apakah Anda yakin akan menghapus data ini !");
    
    $.ajax({
        type: "DELETE",
        url: '/eform/pengurus/'+pengurus_id,
        success: function (data) {
            pengurus.draw();
            common.showNotif(data.success, 'success');
        },
        error: function (data) {
            common.showNotif(data, 'error');
        }
    });
});