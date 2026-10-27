var numFormat = $.fn.dataTable.render.number( '.', ',', 0 ).display;
var bupot = $('#bupot').DataTable({
    processing: true,
    serverSide: true,
    "bPaginate": false,
    "bLengthChange": false,
    "bFilter": false,
    "bInfo": false,
    ajax: "/eform/1770/view/bupot/"+spt_id,
    columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, className: "text-center align-middle"},
        {data: 'nama', name: 'nama', orderable: false, searchable: false, className: "align-middle text-center"},
        {data: 'npwp', name: 'npwp', orderable: false, searchable: false, className: "align-middle"},
        {data: 'nomor', name: 'nomor', orderable: false, searchable: false, className: "align-middle text-center"},
        {data: 'tanggal', name: 'tanggal', orderable: false, searchable: false, className: "align-middle text-center"},
        {data: 'jenis', name: 'jenis', orderable: false, searchable: false, className: "align-middle text-center"},
        {data: 'pph', name: 'pph', render: $.fn.dataTable.render.number( '.', ',', 0 ), orderable: false, searchable: false, className: "align-middle text-right"},
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
            .column(6)
            .data()
            .reduce((a, b) => intVal(a) + intVal(b), 0);
 
        // Update footer
        api.column(6).footer().innerHTML = numFormat(total);
    }
});

$('#tambahBupot').click(function () {
    $('#bupotBtn').val("create");
    $('#bupot_id').val('');
    $('#bupotForm').trigger("reset");
    $('#bupotHeading').html("Tambah Bukti Potong");
    $('#bupotBtn').html('Simpan');
    $('#bupotModal').modal('show');
});

$('body').on('click', '.editbupot', function () {
    var bupot_id = $(this).data('id');
    $.get('/eform/1770/bupot/' + bupot_id +'/edit', function (data) {
        $('#bupotHeading').html("Edit Bukti Potong");
        $('#bupotBtn').html('Update');
        $('#bupotBtn').val("edit");
        $('#bupotModal').modal('show');
        $('#bupot_id').val(data.id);
        $('#jenis').val(data.jenis).change();
        $('#nama').val(data.nama);
        $('#npwp').val(data.npwp);
        $('#nomor').val(data.nomor);
        $('#tanggal').val(data.tanggal);
        $('#pph').val(data.pph);
    })
});

$('#bupotBtn').click(function (e) {
    e.preventDefault();
    if($("#bupotForm").valid()){
        $.ajax({
            data: $('#bupotForm').serialize(),
            url: "/eform/1770/store/bupot/"+spt_id,
            type: "POST",
            dataType: 'json',
            success: function (data) {
                $('#bupotForm').trigger("reset");
                $('#bupotModal').modal('hide')
                bupot.draw();
                common.showNotif(data.success, 'success');
            },
            error: function (data) {
                common.showNotif(data, 'error');
                $('#bupotBtn').html('Simpan');
            }
        });
    }
});

$('body').on('click', '.deletebupot', function () {

    var bupot_id = $(this).data("id");
    confirm("Apakah Anda yakin akan menghapus data ini !");
    
    $.ajax({
        type: "DELETE",
        url: '/eform/1770/bupot/'+bupot_id,
        success: function (data) {
            bupot.draw();
            common.showNotif(data.success, 'success');
        },
        error: function (data) {
            common.showNotif(data, 'error');
        }
    });
});
