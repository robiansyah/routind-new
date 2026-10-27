var called = false;
var called2 = false;

$(document).ready(function () {
    masking();
    thnPajak();
    formPembayaran();
    $('#btnCek').on('click',function () {
        if($('#thnPjk').val() != "" && $('#msPjk').val() != "") {
            $('#btn-add-pembayaran').prop('disabled', false);
            $('#thnPajak-val').val($('#thnPjk').val());
            $('#msPajak-val').val($('#msPjk').val());
            tblTagihan();
            tblPembayaran();
            tblRingkasan();
        }else{
            djpcommon.showMessage("Kesalahan", "Tahun Pajak dan/atau Masa Pajak tidak boleh kosong.", "error", "Tutup");
            $('#btn-add-pembayaran').prop('disabled', true);
        }
    });

    $('#btn-add-pembayaran').on('click', function () {
        $('#modal_pembayaran').modal('show');
    });
});

function getMonthName(monthNumber) {
    var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    return months[monthNumber - 1];
}

function masking() {
    $('.djp-select2').each(function () {
        $(this).select2({
            placeholder: $(this).attr('data-placeholder'),
            allowClear: true
        });
    });
    $(".currency").each(function () {
        $(this).inputmask({
            alias: "currency",
            prefix: "",
            groupSeparator: ".",
            digits: "0",
            min: 0
        });
    });
    $("#npwpSsp").inputmask({
        "mask": "99.999.999.9-999.999"
    });
    $("#npwpPbk").inputmask({
        "mask": "99.999.999.9-999.999"
    });
    $("#noBpe").inputmask("****************");
    if($('#thnPjk').val() != "" && $('#msPjk').val() != "") {
        $('#btn-add-pembayaran').prop('disabled', false);
    }else{
        $('#btn-add-pembayaran').prop('disabled', true);
    }
}

function thnPajak() {
    $('#msPjk').prop("disabled", true);
    $('#thnPjk').on("change", function () {
        $(this).closest('.form-group').removeClass('has-error');
        $(this).closest('.form-group.form-group-md').find('span.invalid-feedback').hide();
        $('#msPjk').empty().trigger("change");
        $('#msPjk').prop("disabled", true);
        if ($('#thnPjk').val() !== "") {
            var i = 1;
            var end = 12;
            var opt = "";
            var startYear = $('#startYear').val();
            var startMonth = $('#startMonth').val();
            if ($('#thnPjk').val() === startYear.toString()) i = parseInt(startMonth);
            if ($('#thnPjk').val() === (new Date().getFullYear()).toString()) end = parseInt(new Date().getMonth() + 1);
            for (i; i <= end; i++) {
                if (i.toString().length === 1) {
                    var kode = "0" + i.toString();
                } else {
                    var kode = i.toString();
                }
                opt = opt + "<option value='" + kode + "'>" + getMonthName(i) + "</option>"
            }
            $('#msPjk').prop("disabled", false);
            $('#msPjk').append(opt).trigger('change');
            if($('#thnPjk').val() === (new Date().getFullYear()).toString()){
                $('#msPjk option').filter(function () { return $(this).html() == getMonthName(new Date().getMonth() + 1); }).first().prop('selected', true).trigger('change');
            }
        }
    });
}

function tblTagihan() {
    var idTbl = "tbl_tagihan";
    var paramTbl = {
        spt_id: $('#spt_id').val(),
        msPajak: $('#msPajak-val').val(),
        thnPajak: $('#thnPajak-val').val()
    };
    var urlTbl = ctx + "api/spt/dftr_tagihan";
    var colTbl = [
        {data: "kdMap"},
        {data: "kjs"},
        {data: "pphDipotong"},
        {data: "kdBilling"},
        {data: null}
    ];
    var colDefTbl = [

        {
            targets: [0,1,3],
            responsivePriority: 1,
            className: 'text-center'
        },
        {
            targets: 2,
            responsivePriority: 1,
            className: 'text-right',
            render: function (data, type, full, meta) {
                return '<div class="currency-mask">' + data + '<div>';
            }
        },
        {
            targets: -1,
            responsivePriority: 1,
            orderable: false,
            className: 'text-center',
            render: function (data, type, full, meta) {
                var disabled = (full.kdBilling == null)?"disabled":"";
                var info = '<button type="button"' +
                    'class="btn btn-warning btn-sm btn-elevate btn-circle btn-icon"' +
                    'data-skin="djp" data-container="body"' +
                    'data-toggle="kt-tooltip" data-placement="bottom" title=""' +
                    'data-original-title="Untuk jenis pajak dan jenis setoran ini silahkan buat billing di aplikasi e-Billing">' +
                    '<i class="fa fa-info"></i>' +
                    '</button>';
                var str = '<div class="d-flex"><button type="button"' +
                    'class="btn btn-djp btn-sm btn-elevate btn-circle btn-icon mb-1 mr-1 billing-btn"'+
                    'data-skin="djp" data-container="body"' +
                    'data-toggle="kt-tooltip" data-placement="bottom" title=""' +
                    'data-original-title="Buat Kode Billing">' +
                    '<i class="fa fa-file-invoice"></i>' +
                    '</button>' +
                    '<button type="button" ' + disabled +
                    ' class="btn btn-djp btn-sm btn-elevate btn-circle btn-icon mb-1 mr-1 print-btn"' +
                    'data-skin="djp" data-container="body"' +
                    'data-toggle="kt-tooltip" data-placement="bottom" title=""' +
                    'data-original-title="Cetak Billing">' +
                    '<i class="fa fa-print"></i>' +
                    '</button></div>';
                return (full.kdMap === "411128" && full.kjs === "423")?info:str;
            }
        }
    ];
    var afterAjaxTbl = function () {
        if (!called) {
            called = true;
            btnTagihan();
        }
    };
    djpcommon.generateTable(idTbl, urlTbl, paramTbl, 5, "asc", colTbl, colDefTbl, false, false, false, afterAjaxTbl);
}

function btnTagihan() {
    $('#tbl_tagihan tbody').on('click', '.billing-btn', function (e) {
        e.preventDefault();
        var data = $("#tbl_tagihan").DataTable().row($(this).parents("tr")).data();
        createBilling(data);
    });

    $('#tbl_tagihan tbody').on('click', '.print-btn', function (e) {
        e.preventDefault();
        var data = $("#tbl_tagihan").DataTable().row($(this).parents("tr")).data();
        djpcommon.loadingMessage("Memproses Cetakan Billing", "Mohon sabar menunggu");
        setTimeout(function () {
            reportBilling(data);
        }, 1000);
    });
}

function createBilling(data) {

    var paramAjax = {
        npwp: $('#npwp-user').val(),
        msPajak: $('#msPajak-val').val(),
        thnPajak: $('#thnPajak-val').val(),
        kdMap: data.kdMap,
        kdJnsPjk: data.kjs,
        nominal: data.pphDipotong,
        uraian: ""
    };
    var ajaxDone = function (data) {
        if (data.code == 1) {
            var actSwal = function () {
                if($('#thnPjk').val() != "" && $('#msPjk').val() != "") {
                    tblTagihan();
                    tblRingkasan();
                }else{
                    djpcommon.showMessage("Kesalahan", "Tahun Pajak dan/atau Masa Pajak tidak boleh kosong.", "error", "Tutup");
                }
            };
            if(data.data.responseCode != "00"){
                djpcommon.showMessageWithAction("Error", data.data.responseDescription, "error", "Batal", actSwal);
            }else{
                djpcommon.showMessageWithAction("Sukses", data.data.responseDescription, "success", "Oke", actSwal);
            }
        } else if (data.code == 9) {
            var actErrorMessage = function () {
                location.reload();
            };
            djpcommon.showMessageWithAction("Kesalahan", data.error_msg, "error", "Tutup", actErrorMessage);
        } else {
            djpcommon.showMessage("Kesalahan", data.error_msg, "error", "Tutup");
        }
    };

    djpcommon.ajaxJsonPost(function () {}, paramAjax, ctx + "api/spt/create_billing", ajaxDone);
}

function reportBilling(data) {
    var paramAjaxRequest = {
        kdBilling: data.kdBilling
    };

    var doneAjaxRequest = function (dataCetakan) {
        if (dataCetakan.code == 1) {
            Swal.fire({
                padding: '2.5rem 1.25rem',
                showConfirmButton: false,
                showCloseButton: true,
                customClass: 'swal-lg',
                html:
                    '<object class="pdf-content" data="data:application/pdf;base64,' + dataCetakan.data + '" type="application/pdf" width="100%" height="450px"></object>'
            });
        } else {
            djpcommon.showMessage("Kesalahan", dataCetakan.error_msg, "error", "Tutup");
        }
    };
    djpcommon.ajaxJsonPost(function () {
    }, paramAjaxRequest, ctx + "api/spt/report_billing", doneAjaxRequest);
}

function tblPembayaran() {
    var idTbl = "tbl_pembayaran";
    var paramTbl = {
        spt_id: $('#spt_id').val(),
        msPajak: $('#msPajak-val').val(),
        thnPajak: $('#thnPajak-val').val()
    };
    var urlTbl = ctx + "api/spt/dftr_pembayaran";
    var colTbl = [
        {data: null},
        {data: "noBuktiSetor"},
        {data: "jnsPajak"},
        {data: "jnsSetoran"},
        {data: "periode"},
        {data: "tglSetor"},
        {data: "jmlSetor"},
        {data: null}
    ];
    var colDefTbl = [

        {
            targets: [0,1,2,3,4,5],
            responsivePriority: 1,
            className: 'text-center'
        },
        {
            targets: 6,
            responsivePriority: 1,
            className: 'text-right',
            render: function (data, type, full, meta) {
                return '<div class="currency-mask">' + data + '<div>';
            }
        },
        {
            targets: -1,
            responsivePriority: 1,
            orderable: false,
            className: 'text-center',
            render: function (data, type, full, meta) {
                return '<div class="d-flex"><button type="button"' +
                    'class="btn btn-djp btn-sm btn-elevate btn-circle btn-icon mb-1 mr-1 delete-btn"'+
                    'data-skin="djp" data-container="body"' +
                    'data-toggle="kt-tooltip" data-placement="bottom" title=""' +
                    'data-original-title="Hapus Bukti Setor">' +
                    '<i class="fa fa-trash-alt"></i>' +
                    '</button></div>'
            }
        }
    ];
    var afterAjaxTbl = function () {
        if (!called2) {
            console.log(called2);
            called2 = true;
            btnHapus();
        }
    };
    djpcommon.generateTable(idTbl, urlTbl, paramTbl, 5, "asc", colTbl, colDefTbl, false, false, true, afterAjaxTbl);
}

function btnHapus() {
    $('#tbl_pembayaran tbody').on('click', '.delete-btn', function (e) {
        e.preventDefault();
        var data = $("#tbl_pembayaran").DataTable().row($(this).parents("tr")).data();
        var actDoneDelete = function () {
            var paramAjax = {
                idSetor: data.idSetor,
                noBuktiSetor: data.noBuktiSetor
            };
            var ajaxDone = function (dataCek) {
                if (dataCek.code == 1) {
                    if(dataCek.data.fgLapor != "1"){
                        deleteBuktiPenyetoran(data.idSetor);
                    }else {
                        djpcommon.showMessage("Kesalahan", "Bukti Penyetoran telah digunakan untuk Pelaporan SPT", "error", "Tutup");
                    }
                } else if (dataCek.code == 9) {
                    var actErrorMessage = function () {
                        location.reload();
                    };
                    djpcommon.showMessageWithAction("Kesalahan", dataCek.error_msg, "error", "Tutup", actErrorMessage);
                } else {
                    djpcommon.showMessage("Kesalahan", dataCek.error_msg, "error", "Tutup");
                }
            };
            djpcommon.ajaxJsonPost(function () {}, paramAjax, ctx + "api/spt/check_buktisetor", ajaxDone);
        };
        djpcommon.showMessageQuestionWithAction("Hapus Bukti Setor", "Apakah Anda yakin akan menghapus Bukti Setor?", "Oke", "Batal", actDoneDelete);
    });
}

function deleteBuktiPenyetoran(idSetor) {
    var paramAjax = {
        fgSsKb: "0",
        idSetor: idSetor,
        npwp: $('#npwp-user').val()
    };
    var ajaxDone = function (data) {
        if (data.code == 1) {
            var actSwal = function () {
                tblPembayaran();
                tblRingkasan();
            };
            djpcommon.showMessageWithAction("Sukses", "Data berhasil dihapus.", "success", "Oke", actSwal);
        } else if (data.code == 9) {
            var actErrorMessage = function () {
                location.reload();
            };
            djpcommon.showMessageWithAction("Kesalahan", data.error_msg, "error", "Tutup", actErrorMessage);
        } else {
            djpcommon.showMessage("Kesalahan", data.error_msg, "error", "Tutup");
        }
    };

    djpcommon.ajaxJsonPost(function () {}, paramAjax, ctx + "api/spt/delete_buktisetor", ajaxDone);
}

function formPembayaran() {
    $('#btnSubmit').prop('disabled', true);
    ($('input[name="fgPbkBpe"]:checked').val() === "0") ? $('#fgPbkPbe1Div').hide() && $('#thnPajak').closest('.form-group').hide() : $('#fgPbkPbe0Div').hide() && $('#thnPajak').closest('.form-group').show();
    $('input[name="fgPbkBpe"]').on('change', function () {
        $('#noBpe').val('');
        $('#thnPajakBpe').val('').trigger('change');
        $('#noPbk').val('');
        ($('input[name="fgPbkBpe"]:checked').val() === "0") ? $('#fgPbkPbe1Div').hide() && $('#fgPbkPbe0Div').show() && $('#thnPajak').closest('.form-group').hide() : $('#fgPbkPbe1Div').show() && $('#fgPbkPbe0Div').hide() && $('#thnPajak').closest('.form-group').show();
    });

    $('#npwpSsp').prop("readonly", true);
    $('#npwpSsp').val($('#npwp-user').val()).trigger('keyup');
    $('input[name="optSsp"]').on("change", function () {
        $('#npwpSsp').val("");
        if ($('input[name="optSsp"]').prop("checked")) {
            $('#npwpSsp').prop("readonly", false);
        } else {
            $('#npwpSsp').prop("readonly", true);
            $('#npwpSsp').val($('#npwp-user').val()).trigger('keyup');
        }
    });

    $('#npwpPbk').prop("readonly", true);
    $('#npwpPbk').val($('#npwp-user').val()).trigger('keyup');
    $('input[name="optPbk"]').on("change", function () {
        $('#npwpPbk').val("");
        if ($('input[name="optPbk"]').prop("checked")) {
            $('#npwpPbk').prop("readonly", false);
        } else {
            $('#npwpPbk').prop("readonly", true);
            $('#npwpPbk').val($('#npwp-user').val()).trigger('keyup');
        }
    });

    $('#btnReset').on('click', function () {
        resetForm();
        $('#thnPjk').val($('#thnPajak-val').val()).trigger('change');
        $('#msPjk').val($('#msPajak-val').val()).trigger('change');
        $('input[name="optSsp"]').prop("checked", false).trigger('change');
    });

    $('#btnSearchBpe').on('click', function () {
        //Ajax BPE
        djpcommon.loadingMessage("Memproses", "Mohon sabar menunggu");
        setTimeout(function () {
            searchBpe();
        }, 1000);

        function searchBpe() {
            var paramAjakBpe = {
                npwpSsp: $('#npwpSsp').inputmask("unmaskedvalue"),
                ntpn: $('#noBpe').val(),
                thnPajak: $('#thnPajakBpe').val()
            };

            var doneAjaxBpe = function (data) {
                if (data.code == 1) {
                    djpcommon.showMessage("", "Data ditemukan.", "info", "Oke");
                    insertData(data);
                    disableData();
                    $('#btnSubmit').prop('disabled', false);
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
            }, paramAjakBpe, ctx + "api/common/check_ntpn", doneAjaxBpe);
        }
    });

    $('#btnSearchPbk').on('click', function () {
        //Ajax BPE
        djpcommon.loadingMessage("Memproses", "Mohon sabar menunggu");
        setTimeout(function () {
            searchPbk();
        }, 1000);

        function searchPbk() {
            var paramAjakPbk = {
                npwpPbk: $('#npwpPbk').inputmask("unmaskedvalue"),
                noPbk: $('#noPbk').val()
            };

            var doneAjaxPbk = function (data) {
                if (data.code == 1) {
                    djpcommon.showMessage("", "Data ditemukan.", "info", "Oke");
                    $('#thnPajak').val(data.data.thPajak);
                    insertData(data);
                    disableData();
                    $('#btnSubmit').prop('disabled', false)
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
            }, paramAjakPbk, ctx + "api/common/check_pbk", doneAjaxPbk);
        }
    });

    $('#btnSubmit').on('click', function (e) {
        e.preventDefault();
        $('#modal_pembayaran').modal('hide');
        if ($('input[name="fgPbkBpe"]:checked').val() === "0") {
            var nobktSetor = $('#noBpe').val();
            var thnPajak = $('#thnPajakBpe').val();
            var npwpSetoran = $('#npwpSsp').inputmask("unmaskedvalue");
        } else {
            var nobktSetor = $('#noPbk').val();
            var thnPajak = $('#thnPajak').val();
            var npwpSetoran = $('#npwpPbk').inputmask("unmaskedvalue");
        }
        djpcommon.loadingMessage("Memproses", "Mohon sabar menunggu");
        setTimeout(function () {
            submit();
        }, 1000);

        function submit() {
            var paramAjakSave = {
                spt_id: $('#spt_id').val(),
                npwp: $('#npwp-user').val(),
                npwpSsp: npwpSetoran, //cek
                noBuktiSetor: nobktSetor,
                fgPbkBpe: $('input[name="fgPbkBpe"]:checked').val(),
                fgSsKb: "0",
                thnPajak: thnPajak,
                msPajak: $('#masaPajak').val(),
                kdMap: $('#jnsPajak').val(),
                kdJnsSetor: $('#jnsSetoran').val(),
                kdObjPajak: "",
                jmlBruto: "0",
                jmlSetor: $('#jmlSetor').inputmask('unmaskedvalue'),
                tglSetor: $('#tglSetor').val()
            };

            var doneAjaxSave = function (data) {
                resetForm();
                $('input[name="optSsp"]').prop("checked", false).trigger('change');
                if (data.code == 1) {
                    var actErrorMessage = function () {
                        tblPembayaran();
                        tblRingkasan();
                        $('#thnPjk').val($('#thnPajak-val').val()).trigger('change');
                        $('#msPjk').val($('#msPajak-val').val()).trigger('change');
                    };
                    djpcommon.showMessageWithAction("Sukses", "Data berhasil disimpan.", "success", "Oke", actErrorMessage);
                } else if (data.code == 9) {
                    var actErrorMessage = function () {
                        location.reload();
                    };
                    djpcommon.showMessageWithAction("Kesalahan", data.error_msg, "error", "Tutup", actErrorMessage);
                } else {
                    var actErrorMessage = function () {
                        location.reload();
                    };
                    djpcommon.showMessageWithAction("Kesalahan", data.error_msg, "error", "Tutup", actErrorMessage);
                }
            };

            djpcommon.ajaxJsonPost(function () {
            }, paramAjakSave, ctx + "api/spt/save_buktisetor", doneAjaxSave);
        }
    });

    function disableData() {
        $('#btnSearchPbk').prop("disabled", true);
        $('#btnSearchBpe').prop("disabled", true);
        $('input[name="fgPbkBpe"]').prop("disabled", true);
        $('#noPbk').prop("disabled", true);
        $('#noBpe').prop("disabled", true);
        $('#thnPajakBpe').prop("disabled", true);
    }

    function insertData(data) {
        $('#masaPajak').val(data.data.msPajak);
        $('#jnsPajak').val(data.data.kdMap);
        $('#jnsSetoran').val(data.data.kjs);
        $('#jmlSetor').val(data.data.jmlSetor);
        $('#tglSetor').val(data.data.tglSetor);
    }

    function resetForm() {
        $('#btnSubmit').prop('disabled', true);
        $('#form_pembayaran').trigger("reset");
        $('#fgPbkBpe0').prop('checked', true);
        $('.djp-select2').val('').trigger('change');
        $('#form_pembayaran input,select').prop("disabled", false);
        $('#btnSearchBpe').prop("disabled", false);
        $('#btnSearchPbk').prop("disabled", false);
        ($('input[name="fgPbkBpe"]:checked').val() === "0") ? $('#fgPbkPbe1Div').hide() && $('#fgPbkPbe0Div').show() && $('#thnPajak').closest('.form-group').hide() : $('#fgPbkPbe1Div').show() && $('#fgPbkPbe0Div').hide() && $('#thnPajak').closest('.form-group').show();
    }
}

function tblRingkasan() {
    var idTbl = "tbl_ringkasan";
    var paramTbl = {
        spt_id: $('#spt_id').val(),
        msPajak: $('#msPajak-val').val(),
        thnPajak: $('#thnPajak-val').val()
    };
    var urlTbl = ctx + "api/spt/dftr_ringkasan";
    var colTbl = [
        {data: "kdMap"},
        {data: "kjs"},
        {data: "pphDipotong"},
        {data: "pphDisetor"},
        {data: "selisih"}
    ];
    var colDefTbl = [

        {
            targets: [0,1],
            responsivePriority: 1,
            className: 'text-center'
        },
        {
            targets: [2,3,4],
            responsivePriority: 1,
            className: 'text-right',
            render: function (data, type, full, meta) {
                return '<div class="currency-mask">' + data + '<div>';
            }
        }
    ];
    var afterAjaxTbl = function () {
    };
    djpcommon.generateTable(idTbl, urlTbl, paramTbl, 5, "asc", colTbl, colDefTbl, false, false, false, afterAjaxTbl);

}
