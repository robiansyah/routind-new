$(document).ready(function () {
    $('#btn-refresh').on('click', function () {
        $('#tbl_dftrspt').DataTable().clear();
        $('#tbl_dftrspt').DataTable().ajax.reload();
    });

    var tblDftrSpt = "tbl_dftrspt";
    var paramTblDftrSpt = {};
    var urlTblDftrSpt = "/api/spt/dftr_spt";
    var colTblDftrSpt = [
        {data: "thnPajak"},
        {data: "msPajak"},
        {data: "revNo"},
        {data: "jmlPphKs"},
        {data: "stsSpt"},
        {data: "idSpt"}
    ];
    var colDefTblDftrSpt = [
        {
            targets: 0,
            responsivePriority: 1,
            className: 'text-center'
        },
        {
            targets: 1,
            responsivePriority: 1,
            className: 'text-center',
            render: function (data, type, full, meta) {
                if (data.length > 1) {
                    var val = data;
                } else {
                    var val = "0" + data;
                }
                return val;
            }
        },
        {
            targets: 2,
            responsivePriority: 2,
            className: 'text-center'
        },
        {
            targets: 3,
            responsivePriority: 2,
            className: 'text-right',
            render: function (data, type, full, meta) {
                return '<div class="currency-mask">' + data + '<div>';
            }
        },
        {
            targets: 4,
            responsivePriority: 2,
            className: 'text-center',
            render: function (data, type, full, meta) {
                var status;
                if (data == 0 || data == 2) {
                    status = "Sedang Proses Posting";
                } else if (data == 1 || data == 3) {
                    status = "Draft";
                } else if (data >= 3) {
                    status = "Sudah Lapor";
                } else {
                    status = "";
                }
                return status;
            }
        },
        {
            targets: -1,
            orderable: false,
            responsivePriority: 1,
            className: 'text-center',
            render: function (data, type, full, meta) {
                var button;
                if (full.stsSpt == 0 || full.stsSpt == 2) {
                    button = "";
                } else if (full.stsSpt == 1 || full.stsSpt == 3) {
                    button = '<span><button type="button" ' +
                        'class="btn btn-djp btn-sm btn-elevate btn-circle btn-icon mb-1 mr-1 lengkapi-btn" ' +
                        'data-skin="djp" data-container="body" ' +
                        'data-toggle="kt-tooltip" data-placement="bottom" title=""' +
                        'data-original-title="Lengkapi SPT">' +
                        '<i class="fa fa-edit"></i>' +
                        '</button></span>' +
                        '<span><button type="button"' +
                        'class="btn btn-djp btn-sm btn-elevate btn-circle btn-icon mb-1 mr-1 kirim-btn"' +
                        'data-skin="djp" data-container="body"' +
                        'data-toggle="kt-tooltip" data-placement="bottom" title=""' +
                        'data-original-title="Kirim SPT">' +
                        '<i class="fa fa-paper-plane"></i>' +
                        '</button></span>';
                } else if (full.stsSpt >= 3) {
                    button = '<span><button type="button"' +
                        'class="btn btn-djp btn-sm btn-elevate btn-circle btn-icon mb-1 mr-1 lihat-btn"' +
                        'data-skin="djp" data-container="body"' +
                        'data-toggle="kt-tooltip" data-placement="bottom" title=""' +
                        'data-original-title="Lihat SPT">' +
                        '<i class="fa fa-eye"></i>' +
                        '</button></span>';
                } else {
                    button = "";
                }
                return button;
            }
        }
    ];
    var afterAjaxTblDftrSpt = function () {
        $('#tbl_dftrspt tbody').on('click', '.lengkapi-btn', function (e) {
            e.preventDefault();
            var data = $("#tbl_dftrspt").DataTable().row($(this).parents('tr')).data();
            var idSpt = data.idSpt;
            djpcommon.formSubmitPost("/ebupot/sptmasa/lengkapi-spt", {idSpt: idSpt, '_token': $('meta[name=csrf-token]').attr('content')}, 'post');
        });

        $('#tbl_dftrspt tbody').on('click', '.kirim-btn', function (e) {
            e.preventDefault();
            var data = $("#tbl_dftrspt").DataTable().row($(this).parents('tr')).data();
            var idSpt = data.idSpt;
            if (data.msPajak.length > 1) {
                var msPajak = data.msPajak;
            } else {
                var msPajak = "0" + data.msPajak;
            }
            var param = {
                idSpt: idSpt,
                thnPajak: data.thnPajak,
                msPajak: msPajak,
                revNo: data.revNo,
                '_token': $('meta[name=csrf-token]').attr('content')
            };
            djpcommon.formSubmitPost("/ebupot/sptmasa/kirim-spt", param, 'post');
        });

        $('#tbl_dftrspt tbody').on('click', '.lihat-btn', function (e) {
            e.preventDefault();
            var data = $("#tbl_dftrspt").DataTable().row($(this).parents('tr')).data();
            var idSpt = data.idSpt;
            if (data.msPajak.length > 1) {
                var msPajak = data.msPajak;
            } else {
                var msPajak = "0" + data.msPajak;
            }
            var param = {
                idSpt: idSpt,
                thnPajak: data.thnPajak,
                msPajak: msPajak,
                revNo: data.revNo
            };
            djpcommon.formSubmitPost("/ebupot/sptmasa/lihat-spt", param, 'post');
        });
    };

    djpcommon.generateTable(
        tblDftrSpt,
        urlTblDftrSpt,
        paramTblDftrSpt,
        5,
        "desc",
        colTblDftrSpt,
        colDefTblDftrSpt,
        true,
        false,
        false,
        afterAjaxTblDftrSpt);
});