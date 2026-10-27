$(document).ready(function () {
    if ($('input[name="optIdentitas"]:checked').val() === "0") {
        $('#nik').closest('.form-group').hide();
        $('.cek-nik').hide();
    } else {
        $('#npwp').closest('.form-group').hide();
        $('.cek-nik').show();
        if($('#kdjnswp').val() == "1"){
            $('#optIdentitas2').prop("disabled", true);
        }
    }
    $("#npwp").inputmask({
        "mask": "99.999.999.9-999.999"
    });

    $("#nik").inputmask({regex: '^[1-9][0-9]{15}$'});
    $('#nik').val("9999999999999999");


    $('#formRekamPenandatangan').on('change', function () {
        if ($('input[name="optIdentitas"]:checked').val() === "0") {
            $('#nik').closest('.form-group').hide();
            $('#npwp').closest('.form-group').show();
        } else {
            $('#nik').closest('.form-group').show();
            $('#npwp').closest('.form-group').hide();
        }
    });

    $('input[name="optBertindak"]').on('change', function () {
        $('#optNikCb').prop("checked", false);
        $('#label-valid').text("Tidak Valid");
        $('#nama').val("");
        $('#npwp').prop("readonly", false);
        if ($('input[name="optBertindak"]:checked').val() === "1") {
            $('#optIdentitas2').prop("checked", false);
            $('#optIdentitas2').prop("disabled", true);
            $('#optIdentitas1').prop("checked", true);
            $('#nik').val("9999999999999999");
            $('#npwp').val("");
            $('.cek-nik').hide();
        } else {
            $('#optIdentitas2').prop("disabled", false);
            $('#nik').val("9999999999999999");
            $('#npwp').val("");
            if ($('#kdjnswp').val() == "1") {
                $('#npwp').val($('#npwpUser').val()).trigger("keyup");
                $('#npwp').prop("readonly", true);
                $('#optIdentitas2').prop("disabled", true);
            }
        }
    });

    $('input[name="optIdentitas"]').on('change', function () {
        $('#nama').val("");
        $('#optNikCb').prop("checked", false);
        $('#label-valid').text("Tidak Valid");
        if ($('input[name="optIdentitas"]:checked').val() === "0") {
            $('#nik').val("9999999999999999");
            $('#npwp').val("");
            $('.cek-nik').hide();
        } else {
            $('#nik').val("");
            $('#nama').prop("readonly", false);
            $('#npwp').val("999999999999999");
            if ($('#optNik').val() === "1") {
                $('.cek-nik').show();
            }
        }
    });

    $('#nik').on('keyup', function () {
        $('#optNikCb').prop("checked", false);
        $('#label-valid').text("Tidak Valid");
        var valCheck = $(this).val().substr(12, 3);
        if (valCheck == '000') {
            $("#nik").inputmask({regex: '^[1-9][0-9]{14}[1-9]{1}$'});
        } else {
            $("#nik").inputmask({regex: '^[1-9][0-9]{15}$'});
        }
    });

    $('#nama').on('keyup', function () {
        $('#optNikCb').prop("checked", false);
        $('#label-valid').text("Tidak Valid");
    });

    $('#btnCekNik').on('click', function () {
        if ($('#nik').val().length == 16 && $('#nik').val().indexOf("_") == -1 && $('#nama').val().length) {
            //Ajax NIK
            djpcommon.loadingMessage("Memproses", "Mohon sabar menunggu");
            setTimeout(function () {
                cekNik();
            }, 1000);

            function cekNik() {
                var beforeAjakNik = function () {
                };

                var paramAjakNik = {
                    nik: $('#nik').val(),
                    nama: $('#nama').val().toUpperCase(),
                    npwp: $('#npwpUser').val()
                };

                var doneAjaxNik = function (data) {
                    if (data.code == 1) {
                        djpcommon.showMessage("Informasi", "Data ditemukan.", "info", "Oke");
                        $('#optNikCb').prop("checked", true);
                        $('#label-valid').text("Valid");
                    } else if (data.code == 9) {
                        var actErrorMessage = function () {
                            location.reload();
                        };
                        djpcommon.showMessageWithAction("Kesalahan", data.error_msg, "error", "Tutup", actErrorMessage);
                    } else {
                        djpcommon.showMessage("Kesalahan", data.error_msg, "error", "Tutup");
                        $('#optNikCb').prop("checked", false);
                        $('#label-valid').text("Tidak Valid");
                    }
                };

                djpcommon.ajaxJsonPost(beforeAjakNik, paramAjakNik, ctx + "api/common/check_nik", doneAjaxNik);
            }

        } else {
            djpcommon.showMessage("Kesalahan", "Pastikan nama dan nik telah terisi dengan benar.", "error", "Tutup");
        }
    });

    $('#npwp').on('keyup', function () {
        if ($(this).val().length == 20 && $(this).val().indexOf("_") == -1) {
            //Ajax NPWP
            djpcommon.loadingMessage("Memproses", "Mohon sabar menunggu");
            setTimeout(function () {
                cekNpwp();
            }, 1000);

            function cekNpwp() {
                var beforeAjakNpwp = function () {
                    $('.status-icon').remove();
                    $('#nama').val("");
                };

                var paramAjakNpwp = {
                    npwp: djpcommon.unmaskNpwp('npwp')
                };

                var doneAjaxNpwp = function (data) {
                    if (data.code == 1 && data.data.kdjnswp == 1) {
                        $('#nama').val(data.data.namaWp);
                        djpcommon.checkStatus('npwp', true);
                        swal.close();
                    } else if (data.code == 1 && data.data.kdjnswp != 1) {
                        djpcommon.showMessage("Kesalahan", "NPWP yang dimasukkan hanya boleh Wajib Pajak Orang Pribadi.", "error", "Tutup");
                        djpcommon.checkStatus('npwp', false);
                    } else if (data.code == 9) {
                        var actErrorMessage = function () {
                            location.reload();
                        };
                        djpcommon.showMessageWithAction("Kesalahan", data.error_msg, "error", "Tutup", actErrorMessage);
                    } else {
                        djpcommon.showMessage("Kesalahan", data.error_msg, "error", "Tutup");
                        djpcommon.checkStatus('npwp', false);
                    }
                };

                djpcommon.ajaxJsonPost(beforeAjakNpwp, paramAjakNpwp, ctx + "api/common/check_npwp", doneAjaxNpwp);
            }
        } else {
            $('#nama').val("");
        }
    });

    //Form Validate
    var paramRekamPenandatangan = {
        nik: {
            required: true,
            noSpace: true
        },
        npwp: {
            required: true,
            noSpace: true
        },
        nama: {
            required: true
        }
    };

    var msgRekamPenandatangan = {};

    var actRekamPenandatangan = function () {

        if ($('#optNik').val() === "1") {
            if ($('#optNikCb').prop('checked') || $('input[name="optIdentitas"]:checked').val() === "0") {
                submitPenandatangan();
            } else {
                djpcommon.showMessage("NIK tidak valid", 'Pastikan NIK dan nama Anda sudah benar dan status valid telah aktif.', "error", "Tutup")
            }
        } else {
            submitPenandatangan();
        }

        function submitPenandatangan() {
            if ($('input[name="optIdentitas"]:checked').val() == 0) {
                var identitas = djpcommon.unmaskNpwp('npwp');
            } else {
                var identitas = $('#nik').val();
            }

            if ($('input[name="optStatus"]:checked').val() == 0) {
                var fgAktif = "0";
            } else {
                var fgAktif = "1";
            }

            djpcommon.loadingMessage("Memproses", "Mohon sabar menunggu");
            setTimeout(function () {
                submit();
            }, 1000);

            function submit() {
                var paramAjakSavePt = {
                    fgSebagai: $('input[name="optBertindak"]:checked').val(),
                    fgNikNpwp: $('input[name="optIdentitas"]:checked').val(),
                    nikNpwpTtd: identitas,
                    fgAktif: fgAktif,
                    nmWpTtd: $('#nama').val().toUpperCase()
                };

                var doneAjaxSavePt = function (data) {
                    if (data.code == 1) {
                        var actSavePt = function () {
                            location.reload();
                        };
                        djpcommon.showMessageWithAction("Sukses", "Data berhasil disimpan.", "success", "Tutup", actSavePt);
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
                }, paramAjakSavePt, ctx + "api/sign/save_pt", doneAjaxSavePt);
            }
        }

    };

    djpcommon.validateForm($('#formRekamPenandatangan'), paramRekamPenandatangan, msgRekamPenandatangan, actRekamPenandatangan);

    $('#btnReset').on('click', function () {
        $('#formRekamPenandatangan').trigger("reset");
    });

    tableDftrPt();
    $('#btn-cari').on('click', function () {
        tableDftrPt();
    });

    $('#opt-cari').on('change', function () {
        $('#input-cari').val("");
    });

    $("#form-cari").submit(function (e) {
        return false;
    });

    function tableDftrPt() {


        if ($('#opt-cari').val() === "") {
            $('#input-cari').val("");
            $('#input-cari').prop("disabled", true);
            var niknpwp = "";
            var namapt = "";
        } else if ($('#opt-cari').val() === "0") {
            $('#input-cari').prop("disabled", false);
            var niknpwp = $('#input-cari').val();
            var namapt = "";
        } else {
            $('#input-cari').prop("disabled", false);
            var niknpwp = "";
            var namapt = $('#input-cari').val();
        }
        $('#form-cari').on('change', function () {
            if ($('#opt-cari').val() === "") {
                $('#input-cari').val("");
                $('#input-cari').prop("disabled", true);
                var niknpwp = "";
                var namapt = "";
            } else if ($('#opt-cari').val() === "0") {
                $('#input-cari').prop("disabled", false);
                var niknpwp = $('#input-cari').val();
                var namapt = "";
            } else {
                $('#input-cari').prop("disabled", false);
                var niknpwp = "";
                var namapt = $('#input-cari').val();
            }
        });

        var tblDftrPt = "tbl_dftr_pt";
        var paramTblDftrPt = {
            criteria: $('#opt-cari').val(),
            niknpwp: niknpwp,
            namapt: namapt
        };
        var urlTblDftrPt = ctx + "api/sign/dftr_pt";
        var colTblDftrPt = [
            {data: "nikNpwpTtd"},
            {data: "nmWpTtd"},
            {data: "fgSebagai"},
            {data: "fgAktif"},
            {data: "fgAktif"}
        ];
        var colDefTblDftrPt = [
            {
                targets: 0,
                responsivePriority: 1,
                className: 'text-center',
                render: function (data, type, full, meta) {
                    if (full.fgNikNpwp === "0") {
                        var classIdentitas = "npwp-mask";
                    } else {
                        var classIdentitas = "";
                    }
                    return '<div class="' + classIdentitas + '" style="width: 100%;">' + data + '<div>';
                }
            },
            {
                targets: 1,
                responsivePriority: 3,
                className: 'text-center'
            },
            {
                targets: 2,
                responsivePriority: 5,
                className: 'text-center',
                render: function (data, type, full, meta) {
                    if (data == 0) {
                        var strSebagai = "Pengurus / Wajib Pajak"
                    } else {
                        var strSebagai = "Kuasa"
                    }
                    return strSebagai;
                }
            },
            {
                targets: 3,
                responsivePriority: 4,
                className: 'text-center',
                render: function (data, type, full, meta) {
                    if (data == 0) {
                        var icon = '<span class="kt-badge kt-badge--success kt-badge--inline kt-badge--pill kt-badge--rounded">Aktif</span>'
                    } else {
                        var icon = '<span class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill kt-badge--rounded">Tidak&nbsp;Aktif</span>'
                    }
                    return icon;
                }
            },
            {
                targets: -1,
                responsivePriority: 2,
                orderable: false,
                className: 'text-center',
                render: function (data, type, full, meta) {
                    return '<button type="button" ' +
                        'class="btn btn-djp btn-sm btn-elevate btn-circle btn-icon mb-1 mr-1 update-btn" ' +
                        'data-skin="djp" data-container="body" ' +
                        'data-toggle="kt-tooltip" data-placement="bottom" title="" ' +
                        'data-original-title="Aktikan/Nonaktifkan Penandatangan"> ' +
                        '<i class="fa fa-sync-alt"></i>' +
                        '</button>';
                }
            }
        ];

        var afterAjaxTblDftrPt = function () {

            $('#tbl_dftr_pt tbody').on('click', '.update-btn', function (e) {
                e.preventDefault();
                var data = $("#tbl_dftr_pt").DataTable().row($(this).parents("tr")).data()

                var idTtd = data.idTtd;
                if (data.fgAktif == 0) {
                    var fgAktif = "1";
                } else {
                    var fgAktif = "0";
                }

                djpcommon.loadingMessage("Memproses", "Mohon sabar menunggu");
                setTimeout(function () {
                    reverse();
                }, 1000);

                function reverse() {
                    var paramAjakFgAktif = {
                        idTtd: idTtd,
                        fgAktif: fgAktif
                    };

                    var doneAjaxFgAktif = function (data) {
                        if (data.code == 1) {
                            djpcommon.showMessage("Sukses", "Data berhasil diubah.", "success", "Tutup");
                            $("#tbl_dftr_pt").DataTable().ajax.reload();
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
                    }, paramAjakFgAktif, ctx + "api/sign/updt_pt", doneAjaxFgAktif);
                }
            });
        };

        djpcommon.generateTable(
            tblDftrPt,
            urlTblDftrPt,
            paramTblDftrPt,
            5,
            "asc",
            colTblDftrPt,
            colDefTblDftrPt,
            true,
            false,
            false,
            afterAjaxTblDftrPt);
    }
});