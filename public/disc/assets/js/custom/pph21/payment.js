var called = false;
var called2 = false;

$(document).ready(function () {
    tblTagihan();
    tblPembayaran();
    formPembayaran();

    $('#pembayaran_new').on('click', function () {
        $('#modal_pembayaran').modal('show');
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
});

function tblTagihan() {
    var idTbl = "tbl_tagihan";
    var paramTbl = {
        spt_id: $('#spt_id').val(),
        msPajak: $('#period').val(),
        thnPajak: $('#year').val()
    };
    var urlTbl = "/api/spt/dftr_tagihan";
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
            className: 'text-end',
            render: function (data, type, full, meta) {
                return common.formatNumber(data);
            }
        },
        {
            targets: -1,
            responsivePriority: 1,
            orderable: false,
            className: 'text-center',
            render: function (data, type, full, meta) {
                var disabled = (full.kdBilling != null)?"disabled ":"";
                var disabled2 = (full.kdBilling == null)?"disabled ":"";
                var info = '<button type="button"' +
                    'class="btn btn-icon btn-active-light-primary w-25px h-25px"' +
                    'data-bs-toggle="tooltip" data-bs-placement="bottom" title="Untuk jenis pajak dan jenis setoran ini silahkan buat billing di menu e-Billing">' +
                    '<i class="fa fa-info"></i>' +
                    '</button>';
                var str = '<button type="button"' + disabled +
                    'class="btn btn-icon btn-active-light-primary w-25px h-25px billing-btn"'+
                    'data-bs-toggle="tooltip" data-bs-placement="bottom" title="Buat Kode Billing">' +
                    '<i class="fa fa-file-invoice text-primary"></i>' +
                    '</button>' +
                    '<button type="button"' + disabled2 +
                    ' class="btn btn-icon btn-active-light-primary w-25px h-25px print-btn"' +
                    'data-bs-toggle="tooltip" data-bs-placement="bottom" title="Cetak Billing">' +
                    '<i class="fa fa-print text-primary"></i>' +
                    '</button>';
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
    common.generateTable(idTbl, urlTbl, paramTbl, 5, "asc", colTbl, colDefTbl, false, false, false, afterAjaxTbl);
}

function btnTagihan() {
    $('#tbl_tagihan tbody').on('click', '.billing-btn', function (e) {
        e.preventDefault();
        common.loadingMessage("Memproses", "Mohon sabar menunggu");
        var data = $("#tbl_tagihan").DataTable().row($(this).parents("tr")).data();
        createBilling(data);
    });

    $('#tbl_tagihan tbody').on('click', '.print-btn', function (e) {
        e.preventDefault();
        var data = $("#tbl_tagihan").DataTable().row($(this).parents("tr")).data();
        common.loadingMessage("Memproses Cetakan Billing", "Mohon sabar menunggu");
        setTimeout(function () {
            reportBilling(data);
        }, 1000);
    });
}

function createBilling(data) {

    var paramAjax = {
        msPajak: $('#period').val(),
        thnPajak: $('#year').val(),
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
                }else{
                    common.showMessage("Kesalahan", "Tahun Pajak dan/atau Masa Pajak tidak boleh kosong.", "error", "Tutup");
                }
            };
            if(data.data.responseCode != "00"){
                common.showMessageWithAction("Error", data.data.responseDescription, "error", "Batal", actSwal);
            }else{
                common.showMessageWithAction("Sukses", data.data.responseDescription, "success", "Oke", actSwal);
            }
        } else if (data.code == 9) {
            var actErrorMessage = function () {
                location.reload();
            };
            common.showMessageWithAction("Kesalahan", data.error_msg, "error", "Tutup", actErrorMessage);
        } else {
            common.showMessage("Kesalahan", data.error_msg, "error", "Tutup");
        }
    };

    common.ajaxJsonPost(function () {}, paramAjax, "/api/spt/create_billing", ajaxDone);
}

function reportBilling(data) {
    var paramAjaxRequest = {
        kdBilling: data.kdBilling
    };

    var doneAjaxRequest = function (dataCetakan) {
        if (dataCetakan.code == 1) {
            swal.close();
            $('#modal_cetak').modal('show');
            $('#isi_cetak').html('<object class="pdf-content" data="data:application/pdf;base64,' + dataCetakan.data + '" type="application/pdf" width="100%" height="450px"></object>');
            
        } else {
            common.showMessage("Kesalahan", dataCetakan.error_msg, "error", "Tutup");
        }
    };
    common.ajaxJsonPost(function () {
    }, paramAjaxRequest, "/api/spt/report_billing", doneAjaxRequest);
}

function tblPembayaran() {
    var idTbl = "tbl_pembayaran";
    var paramTbl = {
        spt_id: $('#spt_id').val(),
        msPajak: $('#period').val(),
        thnPajak: $('#year').val()
    };
    var urlTbl = "/api/spt/dftr_pembayaran";
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
            className: 'text-end',
            render: function (data, type, full, meta) {
                return common.formatNumber(data);
            }
        },
        {
            targets: -1,
            responsivePriority: 1,
            orderable: false,
            className: 'text-center',
            render: function (data, type, full, meta) {
                return '<button type="button"' +
                    'class="btn btn-icon btn-active-light-primary w-25px h-25px delete-btn"'+
                    'data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus Bukti Setor">' +
                    '<i class="fa fa-trash-alt text-danger"></i>' +
                    '</button>'
            }
        }
    ];
    var afterAjaxTbl = function () {
        if (!called2) {
            called2 = true;
            btnHapus();
        }
    };
    common.generateTable(idTbl, urlTbl, paramTbl, 5, "asc", colTbl, colDefTbl, false, false, true, afterAjaxTbl);
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
                        deleteBuktiPenyetoran(data.id);
                    }else {
                        common.showMessage("Kesalahan", "Bukti Penyetoran telah digunakan untuk Pelaporan SPT", "error", "Tutup");
                    }
                } else if (dataCek.code == 9) {
                    var actErrorMessage = function () {
                        location.reload();
                    };
                    common.showMessageWithAction("Kesalahan", dataCek.error_msg, "error", "Tutup", actErrorMessage);
                } else {
                    common.showMessage("Kesalahan", dataCek.error_msg, "error", "Tutup");
                }
            };
            common.ajaxJsonPost(function () {}, paramAjax, "/api/spt/check_buktisetor", ajaxDone);
        };
        common.showMessageQuestionWithAction("Hapus Bukti Setor", "Apakah Anda yakin akan menghapus Bukti Setor?", "Oke", "Batal", actDoneDelete);
    });
}

function deleteBuktiPenyetoran(id) {
    var paramAjax = {
        fgSsKb: "0",
        id: id,
        spt_id: $('#spt_id').val()
    };
    var ajaxDone = function (data) {
        if (data.code == 1) {
            var actSwal = function () {
                tblPembayaran();
            };
            common.showMessageWithAction("Sukses", "Data berhasil dihapus.", "success", "Oke", actSwal);
        } else if (data.code == 9) {
            var actErrorMessage = function () {
                location.reload();
            };
            common.showMessageWithAction("Kesalahan", data.error_msg, "error", "Tutup", actErrorMessage);
        } else {
            common.showMessage("Kesalahan", data.error_msg, "error", "Tutup");
        }
    };

    common.ajaxJsonPost(function () {}, paramAjax, "/api/spt/delete_buktisetor", ajaxDone);
}

function formPembayaran() {
    $('#btnSubmit').prop('disabled', true);
    ($('input[name="fgPbkBpe"]:checked').val() === "0") ? $('#fgPbkPbe1Div').hide() && $('#thnPajak').closest('.form-group').hide() : $('#fgPbkPbe0Div').hide() && $('#thnPajak').closest('.form-group').show();
    $('input[name="fgPbkBpe"]').on('change', function () {
        $('#noBpe').val('');
        $('#thnPajakBpe').val('').change();
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
        $('#thnPjk').val($('#year').val()).change();
        $('#msPjk').val($('#period').val()).change();
        $('input[name="optSsp"]').prop("checked", false).change();
    });

    $('#btnSearchBpe').on('click', function () {
        //Ajax BPE
        common.loadingMessage("Memproses", "Mohon sabar menunggu");
        setTimeout(function () {
            searchBpe();
        }, 1000);

        function searchBpe() {
            var paramAjakBpe = {
                // npwpSsp: $('#npwpSsp').inputmask("unmaskedvalue"),
                ntpn: $('#noBpe').val(),
                thnPajak: $('#thnPajakBpe').val()
            };

            var doneAjaxBpe = function (data) {
                if (data.code == 1) {
                    common.showMessage("", "Data ditemukan.", "success", "Oke");
                    insertData(data);
                    disableData();
                    $('#btnSubmit').prop('disabled', false);
                } else if (data.code == 9) {
                    var actErrorMessage = function () {
                        location.reload();
                    };
                    common.showMessageWithAction("Kesalahan", data.error_msg, "error", "Tutup", actErrorMessage);
                } else {
                    common.showMessage("Kesalahan", data.error_msg, "error", "Tutup");
                }
            };

            common.ajaxJsonPost(function () {
            }, paramAjakBpe, "/api/common/check_ntpn", doneAjaxBpe);
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
        common.loadingMessage("Memproses", "Mohon sabar menunggu");
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
                $('input[name="optSsp"]').prop("checked", false).change();
                if (data.code == 1) {
                    var actErrorMessage = function () {
                        tblPembayaran();
                        $('#thnPjk').val($('#year').val()).change();
                        $('#msPjk').val($('#period').val()).change();
                    };
                    common.showMessageWithAction("Sukses", "Data berhasil disimpan.", "success", "Oke", actErrorMessage);
                } else {
                    var actErrorMessage = function () {
                        location.reload();
                    };
                    common.showMessageWithAction("Kesalahan", data.error_msg, "error", "Tutup", actErrorMessage);
                }
            };

            common.ajaxJsonPost(function () {
            }, paramAjakSave, "/api/spt/save_buktisetor", doneAjaxSave);
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
        $('#thnPajak').val(data.data.thPajak);
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
        $('#thnPajakBpe').val('').change();
        $('#form_pembayaran input,select').prop("disabled", false);
        $('#btnSearchBpe').prop("disabled", false);
        $('#btnSearchPbk').prop("disabled", false);
        ($('input[name="fgPbkBpe"]:checked').val() === "0") ? $('#fgPbkPbe1Div').hide() && $('#fgPbkPbe0Div').show() && $('#thnPajak').closest('.form-group').hide() : $('#fgPbkPbe1Div').show() && $('#fgPbkPbe0Div').hide() && $('#thnPajak').closest('.form-group').show();
    }
}
