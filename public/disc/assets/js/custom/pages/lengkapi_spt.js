$(document).ready(function () {
    if ($('#msgError').val() !== "") {
        var actErrorMessage = function () {
            window.location.href = "/ebupot/sptmasa/penyiapan-spt";
        };
        djpcommon.showMessageWithAction("Kesalahan", $('#msgError').val(), "error", "Tutup", actErrorMessage);
    }

    $.validator.addMethod('lessThanEqual', function (value, element, param) {
        return this.optional(element) || parseInt(unmaskCurrency(value)) <= parseInt(unmaskCurrency($(param[0]).val()));
    }, "{1} harus lebih kecil atau sama dengan {2}");

    masking();
    calculation();
    validasiFormA();
    validasiFormB();
    tblPenyetoran();
    formD();
    validasiFormD();
    submitForm();
});

function masking() {
    $('.djp-select2').each(function () {
        $(this).select2({
            placeholder: $(this).attr('data-placeholder'),
            allowClear: true
        });
    });
    $(".currency").each(function () {
        if($(this).val() == ""){
            $(this).val("0");
        }
        $(this).inputmask({
            alias: "currency",
            prefix: "",
            groupSeparator: ".",
            digits: "0",
            min: 0
        });
    });
    $("#npwp").inputmask({
        "mask": "99.999.999.9-999.999"
    });
}

function calculation() {
    $('#jmlBrutoab').val(
        parseInt($('#jmlBruto7a').inputmask("unmaskedvalue")) +
        parseInt($('#jmlBruto7b').inputmask("unmaskedvalue"))
    ).trigger("keyup");
    $('#jmlPph7e').val(
        (parseInt($('#jmlPph7a').inputmask("unmaskedvalue")) +
            parseInt($('#jmlPph7b').inputmask("unmaskedvalue"))) -
        (parseInt($('#jmlPph7c').inputmask("unmaskedvalue")) +
            parseInt($('#jmlPph7d').inputmask("unmaskedvalue")))
    ).trigger("keyup");
    $('#form_lengkapi_a').on('change', function () {
        $('#form_lengkapi_a').valid();
        $('#jmlBrutoab').val(
            parseInt($('#jmlBruto7a').inputmask("unmaskedvalue")) +
            parseInt($('#jmlBruto7b').inputmask("unmaskedvalue"))
        ).trigger("keyup");
        $('#jmlPph7e').val(
            (parseInt($('#jmlPph7a').inputmask("unmaskedvalue")) +
                parseInt($('#jmlPph7b').inputmask("unmaskedvalue"))) -
            (parseInt($('#jmlPph7c').inputmask("unmaskedvalue")) +
                parseInt($('#jmlPph7d').inputmask("unmaskedvalue")))
        ).trigger("keyup");
    })
}

function validasiFormA() {

    var paramFormA = {
        jmlBruto7a: {
            required: true
        },
        jmlPph7a: {
            required: true,
            lessThanEqual: ["#jmlBruto7a", "Jumlah PPh huruf a", "Jumlah Bruto huruf a"]
        },
        jmlBruto7b: {
            required: true
        },
        jmlPph7b: {
            required: true,
            lessThanEqual: ["#jmlBruto7b", "Jumlah PPh huruf b", "Jumlah Bruto huruf b"]
        },
        jmlPph7c: {
            required: true
        },
        jmlPph7d: {
            required: true
        },
        jmlPph7e: {
            required: true,
            lessThanEqual: ["#jmlBrutoab", "Jumlah PPh huruf e", "Jumlah Bruto huruf a + b"]
        }
    };

    var msgFormA = {};

    var actFormA = function () {
    };

    djpcommon.validateForm($('#form_lengkapi_a'), paramFormA, msgFormA, actFormA);
}

function validasiFormB() {
    var paramFormB = {};
    $(".dokdip").each(function () {
        paramFormB['jmlBruto_'+$(this).attr('data-id')] = {required: true};
        paramFormB['jmlPph_'+$(this).attr('data-id')] = {
            required: true,
            lessThanEqual: ['#jmlBruto_'+$(this).attr('data-id'), 'Jumlah PPh Objek Pajak '+$(this).attr('data-id'), 'Jumlah Bruto Objek Pajak '+$(this).attr('data-id')]
        };
    });

    var msgFormB = {};

    var actFormB = function () {
    };

    djpcommon.validateForm($('#form_lengkapi_b'), paramFormB, msgFormB, actFormB);
}

function tblPenyetoran() {
    var msThnPajak = $('#msThnPajak').val();
    var param = msThnPajak.split("/");

    var idTbl = "tbl_penyetoran";
    var paramTbl = {
        msPajak: param[1],
        thnPajak: param[0]
    };
    var urlTbl = "/api/spt/dftr_pembayaran";
    var colTbl = [
        {data: null},
        {data: "noBuktiSetor"},
        {data: "jnsPajak"},
        {data: "jnsSetoran"},
        {data: "periode"},
        {data: "tglSetor"},
        {data: "jmlSetor"}
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
        }
    ];
    var afterAjaxTbl = function () {
    };
    djpcommon.generateTable(idTbl, urlTbl, paramTbl, 5, "asc", colTbl, colDefTbl, true, false, true, afterAjaxTbl);
}

function formD() {
    if($('#val-sbgTtd').val() !== "" && $('#val-sbgTtd').val() !== null){
        $('#sbgTtd').closest('.form-group').removeClass('has-error');
        $('#sbgTtd').closest('.form-group.form-group-md').find('span.invalid-feedback').hide();
        var fg = $('#val-sbgTtd').val();
        djpcommon.loadingMessage("Memproses Penandatangan", "Mohon sabar menunggu");
        setTimeout(function () {
            ajaxTtd(fg);
        }, 1000);
        $('#sbgTtd').val($('#val-sbgTtd').val()).trigger('change');
        setTimeout(function () {
            $('#penandatangan option').filter(function () { return $(this).html() == $('#val-penandatangan').val(); }).first().prop('selected', true).trigger('change');
        }, 2000);
    }

    $('#sbgTtd').on('change', function () {
        $('#penandatangan').empty();
        $('#penandatangan').append('<option></option>').trigger("change");
        if($('#sbgTtd').val() !== "" && $('#sbgTtd').val() !== null){
            $('#sbgTtd').closest('.form-group').removeClass('has-error');
            $('#sbgTtd').closest('.form-group.form-group-md').find('span.invalid-feedback').hide();
            var fg = $('#sbgTtd').val();
            djpcommon.loadingMessage("Memproses Penandatangan", "Mohon sabar menunggu");
            setTimeout(function () {
                ajaxTtd(fg);
            }, 1000);
        }

    });

    $('#penandatangan').on('change', function () {
        if ($('#penandatangan').val() !== "" && $('#penandatangan').val() !== null) {
            $('#penandatangan').closest('.form-group').removeClass('has-error');
            $('#penandatangan').closest('.form-group.form-group-md').find('span.invalid-feedback').hide();
        }
    });

    function ajaxTtd(fg) {
        var beforeAjax = function () {
        };

        var paramAjax = {
            fgPtt: fg
        };

        var doneAjax = function (data) {
            if (data.code == 1) {
                var opt = "";
                $.each(data.data, function (key, value) {
                    opt = opt + '<option data-fg="'+value.fgNikNpwp+'" value="'+value.nikNpwpTtd+'">'+value.nmWpTtd+'</option>'
                });
                $('#penandatangan').append(opt).trigger("change");
                swal.close();
            } else if (data.code == 9) {
                var actErrorMessage = function () {
                    location.reload();
                };
                djpcommon.showMessageWithAction("Kesalahan", data.error_msg, "error", "Tutup", actErrorMessage);
            } else {
                djpcommon.showMessage("Kesalahan", data.error_msg, "error", "Tutup");
            }
        };

        djpcommon.ajaxJsonPost(beforeAjax, paramAjax, "/api/common/get_ttd", doneAjax);
    }
}

function validasiFormD() {
    //Form Validate
    var paramFormD = {
        sbgTtd: {
            required: true
        },
        penandatangan: {
            required: true
        }
    };

    var msgFormD = {};

    var actFormD = function () {

    };

    djpcommon.validateForm($('#form_lengkapi_d'), paramFormD, msgFormD, actFormD);
}

function accordionForm(number) {
    $('.accordion .card .card-header .card-title').removeClass('collapsed');
    $('.accordion .card .card-header .card-title').addClass('collapsed');
    $('.accordion .card:nth-child(' + number + ') .card-header .card-title').removeClass('collapsed');
    $('.accordion .card .collapse').removeClass('show');
    $('.accordion .card:nth-child(' + number + ') .collapse').addClass('show');
    masking();
}

function submitForm() {
    $('#btnReset').on('click', function () {
        window.location.href = "/ebupot/sptmasa/penyiapan-spt";
    });

    $('#btnSubmit').on('click', function (e) {
        e.preventDefault();

        var formAst = $('#form_lengkapi_a').valid();
        var formBst = $('#form_lengkapi_b').valid();
        var formDst = $('#form_lengkapi_d').valid();
        switch (false) {
            case formAst:
                accordionForm(1);
                break;
            case formBst:
                accordionForm(2);
                break;
            case formDst:
                accordionForm(4);
                break;
            default:
                djpcommon.loadingMessage("Memproses", "Mohon sabar menunggu");
                setTimeout(function () {
                    submit();
                }, 1000);
                break;
        }
    });

    function submit() {
        var paramSubmit = {
            idSpt: $('#idSpt').val(),
            npwp: $('#npwp').inputmask("unmaskedvalue"),
            fgDOSS: $('#fgDOSS').val(),
            kdObjPjk7: "28-410-01",
            jmlBruto7a: $('#jmlBruto7a').inputmask("unmaskedvalue"),
            jmlPPh7a: $('#jmlPph7a').inputmask("unmaskedvalue"),
            jmlBruto7b: $('#jmlBruto7b').inputmask("unmaskedvalue"),
            jmlPPh7b: $('#jmlPph7b').inputmask("unmaskedvalue"),
            jmlPPh7c: $('#jmlPph7c').inputmask("unmaskedvalue"),
            jmlPPh7d: $('#jmlPph7d').inputmask("unmaskedvalue"),
            jmlPPh7e: $('#jmlPph7e').inputmask("unmaskedvalue"),
            fgSebagai: $('#sbgTtd').val(),
            fgNikNpwp: $('#penandatangan option:selected').attr('data-fg'),
            nikNpwpTtd: $('#penandatangan').val(),
            nmWpTtd: $('#penandatangan option:selected').html()
        };

        var dokdip = [];
        $(".dokdip").each(function () {
            var jmlBruto = $('#jmlBruto_'+$(this).attr('data-id')).inputmask("unmaskedvalue");
            var jmlPph = $('#jmlPph_'+$(this).attr('data-id')).inputmask("unmaskedvalue");

            var dataobj = {};
            dataobj["kdObjPjk"] = $(this).attr('data-id');
            dataobj["jmlPph"] = jmlPph;
            dataobj["jmlBruto"] = jmlBruto;
            dokdip.push(dataobj);
        });
        paramSubmit["dokDipersamakan"] = dokdip;

        var doneAjax = function (data) {
            if (data.code == 1) {
                var actDone = function () {
                    window.location.href = "/ebupot/sptmasa/penyiapan-spt";
                };
                djpcommon.showMessageWithAction("Sukses", "Data berhasil disimpan.", "success", "Oke", actDone);
            } else if (data.code == 9) {
                var actErrorMessage = function () {
                    location.reload();
                };
                djpcommon.showMessageWithAction("Kesalahan", data.error_msg, "error", "Tutup", actErrorMessage);
            } else {
                djpcommon.showMessage("Kesalahan", data.error_msg, "error", "Tutup");
            }
        };

        djpcommon.ajaxJsonPost(function(){}, paramSubmit, "/api/spt/save_lengkapi", doneAjax);
    }
}

function unmaskCurrency(val) {
    var unmaskValue = val.toString().split(".").join("");
    return unmaskValue;
}