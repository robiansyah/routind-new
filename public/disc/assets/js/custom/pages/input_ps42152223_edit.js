var code, idBupot, revNo, noBupot, tglPemotongan;
if($('#jenis-input').val() === "Perekaman"){
    code = "0";
    idBupot = null;
    revNo = "0";
    noBupot = "";
    tglPemotongan = $('#tglApp').val();
} else{
    code = "1";
    idBupot = $('#idBupot').val();
    noBupot = $('#noBupot').val();
    if($('#fgLapor').val()==="1"){
        var rev = parseInt($('#revNo').val()) + 1;
        revNo = rev.toString();
    }else{
        revNo = $('#revNo').val();
    }
    tglPemotongan = $('#tglPemotongan').val();
}
var dateParts = $('#tglApp').val().toString().split("/");
var dateToday = new Date(+dateParts[2], dateParts[1] - 1, +dateParts[0]);

$(document).ready(function () {
    $('#tglDokDasar').flatpickr();
    $('#btnSubmit').prop('disabled', true);
    if(code === "1"){
        editForm();
    }else{
        $('#optIdentitas1').prop('checked', true);
    }
    if ($('#msgError').val() !== "") {
        var actErrorMessage = function () {
            window.location.href = "/ebupot/pph/dftr-ps42152223";
        };
        common.showMessageWithAction("Kesalahan", $('#msgError').val(), "error", "Tutup", actErrorMessage);
    }
    $('#btnReset').on('click', function () {
        window.location.href = "/ebupot/pph/dftr-ps42152223";
    });

    if($('input[name="optIdentitas"]:checked').val() === "0") {
        $('#div-nik').hide();
        $('#nik').val("9999999999999999");
    }else{
        $('#div-npwp').hide();
        $('#npwp').val("9999999999999999");
    }
    $('input[name="optIdentitas"]').on('change', function () {
        if ($('input[name="optIdentitas"]:checked').val() === "0") {
            $('#nik').val("9999999999999999");
            $('#npwp').val("");
            $('#div-nik').hide();
            $('#div-npwp').show();
            $('input[name="optFasilitas"]').prop("disabled", false);
        } else {
            $('#nik').val("");
            $('#npwp').val("9999999999999999");
            $('#div-nik').show();
            $('#div-npwp').hide();
            $('input[name="optFasilitas"]').prop("disabled", true);
            $('#optFasilitas1').prop("disabled", false);
            $('#optFasilitas1').prop('checked', true).change();
            if ($('#optNik').val() === "1"){
                $('.cek-nik').show();
            }
        }
    });
    
    masking();
    thnPajak();
    onKeyUp();
    form();
    validasiFormDok();
    submitAllForm();
});

function editForm() {
    $('#thnPjk').val($('#val-thnPjk').val()).change();
    console.log($('#val-thnPjk').val());
    $('#thnPjk').prop('disabled', true);
    $('#msPjk').append('<option value="'+$('#val-msPjk').val()+'" selected="selected">'+getMonthName($('#val-msPjk').val())+'</option>').change();

    if($('#status-bupot').val() == 'Pembetulan'){
        $('#optIdentitas1').prop('disabled', true);
        $('#optIdentitas2').prop('disabled', true);
        $('#npwp').prop('readonly', true);
        $('#nik').prop('readonly', true);
    }

    if($('#fgIdentitas').val() === "0"){
        $('#optIdentitas1').prop('checked', true);
        $('#npwp').val($('#idDipotong').val()).trigger('keyup');
    }
    else {
        $('#optIdentitas2').prop('checked', true);
        $('#nik').val($('#idDipotong').val()).trigger('keyup');
    }
    
    common.loadingMessage("Memproses", "Mohon sabar menunggu");
    setTimeout(function () {
        getObjPajak();
    }, 1000);
    $('input[name="optFasilitas"][value="'+$('#val-fgFasilitas').val()+'"]').prop('checked', true).change();
    switch ($('input[name="optFasilitas"]:checked').val()) {
        case "1":
            $('#noSkb').prop('readonly', false);
            break;
        case "3":
            $('#noAturanDtp').prop('readonly', false);
            break;
        case "4":
            $('#noSKPP23').prop('readonly', false);
            break;
        case "5":
            $('#noDokLainnya').prop('readonly', false);
            $('#tarif').prop('readonly', false);
            $('#pphDipotong').prop('readonly', false);
            break;
        default:
            break;
    }
    $('input[name="fgPengembalian"][value="'+$('#val-fgPengembalian').val()+'"]').prop('checked', true).change();
}

function getMonthName(monthNumber) {
    var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    return months[monthNumber - 1];
}

function getDocumentName(kdDokumen) {
    var nmDok = ['Faktur Pajak', 'Invoice', 'Pengumuman', 'Surat Perjanjian', 'Bukti Pembayaran', 'Akta Perikatan', 'Akta RUPS', 'Surat Pernyataan'];
    var index = parseInt(kdDokumen) - 1;
    return nmDok[index];
}

function masking() {
    $(".currency").each(function () {
        $(this).inputmask({
            alias: "currency",
            prefix: "",
            groupSeparator: ".",
            digits: "0",
            min: 0
        });
    });
    $(".percent").each(function () {
        $(this).inputmask({
            alias: "percentage",
            digits: "2",
        });
    });
    $("#npwp").inputmask({regex: '^[0-9]{16}$'});
    $("#nik").inputmask({regex: '^[1-9][0-9]{15}$'});
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
//            if ($('#thnPjk').val() === (dateToday.getFullYear()).toString()) end = parseInt(dateToday.getMonth() + 1);
            for (i; i <= end; i++) {
                if(i.toString().length === 1){
                    var kode = "0"+i.toString();
                } else{
                    var kode = i.toString();
                }
                opt = opt + "<option value='" + kode + "'>" + getMonthName(i) + "</option>"
            }
            $('#msPjk').prop("disabled", false);
            $('#msPjk').append(opt).change();
            if($('#thnPjk').val() === (dateToday.getFullYear()).toString()){
                $('#msPjk option').filter(function () { return $(this).html() == getMonthName(dateToday.getMonth() + 1); }).first().prop('selected', true).change();
            }
        }
    });
}

function onKeyUp() {
    $('#nik').on('keyup', function () {
        var valCheck = $(this).val().substr(12, 3);
        if (valCheck == '000') {
            $("#nik").inputmask({regex: '^[1-9][0-9]{14}[1-9]{1}$'});
        } else {
            $("#nik").inputmask({regex: '^[1-9][0-9]{15}$'});
        }
    });
}

function getObjPajak() {
    //Ajax Obj Pajak
    var paramAjax = {
        jnsTrx: code,
        idBupot: idBupot,
        kdbupot: "0",
        thnPajak: $('#thnPjk').val(),
        msPajak: $('#msPjk').val()
    };

    var doneAjax = function (data) {
        if (data.code == 1) {
            swal.close();
            var strOpt = "<option></option>";
            $.each(data.data, function (key, value) {
                strOpt = strOpt + "<option value='" + value.kdObjPjk + "' data-jnspajak='"+value.kdJnsPjk+ "' data-fgfinal='"+value.fgFinal+"'>" +value.kdObjPjk+" "+ value.nmObjkPjk + "</option>";
            });
            $('#objPjk').empty().trigger("change");
            $('#objPjk').append(strOpt).change();
            if($('#val-objPjk').val() !== ""){
                $('#objPjk').val($('#val-objPjk').val()).change();
                if($('#objPjk option:selected').attr('data-fgfinal') === "0" && $('input[name="optIdentitas"]:checked').val() === "1"){
                    $('#info-tarif').show();
                }else{
                    $('#info-tarif').hide();
                }
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

    common.ajaxJsonPost(function () {
    }, paramAjax, "/api/common/obj_pjk_pphall", doneAjax);
}

function form() {
    $("#msPjk").on("change", function () {
        common.loadingMessage("Memproses", "Mohon sabar menunggu");
        setTimeout(function () {
            getObjPajak();
        }, 1000);
    });

    $('#objPjk').on('change', function () {
        $('input[name="optFasilitas"]').prop("disabled", false);
        if ($('#objPjk').val() !== "" && $('#objPjk').val() !== null) {
            $('#objPjk').closest('.form-group').removeClass('has-error');
            $('#objPjk').closest('.form-group.form-group-md').find('span.invalid-feedback').hide();

            if($("#objPjk").val() == "28-423-01"){
                $('#optFasilitas4').prop('checked', true).change();
                $('#optFasilitas1').prop("disabled", true);
                $('#optFasilitas2').prop("disabled", true);
                $('#optFasilitas5').prop("disabled", true);
            }else{
                $('#optFasilitas1').prop('checked', true).change();
            }
            getTarif();
        }
    });

    $('input[name="optFasilitas"]').on('change', function () {
        $('.inputFas').closest('.form-group').removeClass('has-error');
        $('.inputFas').removeClass('is-invalid');
        $('.inputFas').closest('.form-group.form-group-md').find('span.invalid-feedback').hide();
        $('.inputFas').closest('.kt-input-icon').find('.status-icon').remove();
        $('.inputFas').val('');
        $('.inputFas').prop('readonly', true);
        $('#tarif').prop('readonly', true);
        $('#pphDipotong').prop('readonly', true);
        if ($('input[name="optFasilitas"]:checked').val() !== "5" && $('#objPjk').val() !== "" && $('#objPjk').val() !== null) {
            getTarif()
        } else {
            $('#tarif').val("");
            $('#pphDipotong').val("");
        }
        switch ($('input[name="optFasilitas"]:checked').val()) {
            case "1":
                $('#noSkb').prop('readonly', false);
                break;
            case "3":
                $('#noAturanDtp').prop('readonly', false);
                break;
            case "4":
                $('#noSKPP23').prop('readonly', false);
                break;
            case "5":
                $('#noDokLainnya').prop('readonly', false);
                $('#tarif').prop('readonly', false);
                $('#pphDipotong').prop('readonly', false);
                break;
            default:
                break;
        }
    });

    $('#jmlBruto').on("keyup", function () {
        switch ($('input[name="optFasilitas"]:checked').val()) {
            case "0":
                var cek = true;
                break;
            case "3":
                var cek = true;
                break;
            case "4":
                var cek = true;
                break;
            default:
                var cek = false;
                break;
        }
        if ($('#jmlBruto').inputmask('unmaskedvalue') !== "" && cek) {
            var jmlBruto = parseInt($('#jmlBruto').inputmask('unmaskedvalue'));
            var tarif = parseFloat($('#tarif').inputmask('unmaskedvalue'));
            var kdJnsPjk = $('#objPjk option:selected').attr('data-jnspajak');
            var tariflt = (($('input[name="optIdentitas"]:checked').val() !== "0")
                && (kdJnsPjk === "PPH22" || kdJnsPjk === "PPH23")
                && ($('#objPjk option:selected').attr('data-fgfinal') === "0")) ? 100 : 0;
            var pph = (jmlBruto * (tarif / 100))+(jmlBruto * (tarif / 100) * (tariflt / 100));
            $('#pphDipotong').val(Math.floor(pph)).trigger('keyup');
            if(tariflt === 100){
                $('#info-tarif').show();
            }else{
                $('#info-tarif').hide();
            }
        }
        var jmlBruto = parseInt($('#jmlBruto').inputmask('unmaskedvalue'));
        var jmlpphDipotong = parseInt($('#pphDipotong').inputmask('unmaskedvalue'));
        var fgBruto = (jmlBruto != "")?jmlBruto >= jmlpphDipotong:false;
        if(jmlpphDipotong < 0)fgBruto=false;
        if(fgBruto){
            $('#pphDipotong-errorCustom').hide();
            $('#btnNext2').prop('disabled', false);
        }else{
            $('#pphDipotong-errorCustom').show();
            $('#btnNext2').prop('disabled', true);
        }
    });

    $('#pphDipotong').on("keyup", function () {
        var jmlBruto = parseInt($('#jmlBruto').inputmask('unmaskedvalue'));
        var jmlpphDipotong = parseInt($('#pphDipotong').inputmask('unmaskedvalue'));
        var fgBruto = (jmlBruto != "")?jmlBruto >= jmlpphDipotong:false;
        if(jmlpphDipotong < 0)fgBruto=false;
        if(fgBruto){
            $('#pphDipotong-errorCustom').hide();
            $('#btnNext2').prop('disabled', false);
        }else{
            $('#pphDipotong-errorCustom').show();
            $('#btnNext2').prop('disabled', true);
        }
    });

    $('#noSkb').on('blur', function () {
        if ($(this).val() !== "" && $(this).val() !== null) {
            var beforeAjax = function () {
                $('#noSkb').closest('.kt-input-icon').children('.status-icon').remove();
            };

            var paramAjax = {
                jnsTrx: code,
                idBupot: idBupot,
                msPajak: $('#msPjk').val(),
                thnPajak: $('#thnPjk').val(),
                npwp: $('#npwp').inputmask('unmaskedvalue'),
                noSKB: $('#noSkb').val(),
                kdJnsPjk: $('#objPjk option:selected').attr('data-jnspajak'),
                kdObjPjk: $('#objPjk').val()
            };

            var doneAjax = function (data) {
                if (data.code == 1) {
                    common.checkStatus('noSkb', true);
                } else if (data.code == 9) {
                    var actErrorMessage = function () {
                        location.reload();
                    };
                    common.showMessageWithAction("Kesalahan", data.error_msg, "error", "Tutup", actErrorMessage);
                } else {
                    common.showMessage("Kesalahan", data.error_msg, "error", "Tutup")
                    common.checkStatus('noSkb', false);
                    $('#noSkb').val("");
                }
            };

            common.ajaxJsonPost(beforeAjax, paramAjax, "/api/pph/check_noskb", doneAjax);
        }
    });

    $('#noSKPP23').on('blur', function () {
        if ($(this).val() !== "" && $(this).val() !== null) {
            var beforeAjax = function () {
                $('#noSKPP23').closest('.kt-input-icon').children('.status-icon').remove();
            };

            var paramAjax = {
                jnsTrx: code,
                idBupot: idBupot,
                msPajak: $('#msPjk').val(),
                thnPajak: $('#thnPjk').val(),
                npwp: $('#npwp').inputmask('unmaskedvalue'),
                noSuket: $('#noSKPP23').val(),
                kdObjPjk: $('#objPjk').val()
            };
            var doneAjax = function (data) {
                if (data.code == 1) {
                    common.checkStatus('noSKPP23', true);
                } else if (data.code == 9) {
                    var actErrorMessage = function () {
                        location.reload();
                    };
                    common.showMessageWithAction("Kesalahan", data.error_msg, "error", "Tutup", actErrorMessage);
                } else {
                    common.showMessage("Kesalahan", data.error_msg, "error", "Tutup");
                    common.checkStatus('noSKPP23', false);
                    $('#noSKPP23').val("");
                }
            };

            common.ajaxJsonPost(beforeAjax, paramAjax, "/api/pph/check_nopp23", doneAjax);
        }
    });

    function getTarif() {
        var paramAjaxRequest = {
            jnsTrx: code,
            idBupot: idBupot,
            kdObjPjk: $('#objPjk').val(),
            thnPajak: $('#thnPjk').val(),
            msPajak: $('#msPjk').val()
        };

        var doneAjaxRequest = function (data) {
            if (data.code == 1) {
                $('#tarif').val(data.data.tarif).trigger('keyup');
                switch ($('input[name="optFasilitas"]:checked').val()) {
                    case "0":
                        var cek = true;
                        break;
                    case "3":
                        var cek = true;
                        break;
                    case "4":
                        var cek = true;
                        break;
                    default:
                        var cek = false;
                        break;
                }
                if ($('#jmlBruto').inputmask('unmaskedvalue') !== "" && cek) {
                    var jmlBruto = parseInt($('#jmlBruto').inputmask('unmaskedvalue'));
                    var tarif = parseFloat($('#tarif').inputmask('unmaskedvalue'));
                    var kdJnsPjk = $('#objPjk option:selected').attr('data-jnspajak');
                    var tariflt = (($('input[name="optIdentitas"]:checked').val() !== "0")
                        && (kdJnsPjk === "PPH22" || kdJnsPjk === "PPH23")
                        && ($('#objPjk option:selected').attr('data-fgfinal') === "0")) ? 100 : 0;
                    var pph = (jmlBruto * (tarif / 100))+(jmlBruto * (tarif / 100) * (tariflt / 100));
                    if(tariflt === 100){
                        $('#info-tarif').show();
                    }else{
                        $('#info-tarif').hide();
                    }
                } else {
                    var pph = 0;
                }
                $('#pphDipotong').val(Math.floor(pph)).trigger('keyup');
            } else {
                common.showMessage("Kesalahan", data.error_msg, "error", "Tutup");
            }
        };
        common.ajaxJsonPost(function () {
        }, paramAjaxRequest, "/api/common/get_tarif", doneAjaxRequest);
    }

    $("#tbl_dokdasarpot").DataTable({
        searching: false,
        bDestroy: true,
        lengthMenu: [
            [5, 10, 25, 30],
            [5, 10, 25, 30],
        ],
        pageLength: 5,
        processing: true,
        language: {
            processing:
                '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Sedang memproses...</span>',
            sLengthMenu: "Tampilkan _MENU_ entri",
            sZeroRecords: "Tidak ditemukan",
            sInfo: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
            sInfoEmpty: "Menampilkan 0 sampai 0 dari 0 entri",
            sInfoFiltered: "(disaring dari _MAX_ entri keseluruhan)",
            sInfoPostFix: "",
            sSearch: "Cari:",
            sUrl: "",
            oPaginate: {
                sFirst: "Pertama",
                sPrevious: "Sebelumnya",
                sNext: "Selanjutnya",
                sLast: "Terakhir"
            }
        },
        columns: [
            {data: "nmDokDasar"},
            {data: "noDokDasar"},
            {data: "tglDokDasar"},
            {data: "idDokDasar"}
        ],
        columnDefs: [
            {
                targets: 0,
                responsivePriority: 1,
                className: 'text-center',
                render: function (data, type, full, meta) {
                    return getDocumentName(full.nmDokDasar);
                }
            },
            {
                targets: [1,2],
                className: 'text-center'
            },
            {
                targets: -1,
                responsivePriority: 1,
                orderable: false,
                className: 'text-center',
                render: function (data, type, full, meta) {
                    return '<button type="button" ' +
                        'class="btn btn-icon btn-active-light-primary w-25px h-25px remove-btn" ' +
                        'data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Dokumen"> ' +
                        '<i class="fa fa-trash-alt"></i>' +
                        '</button>';
                }
            }
        ],
        drawCallback: function (settings) {
            $('[data-bs-toggle="tooltip"]').tooltip({
                trigger: "hover",
            });
        }
    });

    $('#btn-add-dokdasar').on('click', function () {
        $('#modal_dokumen').modal('show');
    });

    $('#nmDokDasar').on('change', function () {
        if ($('#nmDokDasar').val() !== "" && $('#nmDokDasar').val() !== null) {
            $('#nmDokDasar').closest('.form-group').removeClass('has-error');
            $('#nmDokDasar').closest('.form-group.form-group-md').find('span.invalid-feedback').hide();
        }
    });

    $('#tbl_dokdasarpot tbody').on( 'click', '.remove-btn', function () {
        $('#tbl_dokdasarpot').DataTable()
            .row( $(this).parents('tr') )
            .remove()
            .draw();
        $('.tooltip').remove();
    } );
}

function validasiFormDok() {
    //Form Validate
    $("#form_c_ps42152223").validate({
        errorElement: 'div', //default input error message container
        errorClass: 'fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback', // default input error message class
        rules: {
            nmDokDasar : {
                required: true,
            },
            noDokDasar : {
                required: true,
            },
            tglDokDasar : {
                required: true,
            },
            
        },
    });

    var actFormC = function () {
        var idDokDasar = new Date().getTime();
        var nmDokDasar = $('#nmDokDasar').val();
        var noDokDasar = $('#noDokDasar').val();
        var tglDokDasar = $('#tglDokDasar').val();
        $("#tbl_dokdasarpot").DataTable().row.add( {
            "idDokDasar": idDokDasar,
            "nmDokDasar": nmDokDasar,
            "noDokDasar": noDokDasar,
            "tglDokDasar": tglDokDasar
        } ).draw();
        $('#modal_dokumen').modal('hide');
        $('#form_c_ps42152223').trigger("reset");
        $('#nmDokDasar').val('').trigger("change");
    };
    
    $('#btnSubmitC').on("click", function () {
        if($("#form_c_ps42152223").valid()){
            actFormC();
        }
    });
}

function submitAllForm() {
    $("#formRekam").validate({
        errorElement: 'div', //default input error message container
        errorClass: 'fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback', // default input error message class
        rules: {
            namaDipotong : {
                required: true,
            },
            almtDipotong : {
                required: true,
            },
            objPjk : {
                required: true,
            },
            jmlBruto : {
                required: true,
            },
            noSkb : {
                required: '#optFasilitas2:checked',
            },
            noAturanDtp : {
                required: '#optFasilitas3:checked',
            },
            noSKPP23 : {
                required: '#optFasilitas4:checked',
            },
            noDokLainnya : {
                required: '#optFasilitas5:checked',
            },
        },
    });

    $('#fgSetuju').on("change", function () {
        if($(this).prop('checked')){
            if($('#tbl_dokdasarpot').DataTable().data().count() > 0 ){
                $('#btnSubmit').prop('disabled', false);
            }else{
                common.showMessage("Dokumen Kosong", 'Harap masukkan data Dokumen Dasar Pemotongan minimal 1 Dokumen', "error", "Tutup")
                $(this).prop('checked', false);
            } 
        }else{
            $('#btnSubmit').prop('disabled', true);
        }
    });

    $('#btnSubmit').on("click", function () {
        if($("#formRekam").valid()){
            common.loadingMessage("Memproses", "Mohon sabar menunggu");
            setTimeout(function () {
                submit();
            }, 1000);
        }

        function submit() {
            if ($('input[name="optIdentitas"]:checked').val() === "0") {
                var identitas = $('#npwp').inputmask('unmaskedvalue');
            } else {
                var identitas = $('#nik').inputmask('unmaskedvalue');
            }

            if ($('input[name="optQq"]').prop('checked')) {
                var optQq = "1";
            } else {
                var optQq = "0";
            }

            var arrDoc = [];
            $.each($('#tbl_dokdasarpot').DataTable().data(), function (key, value) {
                var doc = {
                    jnsDok : value.nmDokDasar,
                    namaDok : getDocumentName(value.nmDokDasar),
                    nomorDok: value.noDokDasar,
                    tglDok: value.tglDokDasar
                };
                arrDoc.push(doc);
            });

            var kdJnsPjk = $('#objPjk option:selected').attr('data-jnspajak');

            var trf = ($('#tarif').inputmask('unmaskedvalue')).toString();
            var tarif = (trf.indexOf('.') == -1)? trf+".00":trf;

            var paramAjax = {
                jnsTrx: code,
                idBupot: idBupot,
                thnPajak: $('#thnPjk').val(),
                msPajak: $('#msPjk').val(),
                noBupot: noBupot,
                npwpPemotong: $('#npwpUser').val(),
                fgIdDipotong: $('input[name="optIdentitas"]:checked').val(),
                idDipotong: identitas,
                namaDipotong: $('#namaDipotong').val().toUpperCase(),
                // fgQq: optQq,
                // namaQq: $('#namaQq').val().toUpperCase(),
                almtDipotong: $('#almtDipotong').val().toUpperCase(),
                kelDipotong: ($('#fgNikErr').val() === "1") ? $('#kelManual').val() : $('#kelDipotong').val(),
                kecDipotong: ($('#fgNikErr').val() === "1") ? $('#kecManual').val() : $('#kecDipotong').val(),
                kotaDipotong: ($('#fgNikErr').val() === "1") ? $('#kabManual').val() : $('#kotaDipotong').val(),
                provDipotong: ($('#fgNikErr').val() === "1") ? $('#provManual').val() : $('#provDipotong').val(),
                kdPosDipotong: $('#kdPosDipotong').val(),
                noTelpDipotong: $('#noTelpDipotong').val(),
                fgNikErr: "0",
                // alasanNikTanpaValidasi: $('#alasanNikTanpaValidasi').val().toUpperCase(),
                kdObjPjk: $('#objPjk').val(),
                kdJnsPjk: kdJnsPjk,
                fgFasilitas: $('input[name="optFasilitas"]:checked').val(),
                noSkb: $('#noSkb').val(),
                noAturanDtp: $('#noAturanDtp').val(),
                ntpnDtp: "",
                noSKPP23: $('#noSKPP23').val(),
                noDokLainnya: $('#noDokLainnya').val(),
                jmlBruto: $('#jmlBruto').inputmask('unmaskedvalue'),
                tarif: tarif,
                tarifLt: (($('input[name="optIdentitas"]:checked').val() !== "0")
                    && (kdJnsPjk === "PPH22" || kdJnsPjk === "PPH23")
                    && ($('#objPjk option:selected').attr('data-fgfinal') === "0")) ? "100" : "0",
                pphDipotong: $('#pphDipotong').inputmask('unmaskedvalue'),
                fgStatus: "0",
                revNo: revNo,
                tglPemotongan: tglPemotongan,
                fgTtdSebagai: $('#sbgTtd').val(),
                nikNpwpTtd: $('#penandatangan').val(),
                namaTtd: $('#penandatangan option:selected').text(),
                fgNikNpwpTtd: $('#penandatangan option:selected').attr('data-fg'),
                fgLbDiprosesOleh: $('input[name="fgPengembalian"]:checked').val(),
                dokDasarPemotongan: arrDoc,
                createdBy: "appEbupotWeb"
            };

            var doneAjax = function (data) {
                if (data.code == 1) {
                    var actErrorMessage = function () {
                        window.location.href = "/ebupot/pph/dftr-ps42152223";
                    };
                    var actReload = function () {
                        window.location.href = "/ebupot/pph/input-ps42152223";
                    };
                    if(code === "0") {
                        common.showMessageQuestionWithActionAndCancel("Sukses", "Data berhasil disimpan. Apakah Anda ingin merekam Bukti Potong Pasal 4(2), 15, 22, 23 lagi?", "success", "Ya", "Tidak", actReload, actErrorMessage);
                    }else{
                        common.showMessageWithAction("Sukses", "Data berhasil diubah.", "success", "Oke", actErrorMessage);
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

            common.ajaxJsonPost(function(){}, paramAjax, "/api/pph/save_ps42152223", doneAjax);
        }
    });
}