var numFormat = $.fn.dataTable.render.number( '.', ',', 0 ).display;
var pemotongan = $('#pemotongan').DataTable({
    processing: true,
    serverSide: true,
    "bPaginate": false,
    "bLengthChange": false,
    "bFilter": false,
    "bInfo": false,
    ajax: "/eform/view/pemotongan/"+spt_id,
    columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, className: "text-center align-middle"},
        {data: 'nama', name: 'nama', orderable: false, searchable: false, className: "align-middle"},
        {data: 'npwp', name: 'npwp', orderable: false, searchable: false, className: "align-middle"},
        {data: 'jenis', name: 'jenis', orderable: false, searchable: false, className: "align-middle"},
        {data: 'potongan', name: 'potongan', render: $.fn.dataTable.render.number( '.', ',', 0 ), orderable: false, searchable: false, className: "align-middle text-center"},
        {data: 'pph', name: 'pph', render: $.fn.dataTable.render.number( '.', ',', 0 ), orderable: false, searchable: false, className: "align-middle text-center"},
        {data: 'no_bukti', name: 'no_bukti', orderable: false, searchable: false, className: "align-middle"},
        {data: 'tanggal', name: 'tanggal', orderable: false, searchable: false, className: "align-middle"},
        {data: 'alamat', name: 'alamat', orderable: false, searchable: false, className: "align-middle"},
        {data: 'ntpn', name: 'ntpn', orderable: false, searchable: false, className: "align-middle"},
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
            .column(5)
            .data()
            .reduce((a, b) => intVal(a) + intVal(b), 0);
 
        // Update footer
        api.column(5).footer().innerHTML = numFormat(total);
    }
});

$('#tambahPemotongan').click(function () {
    $('#pemotonganBtn').val("create");
    $('#pemotongan_id').val('');
    $('#pemotonganForm').trigger("reset");
    $('#pemotonganHeading').html("Tambah Pemotongan/Pemungutan PPh Pasal 22, 23/26");
    $('#pemotonganBtn').html('Simpan');
    $('#pemotonganModal').modal('show');
});

$('body').on('click', '.editpemotongan', function () {
    var pemotongan_id = $(this).data('id');
    $.get('/eform/pemotongan/' + pemotongan_id +'/edit', function (data) {
        $('#pemotonganHeading').html("Edit Pemotongan/Pemungutan PPh Pasal 22, 23/26");
        $('#pemotonganBtn').html('Update');
        $('#pemotonganBtn').val("edit-user");
        $('#pemotonganModal').modal('show');
        $('#pemotongan_id').val(data.id);
        $('#nama').val(data.nama);
        $('#npwp').val(data.npwp);
        $('#jenis').val(data.jenis).change();
        $('#potongan').val(data.potongan);
        $('#pph').val(data.pph);
        $('#no_bukti').val(data.no_bukti);
        $('#tanggal').val(data.tanggal);
        $('#alamat').val(data.alamat);
        $('#ntpn').val(data.ntpn);
    })
});

$('#pemotonganBtn').click(function (e) {
    e.preventDefault();
    if($("#pemotonganForm").valid()){
        $.ajax({
            data: $('#pemotonganForm').serialize(),
            url: "/eform/store/pemotongan/"+spt_id,
            type: "POST",
            dataType: 'json',
            success: function (data) {
                $('#pemotonganForm').trigger("reset");
                $('#pemotonganModal').modal('hide');
                common.showNotif(data.success, 'success');
                pemotongan.draw();
                common.showNotif(data.success, 'success');
            },
            error: function (data) {
                common.showNotif(data, 'error');
                $('#pemotonganBtn').html('Simpan');
            }
        });
    }
});

$('body').on('click', '.deletepemotongan', function () {

    var pemotongan_id = $(this).data("id");
    confirm("Apakah Anda yakin akan menghapus data ini !");
    
    $.ajax({
        type: "DELETE",
        url: '/eform/pemotongan/'+pemotongan_id,
        success: function (data) {
            pemotongan.draw();
            common.showNotif(data.success, 'success');
        },
        error: function (data) {
            common.showNotif(data, 'error');
        }
    });
});
