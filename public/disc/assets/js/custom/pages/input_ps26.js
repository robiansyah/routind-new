var code, idBupot, revNo, noBupot, tglPemotongan;
if ($('#jenis-input').val() === "Perekaman") {
    code = "0";
    idBupot = null;
    revNo = "0";
    noBupot = "";
    tglPemotongan = $('#tglApp').val();
} else {
    code = "1";
    idBupot = $('#idBupot').val();
    noBupot = $('#noBupot').val();
    if ($('#fgLapor').val() === "1") {
        var rev = parseInt($('#revNo').val()) + 1;
        revNo = rev.toString();
    } else {
        revNo = $('#revNo').val();
    }
    tglPemotongan = $('#tglPemotongan').val();
}
var dateParts = $('#tglApp').val().toString().split("/");
var dateToday = new Date(+dateParts[2], dateParts[1] - 1, +dateParts[0]);

$(document).ready(function () {
    $('.dates').flatpickr();
    $('#btnSubmit').prop('disabled', true);
    if(code === "1"){
        editForm();
    }
    if ($('#msgError').val() !== "") {
        var actErrorMessage = function () {
            window.location.href = "/ebupot/pph/dftr-ps26";
        };
        common.showMessageWithAction("Kesalahan", $('#msgError').val(), "error", "Tutup", actErrorMessage);
    }
    $('#btnReset').on('click', function () {
        window.location.href = "/ebupot/pph/dftr-ps26";
    });

    masking();
    thnPajak();
    formA();
    formB();
    formC();
    validasiFormDok();
    submitAllForm();
});

function editForm() {
    $('#thnPjk').val($('#val-thnPjk').val()).trigger('change');
    $('#thnPjk').prop('disabled', true);
    $('#msPjk').append('<option value="'+$('#val-msPjk').val()+'" selected="selected">'+getMonthName($('#val-msPjk').val())+'</option>').trigger('change');
    $('#negara').val($('#val-negara').val()).trigger('change');

    if($('#status-bupot').val() == 'Pembetulan'){
        $('#idDipotong').prop('readonly', true);
        $('#namaDipotong').prop('readonly', true);
        $('#almtDipotong').prop('readonly', true);
        $('#negara').prop('disabled', true);
        $('#noPasporDipotong').prop('readonly', true);
        $('#tempatLahirDipotong').prop('disabled', true);
        $('#tglLahirDipotong').prop('disabled', true);
        $('#noKitasDipotong').prop('readonly', true);
    }

    common.loadingMessage("Memproses", "Mohon sabar menunggu");
    setTimeout(function () {
        getObjPajak();
    }, 1000);
    $('input[name="optFasilitas"][value="'+$('#val-fgFasilitas').val()+'"]').prop('checked', true).trigger('change');
    switch ($('input[name="optFasilitas"]:checked').val()) {
        case "2":
            $('#noSkdln').prop('readonly', false);
            $('#tarif').prop('readonly', false);
            break;
        case "3":
            $('#noAturanDtp').prop('readonly', false);
            break;
        case "5":
            $('#noDokLainnya').prop('readonly', false);
            $('#tarif').prop('readonly', false);
            $('#pphDipotong').prop('readonly', false);
            break;
        default:
            break;
    }
    $('input[name="fgPengembalian"][value="'+$('#val-fgPengembalian').val()+'"]').prop('checked', true).trigger('change');
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
    $("#npwp").inputmask({
        "mask": "99.999.999.9-999.999"
    });
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
                if (i.toString().length === 1) {
                    var kode = "0" + i.toString();
                } else {
                    var kode = i.toString();
                }
                opt = opt + "<option value='" + kode + "'>" + getMonthName(i) + "</option>"
            }
            $('#msPjk').prop("disabled", false);
            $('#msPjk').append(opt).trigger('change');
            if($('#thnPjk').val() === (dateToday.getFullYear()).toString()){
                $('#msPjk option').filter(function () { return $(this).html() == getMonthName(dateToday.getMonth() + 1); }).first().prop('selected', true).trigger('change');
            }
        }
    });
}

function getObjPajak() {
    //Ajax Obj Pajak
    var paramAjax = {
        kdbupot: "1",
        jnsTrx: code,
        idBupot: idBupot,
        thnPajak: $('#thnPjk').val(),
        msPajak: $('#msPjk').val()
    };

    var doneAjax = function (data) {
        if (data.code == 1) {
            swal.close();
            var strOpt = "<option></option>";
            $.each(data.data, function (key, value) {
                strOpt = strOpt + "<option value='" + value.kdObjPjk + "' data-jnspajak='"+value.kdJnsPjk+"'>" +value.kdObjPjk+" "+ value.nmObjkPjk + "</option>";
            });
            $('#objPjk').empty().trigger("change");
            $('#objPjk').append(strOpt).trigger('change');
            if($('#val-objPjk').val() !== ""){
                $('#objPjk').val($('#val-objPjk').val()).trigger('change');
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

function formA() {

    $('#negara').on('change', function () {
        if ($('#negara').val() !== "" && $('#objPjk').val() !== null) {
            $('#negara').closest('.form-group').removeClass('has-error');
            $('#negara').closest('.form-group.form-group-md').find('span.invalid-feedback').hide();
        }
    });

}

function formB() {
    $("#msPjk").on("change", function () {
        common.loadingMessage("Memproses", "Mohon sabar menunggu");
        setTimeout(function () {
            getObjPajak();
        }, 1000);
    });

    $('#objPjk').on('change', function () {
        if ($('#objPjk').val() !== "" && $('#objPjk').val() !== null) {
            $('#objPjk').closest('.form-group').removeClass('has-error');
            $('#objPjk').closest('.form-group.form-group-md').find('span.invalid-feedback').hide();
            if ($('#objPjk').val() === "27-100-05" || $('#objPjk').val() === "27-100-07") {
                $('#kiraNetto').val(25).trigger('keyup');
            } else if ($('#objPjk').val() === "27-100-06") {
                swal.fire({
                    title: "Pilih Perkiraan Penghasilan Netto",
                    allowOutsideClick: false,
                    confirmButtonText: "Pilih",
                    buttonsStyling: false,
                    confirmButtonClass: "btn btn-djp btn-confirm",
                    input: 'radio',
                    inputOptions: {
                        '5': '5%',
                        '10': '10%',
                        '50': '50%'
                    },
                    inputValidator: function(result) {
                        if (!result) {
                            return 'Harus dipilih salah satu.';
                        }
                    }
                }).then(function(result) {
                    if (result.value) {
                        $('#kiraNetto').val(result.value).trigger('keyup');
                    }
                })
            } else {
                $('#kiraNetto').val(100).trigger('keyup');
            }
            var idTbl = "tbl_fasilitas";
            var paramTbl = {
                tin: $('#idDipotong').val(),
                kdNegara: $('#negara').val(),
                msPajak: $('#msPjk').val(),
                thnPajak: $('#thnPjk').val()
            };
            var urlTbl = "/api/pph/dftr_fasilitas26";
            var colTbl = [
                {data: "jnsFasilitas"},
                {data: "noDokumen"},
                {data: "msBerlaku"},
                {data: null}
            ];
            var colDefTbl = [
                {
                    targets: -1,
                    responsivePriority: 2,
                    orderable: false,
                    className: 'text-center',
                    render: function (data, type, full, meta) {
                        return '<span><button type="button"' +
                            'class="btn btn-djp btn-sm btn-elevate btn-pill fasilitas-btn">' +
                            'Pilih</button></span>'
                    }
                }
            ];
            var afterAjaxTbl = function () {
                setTimeout(function () {
                    if ($('#tbl_fasilitas').DataTable().data().count() > 0) {
                        $('#modal_fasilitas').modal('show');
                    }
                }, 1000);

                $('#tbl_fasilitas tbody').on('click', '.fasilitas-btn', function (e) {
                    e.preventDefault();
                    var data = $("#tbl_fasilitas").DataTable().row($(this).parents("tr")).data();
                    $('#optFasilitas2').prop('checked', true).trigger('change');
                    $('#noSkdln').val(data.noDokumen).trigger('blur');
                    $('#modal_fasilitas').modal('hide');
                });
            };
            common.generateTable(idTbl, urlTbl, paramTbl, 5, "asc", colTbl, colDefTbl, true, false, false, afterAjaxTbl);
            $('#optFasilitas1').prop('checked', true).trigger('change');
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
            case "2":
                $('#noSkdln').prop('readonly', false);
                $('#tarif').prop('readonly', false);
                break;
            case "3":
                $('#noAturanDtp').prop('readonly', false);
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
        if ($('#jmlBruto').inputmask('unmaskedvalue') !== "") {
            var jmlBruto = parseInt($('#jmlBruto').inputmask('unmaskedvalue'));
            var kiraNetto = parseFloat($('#kiraNetto').inputmask('unmaskedvalue'));
            var tarif = parseFloat($('#tarif').inputmask('unmaskedvalue'));
            var pph = jmlBruto * (kiraNetto/100) * (tarif/100);
            $('#pphDipotong').val(Math.floor(pph)).trigger('keyup');
        }
        var jmlBruto = parseInt($('#jmlBruto').inputmask('unmaskedvalue'));
        var jmlpphDipotong = parseInt($('#pphDipotong').inputmask('unmaskedvalue'));
        var fgBruto = (jmlBruto !== "") ? jmlBruto >= jmlpphDipotong : false;
        if (jmlpphDipotong < 0) fgBruto = false;
        if (fgBruto) {
            $('#pphDipotong-errorCustom').hide();
            $('#btnNext2').prop('disabled', false);
        } else {
            $('#pphDipotong-errorCustom').show();
            $('#btnNext2').prop('disabled', true);
        }
    });

    $('#tarif').on("keyup", function () {
        if ($('#tarif').inputmask('unmaskedvalue') !== "") {
            var jmlBruto = parseInt($('#jmlBruto').inputmask('unmaskedvalue'));
            var kiraNetto = parseFloat($('#kiraNetto').inputmask('unmaskedvalue'));
            var tarif = parseFloat($('#tarif').inputmask('unmaskedvalue'));
            var pph = jmlBruto * (kiraNetto/100) * (tarif/100);
            $('#pphDipotong').val(Math.floor(pph)).trigger('keyup');
        }
    });

    $('#pphDipotong').on("keyup", function () {
        var jmlBruto = parseInt($('#jmlBruto').inputmask('unmaskedvalue'));
        var jmlpphDipotong = parseInt($('#pphDipotong').inputmask('unmaskedvalue'));
        var fgBruto = (jmlBruto !== "") ? jmlBruto >= jmlpphDipotong : false;
        if (jmlpphDipotong < 0) fgBruto = false;
        if (fgBruto) {
            $('#pphDipotong-errorCustom').hide();
            $('#btnNext2').prop('disabled', false);
        } else {
            $('#pphDipotong-errorCustom').show();
            $('#btnNext2').prop('disabled', true);
        }
    });

    $('#noSkdln').on('blur', function () {
        if ($(this).val() !== "" && $(this).val() !== null) {
            var beforeAjax = function () {
                $('#noSkdln').closest('.kt-input-icon').children('.status-icon').remove();
            };

            var paramAjax = {
                jnsTrx: code,
                idBupot: idBupot,
                npwpPemotong: $('#npwpUser').val(),
                tin: $('#idDipotong').val(),
                kdNegara: $('#negara').val(),
                msPajak: $('#msPjk').val(),
                thnPajak: $('#thnPjk').val(),
                noSkd: $('#noSkdln').val()
            };

            var doneAjax = function (data) {
                if (data.code == 1) {
                    common.checkStatus('noSkdln', true);
                } else if (data.code == 9) {
                    var actErrorMessage = function () {
                        location.reload();
                    };
                    common.showMessageWithAction("Kesalahan", data.error_msg, "error", "Tutup", actErrorMessage);
                } else {
                    common.showMessage("Kesalahan", data.error_msg, "error", "Tutup")
                    common.checkStatus('noSkdln', false);
                    $('#noSkdln').val("");
                    accordionForm(2);
                }
            };

            common.ajaxJsonPost(beforeAjax, paramAjax, "/api/pph/check_noskd", doneAjax);
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
                if ($('#jmlBruto').inputmask('unmaskedvalue') !== "") {
                    var jmlBruto = parseInt($('#jmlBruto').inputmask('unmaskedvalue'));
                    var kiraNetto = parseFloat($('#kiraNetto').inputmask('unmaskedvalue'));
                    var tarif = parseFloat($('#tarif').inputmask('unmaskedvalue'));
                    var pph = jmlBruto * (kiraNetto/100) * (tarif/100);
                } else {
                    var pph = 0;
                }
                $('#pphDipotong').val(Math.floor(pph)).trigger('keyup');
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
        }, paramAjaxRequest, "/api/common/get_tarif", doneAjaxRequest);
    }
}

function formC() {
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
                targets: [1, 2],
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

    $('#tbl_dokdasarpot tbody').on('click', '.remove-btn', function () {
        $('#tbl_dokdasarpot').DataTable()
            .row($(this).parents('tr'))
            .remove()
            .draw();
        $('.tooltip').remove();
    });

    $('#btnNext3').on('click', function () {
        if ($('#tbl_dokdasarpot').DataTable().data().count() > 0) {
            accordionForm(4)
        } else {
            common.showMessage("Dokumen Kosong", 'Harap masukkan data Dokumen Dasar Pemotongan minimal 1 Dokumen', "error", "Tutup")
        }
    })
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
            thnPjk: {
                required: true
            },
            msPjk: {
                required: true
            },
            idDipotong: {
                required: true,
            },
            namaDipotong: {
                required: true,
            },
            almtDipotong: {
                required: true,
            },
            negara: {
                required: true
            },
            // tempatLahirDipotong: {
            //     withoutsemicolon: true
            // },
            // noPasporDipotong: {
            //     withoutsemicolon: true
            // },
            // noKitasDipotong: {
            //     withoutsemicolon: true
            // },
            objPjk : {
                required: true,
            },
            kiraNetto: {
                required: true
            },
            jmlBruto : {
                required: true,
            },
            noSkdln : {
                required: '#optFasilitas2:checked',
            },
            noAturanDtp : {
                required: '#optFasilitas3:checked',
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

            var kiraNet = ($('#kiraNetto').inputmask('unmaskedvalue')).toString();

            var paramAjax = {
                jnsTrx: code,
                idBupot: idBupot,
                thnPajak: $('#thnPjk').val(),
                msPajak: $('#msPjk').val(),
                noBupot: noBupot,
                npwpPemotong: $('#npwpUser').val(),
                fgIdDipotong: "2",
                idDipotong: $('#idDipotong').val(),
                namaDipotong: $('#namaDipotong').val().toUpperCase(),
                almtDipotong: $('#almtDipotong').val().toUpperCase(),
                kdNgrDipotong: $('#negara').val(),
                namaNgrDipotong: $('#negara option:selected').text(),
                tempatLahirDipotong: $('#tempatLahirDipotong').val().toUpperCase(),
                tglLahirDipotong: $('#tglLahirDipotong').val(),
                noPasporDipotong: $('#noPasporDipotong').val().toUpperCase(),
                noKitasDipotong: $('#noKitasDipotong').val().toUpperCase(),
                kdObjPjk: $('#objPjk').val(),
                kdJnsPjk: kdJnsPjk,
                fgFasilitas: $('input[name="optFasilitas"]:checked').val(),
                noSkdln: $('#noSkdln').val(),
                noAturanDtp: $('#noAturanDtp').val(),
                ntpnDtp: "",
                noDokLainnya: $('#noDokLainnya').val(),
                jmlBruto: $('#jmlBruto').inputmask('unmaskedvalue'),
                kiraNetto: kiraNet,
                tarif: tarif,
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
                        window.location.href = "/ebupot/pph/dftr-ps26";
                    };
                    var actReload = function () {
                        window.location.href = "/ebupot/pph/input-ps26";
                    };
                    if(code === "0") {
                        common.showMessageQuestionWithActionAndCancel("Sukses", "Data berhasil disimpan. Apakah Anda ingin merekam Bukti Potong Pasal 26 lagi?", "success", "Ya", "Tidak", actReload, actErrorMessage);
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

            common.ajaxJsonPost(function(){}, paramAjax, "/api/pph/save_ps26", doneAjax);
        }
    });
}