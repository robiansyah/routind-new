$(document).ready(function () {
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
    $("#noBpe").inputmask("****************");

    var code;
    ($('#jenis-input').val() === "Perekaman") ? code = 1 : code = 2;

    if (code === 1) {
        $('#fgPbkBpe0').prop('checked', true);
        $('#btnSubmit').prop('disabled', true);
    } else {
        if ($('#msgError').val() !== "") {
            var actErrorMessage = function () {
                window.location.href = "/ebupot/pph/dftr-disetor-sendiri";
            };
            common.showMessageWithAction("Kesalahan", $('#msgError').val(), "error", "Tutup", actErrorMessage);
        }
        $('#thnPajakBpe').val($('#val-thnPajakBpe').val()).trigger('change');
        $('#kdObjPajak').val($('#val-kdObjPajak').val()).trigger('change');
        disableData();
        common.loadingMessage("Memproses", "Mohon sabar menunggu");
        setTimeout(function () {
            if($('#status-bs').val() === 'Pembetulan'){
                $('#jmlSetor').prop('readonly', false);
                var dataEdit = {
                    data: {
                        kdMap: $('#kdMapEdit').val(),
                        kjs : $('#kjsEdit').val(),
                    }
                }
                getData(dataEdit, $('#msPjkEdit').val(), $('#thnPjkEdit').val());
            }else{
                if($('input[name="fgPbkBpe"]:checked').val() === "0"){
                    searchBpe();
                }else{
                    searchPbk();
                }
            }
        }, 1000);
    }

    $("#formRekamPphss").submit(function (e) {
        return false;
    });

    $('#btnReset').on('click', function () {
        // if (code === 1) {
        //     $('#btnSubmit').prop('disabled', true);
        //     $('#formRekamPphss').trigger("reset");
        //     $('#fgPbkBpe0').prop('checked', true);
        //     $('.djp-select2').val('').trigger('change');
        //     $('#kdObjPajak').empty().trigger("change");
        //     $('#kdObjPajak').append('<option></option>').trigger("change");
        //     $('#formRekamPphss input,select').prop("disabled", false);
        //     $('#btnSearchBpe').prop("disabled", false);
        //     $('#btnSearchPbk').prop("disabled", false);
        //     ($('input[name="fgPbkBpe"]:checked').val() === "0") ? $('#fgPbkPbe1Div').hide() && $('#fgPbkPbe0Div').show() && $('#thnPajak').closest('.form-group').hide() : $('#fgPbkPbe1Div').show() && $('#fgPbkPbe0Div').hide() && $('#thnPajak').closest('.form-group').show();
        // } else {
        window.location.href = "/ebupot/pph/dftr-disetor-sendiri";
        // }
    });

    ($('input[name="fgPbkBpe"]:checked').val() === "0") ? $('#fgPbkPbe1Div').hide() && $('#thnPajak').closest('.form-group').hide() : $('#fgPbkPbe0Div').hide() && $('#thnPajak').closest('.form-group').show();
    $('input[name="fgPbkBpe"]').on('change', function () {
        $('#noBpe').val('');
        $('#thnPajakBpe').val('').trigger('change');
        $('#noPbk').val('');
        ($('input[name="fgPbkBpe"]:checked').val() === "0") ? $('#fgPbkPbe1Div').hide() && $('#fgPbkPbe0Div').show() && $('#thnPajak').closest('.form-group').hide() : $('#fgPbkPbe1Div').show() && $('#fgPbkPbe0Div').hide() && $('#thnPajak').closest('.form-group').show();
    });

    $('#btnSearchBpe').on('click', function () {
        //Ajax BPE
        common.loadingMessage("Memproses", "Mohon sabar menunggu");
        setTimeout(function () {
            searchBpe();
        }, 1000);

    });

    $('#btnSearchPbk').on('click', function () {
        //Ajax BPE
        common.loadingMessage("Memproses", "Mohon sabar menunggu");
        setTimeout(function () {
            searchPbk();
        }, 1000);
    });

    $('#jmlPhBruto').on('keyup', function () {
        var jmlBruto = parseInt($(this).inputmask('unmaskedvalue'));
        var jmlSetor = parseInt($('#jmlSetor').inputmask('unmaskedvalue'));
        var fgBruto = (jmlSetor !== "")?jmlBruto >= jmlSetor:false;
        if(fgBruto){
            $('#jmlPhBruto-errorCustom').hide();
            $('#btnSubmit').prop('disabled', false);
        }else{
            $('#jmlPhBruto-errorCustom').show();
            $('#btnSubmit').prop('disabled', true);
        }
    });

    $('#jmlSetor').on('keyup', function () {
        var jmlBruto = parseInt($('#jmlPhBruto').inputmask('unmaskedvalue'));
        var jmlSetor = parseInt($(this).inputmask('unmaskedvalue'));
        var fgBruto = (jmlSetor !== "")?jmlBruto >= jmlSetor:false;
        if(fgBruto){
            $('#jmlPhBruto-errorCustom').hide();
            $('#btnSubmit').prop('disabled', false);
        }else{
            $('#jmlPhBruto-errorCustom').show();
            $('#btnSubmit').prop('disabled', true);
        }
    });

    //Form Validate
    $("#formRekamPphss").validate({
        errorElement: 'div', //default input error message container
        errorClass: 'fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback', // default input error message class
        rules: {
            kdObjPajak : {
                required: true,
            },
            jmlPhBruto : {
                required: true,
            },
        },
    });

    var actRekamPphss = function () {
        common.loadingMessage("Memproses", "Mohon sabar menunggu");
        setTimeout(function () {
            submitPphss();
        }, 1000);

        function submitPphss() {
            if (code === 1) {
                if ($('input[name="fgPbkBpe"]:checked').val() === "0") {
                    var nobktSetor = $('#noBpe').val();
                    var thnPajak = $('#thnPajakBpe').val();
                } else {
                    var nobktSetor = $('#noPbk').val();
                    var thnPajak = $('#thnPajak').val();
                }
                if ($('#jmlPhBruto').inputmask('unmaskedvalue') === "") {
                    var jmlBruto = "0";
                } else {
                    var jmlBruto = $('#jmlPhBruto').inputmask('unmaskedvalue');
                }
                var paramAjakSave = {
                    npwp: $('#npwp-user').val(),
                    npwpSsp: $('#npwp-user').val(),
                    noBuktiSetor: nobktSetor,
                    fgPbkBpe: $('input[name="fgPbkBpe"]:checked').val(),
                    fgSsKb:"1",
                    thnPajak: thnPajak,
                    msPajak: $('#masaPajak').val(),
                    kdMap: $('#jnsPajak').val(),
                    kdJnsSetor: $('#jnsSetoran').val(),
                    kdObjPajak: $('#kdObjPajak').val(),
                    jmlBruto: jmlBruto,
                    jmlSetor: $('#jmlSetor').inputmask('unmaskedvalue'),
                    tglSetor: $('#tglSetor').val()
                };

                var doneAjaxSave = function (data) {
                    if (data.code === 1) {
                        var actErrorMessage = function () {
                            window.location.href = "/ebupot/pph/dftr-disetor-sendiri";
                        };
                        common.showMessageWithAction("Sukses", "Data berhasil disimpan.", "success", "Oke", actErrorMessage);
                    } else if (data.code === 9) {
                        var actErrorMessage = function () {
                            location.reload();
                        };
                        common.showMessageWithAction("Kesalahan", data.error_msg, "error", "Tutup", actErrorMessage);
                    } else {
                        common.showMessage("Kesalahan", data.error_msg, "error", "Tutup");
                    }
                };

                common.ajaxJsonPost(function () {
                }, paramAjakSave, "/api/spt/save_bukti_setor", doneAjaxSave);
            } else {
                var paramAjakUpdate = {
                    id: $('#id').val(),
                    kdObjPajak: $('#kdObjPajak').val(),
                    jmlBruto: $('#jmlPhBruto').inputmask('unmaskedvalue'),
                    jmlSetor: $('#jmlSetor').inputmask('unmaskedvalue')
                };
                var doneAjaxUpdate = function (data) {
                    if (data.code === 1) {
                        var actErrorMessage = function () {
                            window.location.href = "/ebupot/pph/dftr-disetor-sendiri";
                        };
                        common.showMessageWithAction("Sukses", "Data berhasil diubah.", "success", "Oke", actErrorMessage);
                    } else if (data.code === 9) {
                        var actErrorMessage = function () {
                            location.reload();
                        };
                        common.showMessageWithAction("Kesalahan", data.error_msg, "error", "Tutup", actErrorMessage);
                    } else {
                        common.showMessage("Kesalahan", data.error_msg, "error", "Tutup");
                    }
                };
                common.ajaxJsonPost(function () {
                }, paramAjakUpdate, "/api/spt/edit_bukti_setor", doneAjaxUpdate);
            }
        }

    };

    $('#btnSubmit').on('click', function () {
        if($("#formRekamPphss").valid()){
            actRekamPphss();
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

    function getData(dataNtpn, mspjk, thnpjk) {
        //Ajax Obj Pajak
        var paramAjax = {
            kdMap: dataNtpn.data.kdMap,
            kjs : dataNtpn.data.kjs,
            mspjk: mspjk,
            thnpjk: thnpjk
        };

        var doneAjax = function (data) {
            if (data.code === 1) {
                var strOpt = "";
                $.each(data.data, function (key, value) {
                    strOpt = strOpt + "<option value='" + value.kdObjPjk + "'>" + value.kdObjPjk + " - " + value.nmObjkPjk + "</option>";
                });
                $('#kdObjPajak').append(strOpt).trigger('change');
                if($('#val-kdObjPajak').val() !== ""){
                    $('#kdObjPajak').val($('#val-kdObjPajak').val()).trigger('change');
                }
                swal.close();
            } else if (data.code === 9) {
                var actErrorMessage = function () {
                    location.reload();
                };
                common.showMessageWithAction("Kesalahan", data.error_msg, "error", "Tutup", actErrorMessage);
            } else {
                common.showMessage("Kesalahan", data.error_msg, "error", "Tutup");
            }
        };

        common.ajaxJsonPost(function () {
        }, paramAjax, "/api/common/obj_pjk_pphss", doneAjax);
    }

    function searchBpe() {
        var paramAjakBpe = {
            npwpSsp: $('#npwp-user').val(),
            ntpn: $('#noBpe').val(),
            thnPajak: $('#thnPajakBpe').val()
        };

        var doneAjaxBpe = function (data) {
            if (data.code === 1) {
                common.showMessage("", "Data ditemukan.", "info", "Oke");
                insertData(data);
                disableData();
                getData(data, data.data.msPajak, $('#thnPajakBpe').val());
                $('#btnSubmit').prop('disabled', false);
            } else if (data.code === 9) {
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

    function searchPbk() {
        var paramAjakPbk = {
            npwpPbk: $('#npwp-user').val(),
            noPbk: $('#noPbk').val()
        };

        var doneAjaxPbk = function (data) {
            if (data.code === 1) {
                common.showMessage("", "Data ditemukan.", "info", "Oke");
                insertData(data);
                disableData();
                getData(data, data.data.msPajak, data.data.thPajak);
                $('#btnSubmit').prop('disabled', false)
            } else if (data.code === 9) {
                var actErrorMessage = function () {
                    location.reload();
                };
                common.showMessageWithAction("Kesalahan", data.error_msg, "error", "Tutup", actErrorMessage);
            } else {
                common.showMessage("Kesalahan", data.error_msg, "error", "Tutup");
            }
        };

        common.ajaxJsonPost(function () {
        }, paramAjakPbk, "/api/common/check_pbk", doneAjaxPbk);
    }
});