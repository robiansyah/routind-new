"use strict";
var statusLengkap = 0;
var kdlbkbn = 9;
var DatatablesDraft = function () {
    var initTableKirim = function () {
        var table = $('#tbl_kirimspt').DataTable({
            responsive: true,
            // DOM Layout settings

            dom: "<'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>",
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            pageLength: 5,
            processing: true,
            language: {
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Sedang memproses...</span>',
                "sLengthMenu": "Tampilkan _MENU_ entri",
                "sZeroRecords": "Tidak ditemukan data yang sesuai",
                "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                "sInfoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
                "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
                "sInfoPostFix": "",
                "sSearch": "Cari:",
                "sUrl": "",
                "oPaginate": {
                    "sFirst": "Pertama",
                    "sPrevious": "Sebelumnya",
                    "sNext": "Selanjutnya",
                    "sLast": "Terakhir"
                }
            },
            ajax: {
                url: '/spt/dashboard/dftr_draft',
                type: 'POST',
                error: function (jqXHR, textStatus, errorThrown) {
                    $('#tbl_kirimspt').DataTable().clear().draw();
                    swal.fire({
                        title: "Terjadi kesalahan pada server",
                        text: "Mohon refresh halaman ini",
                        type: "error",
                        buttonsStyling: false,
                        confirmButtonText: "<i class='la la-thumbs-up'></i> Oke siap",
                        confirmButtonClass: "btn btn-djp",
                        allowOutsideClick: false,
                    }).then(function (result) {
                        if (result.value) {

                        }
                    });
                }
            },
            columns: [
                {data: 'index'},
                {data: 'jenis'},
                {data: 'masaTahun'},
                {data: 'pembetulanke'},
                {data: 'nilaipajak'},
                {data: 'flagkirim'},
                {data: 'sumber'}
            ],
            columnDefs: [
                {
                    targets: 0,
                    responsivePriority: 2,
                    className: 'text-center'
                },
                {
                    targets: 1,
                    responsivePriority: 3,
                },
                {
                    targets: 2,
                    responsivePriority: 4,
                },
                {
                    targets: 3,
                    responsivePriority: 5,
                    className: 'text-center',
                },
                {
                    targets: 4,
                    responsivePriority: 6,
                    className: 'text-right',
                    render: function (data, type, full, meta) {
                        return common.formatNumber(data);
                    }
                },
                {
                    targets: 5,
                    responsivePriority: 7,
                    render: function (data, type, full, meta) {
                        return setStatusSpt(data);
                    }
                },
                {
                    targets: -1,
                    "width": "100px",
                    responsivePriority: 1,
                    orderable: false,
                    className: 'text-right',
                    render: function (data, type, full, meta) {
                    return '\
                    <button type="button" class="btn btn-icon btn-active-light-primary w-30px h-30px ubah" data-skin="dark" data-container="body" data-bs-toggle="tooltip" data-bs-placement="top" title="Ubah SPT" data-target="#ubahSPT">\
                        <i class="fa fa-pencil"></i>\
                    </button>\
                    <button type="button" class="btn btn-icon btn-active-light-primary w-30px h-30px hapus" data-skin="dark" data-container="body" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus SPT" data-target="#hapusSPT">\
                        <i class="fa fa-trash"></i>\
                    </button>\
					';
                            
                        
                    },
                },
            ],
            drawCallback: function (settings) {
                $('[data-bs-toggle="tooltip"]').tooltip();
            },
        });
    }
    function setStatusSpt(value) {
        switch (value) {
            case "0":
                return "Draft";
                break;
            case "1":
                return "Siap Kirim";
                break;
            case "9":
                return "Siap Kirim";
                break;
        }
    }
    ;

    var handleButtonUbah = function () {
        $('#tbl_kirimspt').find('tbody').on('click', 'button.ubah', function () {
            var oTable = $("#tbl_kirimspt").DataTable();
            var data = oTable.row($(this).parents('tr')).data();
            var id = data.id;
            if (data.jenis === '1771') {
                window.location.href = "/eform/1771/" + id;
            } else if (data.jenis === '1770') {
                window.location.href = "/eform/1770/" + id;
            } else {
                common.showMessage("INFO", "Menu Edit hanya untuk SPT 1770S dan 1770SS", "info");
            }
        });
    };
    var handleButtonHapus = function () {
        $('#tbl_kirimspt').find('tbody').on('click', 'button.hapus', function () {
            var judul = "Perhatian...";
            var pesan = "Anda akan menghapus SPT ini?";
            var type = "warning";
            var oTable = $("#tbl_kirimspt").DataTable();
            var data = oTable.row($(this).parents('tr')).data();
            var alertx = common.showMessageConfirmNotif(judul, pesan, type, function (e) {
                if (e) {
                    delSpt(data.id);
                }
            });
        });
    };

    var delSpt = function (obj) {
        $.ajax({
            url: "/spt/dashboard/delete",
            type: 'POST',
            data: {id: obj},
            success: function (data) {
                if (data.kdStatus === "1") {
                    common.showMessageOnReload("Info", data.message);
                } else {
                    common.showMessage("Info", data.message, "info");
                }
            },
            error: function (jqXhr, status, er) {
                common.showMessage("ERROR", "ERR099: Proses tidak berhasil dilakukan.", "error", "OK");
            },
        });
    };

    return {
        init: function () {
            initTableKirim();
            handleButtonUbah();
            handleButtonHapus();
        }
    };
}();
jQuery(document).ready(function () {
    DatatablesDraft.init();
});