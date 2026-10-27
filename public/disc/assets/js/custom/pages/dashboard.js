$(document).ready(function () {
    $('#btn-excel').hide();

    $('#btn-refresh').on('click', function () {
        $('#tbl_dftrspt').DataTable().clear();
        $('#tbl_dftrspt').DataTable().ajax.reload();
    });

    var tblDftrSpt = "tbl_dftrspt";
    var paramTblDftrSpt = {};
    var urlTblDftrSpt = "/api/dash/dftr_sptmasa";
    var colTblDftrSpt = [
        {data: null},
        {data: "ntte"},
        {data: "masaTahunPajak"},
        {data: "revNo"},
        {data: "tglKirim"},
        {data: "idSpt"}
    ];
    var colDefTblDftrSpt = [
        {
            targets: 0,
            responsivePriority: 1,
            orderable: false,
            className: 'text-center',
            render: function (data, type, full, meta) {
                return '<div style="width: 100%;">' + data + '<div>';
            }
        },
        {
            targets: 1,
            responsivePriority: 3,
            className: 'text-left'
        },
        {
            targets: 2,
            responsivePriority: 4,
            className: 'text-center'
        },
        {
            targets: 3,
            responsivePriority: 5,
            className: 'text-center'
        },
        {
            targets: 4,
            responsivePriority: 6,
            className: 'text-center'
        },
        {
            targets: -1,
            responsivePriority: 2,
            orderable: false,
            className: 'text-center',
            render: function (data, type, full, meta) {
                var fgStatus = full.fgStatusReqDownload;
                var fgDelete = full.fgDeleteReqDownload;
                if ((fgStatus == 2 && fgDelete == 1) || fgStatus == 3) {
                    var icon = "fa-undo-alt";
                    var title = "Ajukan ulang unduh Bukti Potong";
                    var classBtn = "rerequest-btn";
                } else if (fgStatus == 0 || fgStatus == 1) {
                    var icon = "fa-spinner fa-spin fa-fw";
                    var title = "Bukti Potong sedang dalam proses";
                    var classBtn = "process-btn";
                } else if (fgStatus == 2 || fgStatus == 4) {
                    var icon = "fa-download";
                    var title = "Unduh Bukti Potong Pada SPT";
                    var classBtn = "download-btn";
                } else {
                    var icon = "fa-paper-plane";
                    var title = "Ajukan unduh Bukti Potong";
                    var classBtn = "request-btn";
                }
                return '<span data-toggle="modal" data-target="#modal_djp"><button type="button" ' +
                    'class="btn btn-djp btn-sm btn-elevate btn-circle btn-icon mb-1 mr-1 bpe-btn" ' +
                    'data-skin="djp" data-container="body" ' +
                    'data-toggle="kt-tooltip" data-placement="bottom" title=""' +
                    'data-original-title="Lihat BPE">' +
                    '<i class="fa fa-envelope-open-text"></i>' +
                    '</button></span>' +
                    '<span><button type="button"' +
                    'class="btn btn-djp btn-sm btn-elevate btn-circle btn-icon mb-1 mr-1 btn-dftr-bp"' +
                    'data-skin="djp" data-container="body"' +
                    'data-toggle="kt-tooltip" data-placement="bottom" title=""' +
                    'data-original-title="Lihat Bukti Potong pada SPT">' +
                    '<i class="fa fa-bars"></i>' +
                    '</button></span>' +
                    '<span><button type="button"' +
                    'class="btn btn-djp btn-sm btn-elevate btn-circle btn-icon mb-1 mr-1 spt-btn"' +
                    'data-skin="djp" data-container="body"' +
                    'data-toggle="kt-tooltip" data-placement="bottom" title=""' +
                    'data-original-title="Cetak SPT">' +
                    '<i class="fa fa-print"></i>' +
                    '</button></span>' +
                    '<span><button type="button"' +
                    'class="btn btn-djp btn-sm btn-elevate btn-circle btn-icon mb-1 mr-1 ' + classBtn + '"' +
                    'data-skin="djp" data-container="body"' +
                    'data-toggle="kt-tooltip" data-placement="bottom" title=""' +
                    'data-original-title="' + title + '">' +
                    '<i class="fa ' + icon + '"></i>' +
                    '</button></span>';
            }
        }
    ];

    var afterAjaxTblDftrSpt = function () {
        $('#tbl_dftrspt tbody').on('click', '.btn-dftr-bp', function (e) {
            $('#btn-excel').show();

            e.preventDefault();
            var data = $("#tbl_dftrspt").DataTable().row($(this).parents('tr')).data();
            var idSpt = data.idSpt;

            var tblDftrBupot = "tbl_dftrbp";
            var paramTblDftrBupot = {idSpt: idSpt};
            var urlTblDftrBupot = "/api/dash/dftr_bupot";
            var colTblDftrBupot = [
                {data: "noBupot"},
                {data: "idDipotong"},
                {data: "kdObjPjk"},
                {data: "noBupot"},
                {data: "tglBupot"},
                {data: "jmlBruto"},
                {data: "pphDipotong"},
                {data: "keterangan"}
            ];
            var colDefTblDftrBupot = [
                {
                    targets: 0,
                    orderable: false,
                    responsivePriority: 1,
                    className: 'text-center'
                },
                {
                    targets: [3, 4, 2, -1],
                    responsivePriority: 1,
                    className: 'text-center'
                },
                {
                    targets: [6, 5],
                    responsivePriority: 1,
                    className: 'text-right',
                    render: function (data, type, full, meta) {
                        return '<div class="currency-mask">' + data + '<div>';
                    }
                }
            ];

            var afterAjaxTblDftrBupot = function () {
                $('#btn-excel').on('click', function (e) {
                    e.preventDefault();

                    djpcommon.loadingMessage("Memproses Excel", "Mohon sabar menunggu");
                    setTimeout(function () {
                        downloadExcel();
                    }, 2000);

                    function downloadExcel() {
                        var arrData = [];
                        var data = $('#tbl_dftrbp').DataTable().data();
                        $.each(data, function (key, value) {
                            var obj = {
                                ID_DIPOTONG: value.idDipotong,
                                NAMA: value.nama,
                                PASAL: value.pasal,
                                KODE_OBJEK_PAJAK: value.kdObjPjk,
                                NO_BUKTI_POTONG: value.noBupot,
                                TANGGAL_BUPOT: value.tglBupot,
                                PPH_DIPOTONG: value.pphDipotong,
                                JUMLAH_BRUTO: value.jmlBruto,
                                KETERANGAN: value.keterangan
                            };
                            arrData.push(obj);
                        });
                        var wb = XLSX.utils.book_new();
                        var ws = XLSX.utils.json_to_sheet(arrData, {header: ["ID_DIPOTONG", "NAMA", "PASAL", "KODE_OBJEK_PAJAK", "NO_BUKTI_POTONG", "TANGGAL_BUPOT", "PPH_DIPOTONG", "JUMLAH_BRUTO", "KETERANGAN"]});
                        XLSX.utils.book_append_sheet(wb, ws, "Bukti Potong");
                        XLSX.writeFile(wb, 'BUKTI_POTONG.xlsx');
                        swal.close();
                    }

                });
            };

            djpcommon.generateTable(
                tblDftrBupot,
                urlTblDftrBupot,
                paramTblDftrBupot,
                5,
                "asc",
                colTblDftrBupot,
                colDefTblDftrBupot,
                true,
                false,
                true,
                afterAjaxTblDftrBupot);
        });

        $('#tbl_dftrspt tbody').on('click', '.bpe-btn', function (e) {
            e.preventDefault();
            var data = $("#tbl_dftrspt").DataTable().row($(this).parents('tr')).data();
            var idSpt = data.idSpt;
            djpcommon.loadingMessage("Memproses BPE", "Mohon sabar menunggu");
            setTimeout(function () {
                validasi();
            }, 1000);

            function validasi() {
                var paramAjaxRequest = {
                    idSpt: idSpt
                };

                var doneAjaxRequest = function (data) {
                    if (data.code == 1) {
                        Swal.fire({
                            padding: '2.5rem 1.25rem',
                            showConfirmButton: false,
                            showCloseButton: true,
                            customClass: 'swal-lg',
                            html:
                                '<object class="pdf-content" data="data:application/pdf;base64,' + data.data + '" type="application/pdf" width="100%" height="450px"></object>'
                        });
                    } else if (data.code == 9) {
                        var actErrorMessage = function () {
                            location.reload();
                        };
                        djpcommon.showMessageWithAction("Kesalahan", data.error_msg, "error", "Tutup", actErrorMessage);
                    } else {
                        djpcommon.showMessage("Kesalahan", data.error_msg, "error", "Tutup");
                    }
                };
                djpcommon.ajaxJsonPost(function () {
                }, paramAjaxRequest, "/api/dash/report_bpe", doneAjaxRequest);
            }
        });

        $('#tbl_dftrspt tbody').on('click', '.spt-btn', function (e) {
            e.preventDefault();
            var data = $("#tbl_dftrspt").DataTable().row($(this).parents('tr')).data();
            var idSpt = data.idSpt;
            djpcommon.loadingMessage("Memproses SPT", "Mohon sabar menunggu");
            setTimeout(function () {
                validasi();
            }, 1000);

            function validasi() {
                var paramAjaxRequest = {
                    idSpt: idSpt
                };

                var doneAjaxRequest = function (data) {
                    if (data.code == 1) {
                        Swal.fire({
                            padding: '2.5rem 1.25rem',
                            showConfirmButton: false,
                            showCloseButton: true,
                            customClass: 'swal-lg',
                            html:
                                '<object class="pdf-content" data="data:application/pdf;base64,' + data.data + '" type="application/pdf" width="100%" height="450px"></object>'
                        });
                    } else if (data.code == 9) {
                        var actErrorMessage = function () {
                            location.reload();
                        };
                        djpcommon.showMessageWithAction("Kesalahan", data.error_msg, "error", "Tutup", actErrorMessage);
                    } else {
                        djpcommon.showMessage("Kesalahan", data.error_msg, "error", "Tutup");
                    }
                };
                djpcommon.ajaxJsonPost(function () {
                }, paramAjaxRequest, "/api/dash/report_spt", doneAjaxRequest);
            }
        });

        $('#tbl_dftrspt tbody').on('click', '.request-btn', function (e) {
            e.preventDefault();
            var data = $("#tbl_dftrspt").DataTable().row($(this).parents('tr')).data();
            var idSpt = data.idSpt;

            djpcommon.loadingMessage("Memproses", "Mohon sabar menunggu");
            setTimeout(function () {
                request();
            }, 1000);

            function request() {

                var paramAjaxRequest = {
                    idSpt: idSpt
                };

                var doneAjaxRequest = function (data) {
                    if (data.code == 1) {
                        var actMessage = function () {
                            location.reload();
                        };
                        djpcommon.showMessageWithAction("Sukses", "Pengajuan unduh Bukti Potong Berhasil.", "success", "Tutup", actMessage);
                    } else if (data.code == 9) {
                        var actErrorMessage = function () {
                            location.reload();
                        };
                        djpcommon.showMessageWithAction("Kesalahan", data.error_msg, "error", "Tutup", actErrorMessage);
                    } else {
                        djpcommon.showMessage("Kesalahan", data.error_msg, "error", "Tutup");
                    }
                };

                djpcommon.ajaxJsonPost(function () {
                }, paramAjaxRequest, "/api/dash/request_bp", doneAjaxRequest);
            }

        });
        $('#tbl_dftrspt tbody').on('click', '.rerequest-btn', function (e) {
            e.preventDefault();
            var data = $("#tbl_dftrspt").DataTable().row($(this).parents('tr')).data();
            var idSpt = data.idSpt;

            djpcommon.loadingMessage("Memproses", "Mohon sabar menunggu");
            setTimeout(function () {
                rerequest();
            }, 1000);

            function rerequest() {

                var paramAjaxReRequest = {
                    idSpt: idSpt
                };

                var doneAjaxReRequest = function (data) {
                    if (data.code == 1) {
                        var actMessage = function () {
                            location.reload();
                        };
                        djpcommon.showMessageWithAction("Sukses", "Pengajuan ulang unduh Bukti Potong Berhasil.", "success", "Tutup", actMessage);
                    } else if (data.code == 9) {
                        var actErrorMessage = function () {
                            location.reload();
                        };
                        djpcommon.showMessageWithAction("Kesalahan", data.error_msg, "error", "Tutup", actErrorMessage);
                    } else {
                        djpcommon.showMessage("Kesalahan", data.error_msg, "error", "Tutup");
                    }
                };

                djpcommon.ajaxJsonPost(function () {
                }, paramAjaxReRequest, "/api/dash/rerequest_bp", doneAjaxReRequest);
            }
        });
        $('#tbl_dftrspt tbody').on('click', '.download-btn', function (e) {
            e.preventDefault();
            var data = $("#tbl_dftrspt").DataTable().row($(this).parents('tr')).data();
            var idSpt = data.idSpt;

            djpcommon.loadingMessage("Mengunduh Bukti Potong", "Mohon sabar menunggu");
            setTimeout(function () {
                validasi();
            }, 1000);

            function validasi() {
                window.open("/api/dash/filebupot/" + idSpt);
                djpcommon.showMessage("Berhasil", "Bukti Potong telah terunduh.", "success", "Oke");
            }
        });
    };

    djpcommon.generateTable(
        tblDftrSpt,
        urlTblDftrSpt,
        paramTblDftrSpt,
        5,
        "asc",
        colTblDftrSpt,
        colDefTblDftrSpt,
        true,
        false,
        true,
        afterAjaxTblDftrSpt);
});