"use strict";
var KTCreateAccount = function() {
	var e, t, i, o, a, r, s = [];
	return {
		init: function() {
			(e = document.querySelector("#kt_modal_create_account")) && new bootstrap.Modal(e), (t = document.querySelector("#kt_create_account_stepper")) && (i = t.querySelector("#kt_create_account_form"), o = t.querySelector('[data-kt-stepper-action="submit"]'), a = t.querySelector('[data-kt-stepper-action="next"]'), (r = new KTStepper(t)).on("kt.stepper.changed", (function(e) {
				2 === r.getCurrentStepIndex() ? (o.classList.remove("d-none"), o.classList.add("d-inline-block"), a.classList.add("d-none")) : 3 === r.getCurrentStepIndex() ? (o.classList.add("d-none"), a.classList.add("d-none")) : (o.classList.remove("d-inline-block"), o.classList.remove("d-none"), a.classList.remove("d-none"))
			})), r.on("kt.stepper.next", (function(e) {
				console.log("stepper.next");
				var t = s[e.getCurrentStepIndex() - 1];
				t ? t.validate().then((function(t) {
                    "Valid" == t ? (spt1770ss.getSpt(), e.goNext(), KTUtil.scrollTop()) : Swal.fire({
                        text: "Maaf, sepertinya ada beberapa kesalahan yang terdeteksi, silakan coba lagi.",
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-light"
                        }
                    }).then((function() {
                        KTUtil.scrollTop()
                    }))	
				})) : (e.goNext(), KTUtil.scrollTop())
			})), r.on("kt.stepper.previous", (function(e) {
				console.log("stepper.previous"), e.goPrevious(), KTUtil.scrollTop()
			})), s.push(FormValidation.formValidation(i, {
				fields: {
					year: {
						validators: {
							notEmpty: {
								message: "Tahun Pajak Wajib Diisi"
							}
						}
					},
                    status: {
						validators: {
							notEmpty: {
								message: "Status SPT Wajib Diisi"
							}
						}
					},
                    txtPembetulanKe: {
						validators: {
							notEmpty: {
								message: "Pembetulan Ke Wajib Diisi"
							}
						}
					}
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger,
					bootstrap: new FormValidation.plugins.Bootstrap5({
						rowSelector: ".fv-row",
						eleInvalidClass: "",
						eleValidClass: ""
					})
				}
			})), s.push(FormValidation.formValidation(i, {
				fields: {
					account_team_size: {
						validators: {
							notEmpty: {
								message: "Time size is required"
							}
						}
					},
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger,
					bootstrap: new FormValidation.plugins.Bootstrap5({
						rowSelector: ".fv-row",
						eleInvalidClass: "",
						eleValidClass: ""
					})
				}
			})), o.addEventListener("click", (function(e) {
				s[1].validate().then((function(t) {
					console.log("validated!"), "Valid" == t ? (spt1770ss.simpanSpt(), e.preventDefault(), o.disabled = !0, o.setAttribute("data-kt-indicator", "on"), setTimeout((function() {
						o.removeAttribute("data-kt-indicator"), o.disabled = !1, r.goNext()
					}), 2e3)) : Swal.fire({
						text: "Sorry, looks like there are some errors detected, please try again.",
						icon: "error",
						buttonsStyling: !1,
						confirmButtonText: "Ok, got it!",
						customClass: {
							confirmButton: "btn btn-light"
						}
					}).then((function() {
						KTUtil.scrollTop()
					}))
				}))
			})), $(i.querySelector('[name="year"]')).on("change", (function() {
				s[0].revalidateField("year")
			})))
		}
	}
}();

var kdlbkbn;
var prepo = 0;
var statusSimpan = 0;
var statusLengkap = 0;

var spt1770ss = function () {
    $(".uang").autoNumeric('init', {aSep: '.', aDec: ',', mDec: '0', vMin: '0'});

    var formHandler = function () {
        $("input[name=status]:radio").change(function () {
            var status = $("input[name=status]:checked").val();
            if (status === "normal") {
                $("#txtPembetulanKe").val("0");
                $("#txtPembetulanKe").attr("readonly", "readonly");
            } else {
                $("#txtPembetulanKe").val("");
                $("#txtPembetulanKe").removeAttr("readonly").focus();
            }
        });

        $("#ddlPtkp").on("change", function () {
            if ($(this).val() === "") {
                number.setVal('#txtBagA3', 0);
            } else {
                number.setVal('#txtBagA3', sptproses.getNilaiPtkp($(this).val().charAt(0), $(this).val().charAt(1)));
                number.setVal('#txtBagA1', number.getVal($("#txtBagA1")) !== '' ? number.getVal($("#txtBagA1")) : '0').trigger("blur");
                number.setVal('#txtBagA2', number.getVal($("#txtBagA2")) !== '' ? number.getVal($("#txtBagA2")) : '0').trigger("blur");
                number.setVal('#txtBagA6', number.getVal($("#txtBagA6")) !== '' ? number.getVal($("#txtBagA6")) : '0').trigger("blur");
                itungPph();
            }
        });

        $("input[name=rdBayar]:radio").change(function () {
            $("#thPjkBilling").html("Tahun Pajak : " + $('#year').val());
            $('#divInfoKB').modal('show');
            $('#divInfoKB').modal({show: true});

            $("#buktiBayar_new").hide();
            $('#tblJnsPembayaran').hide();
            $('#tblJnsPembayaran_length').hide();
            $('#tblJnsPembayaran_filter').hide();
            $('#tblJnsPembayaran_info').hide();
            $('#tblJnsPembayaran_paginate').hide();

            $("#barisCreateBilling").hide();
            $("#barisKodeBilling").hide();
            $("#barisKodeBillingExpDate").hide();

            var rdBayar = $("input[name=rdBayar]:checked").val();
            if (rdBayar === "1") {
                billing.resetTabelBayar();
                $("#barisCreateBilling").show();
            } else {
                $("#formTblByr").show();
                $("#buktiBayar_new").show();
                $("#tblJnsPembayaran").show();
                $('#tblJnsPembayaran_info').show();
                $('#tblJnsPembayaran_paginate').show();
            }
        });

        $("#btnBilling").on("click", function () {
            var param = {pajak: number.getVal('#txtBagA7'), thPajak: $('#year').val(), jenis: jns};
            billing.createBillingCode(param, '#frm1770ss');
        });

        $("#pbyrnNomor").on("blur", function () {
            var jnsPbyrn = $("input:radio[name='rbPbyrn']:checked").val();
            if (jnsPbyrn === '1' || jnsPbyrn === '2') {
                sptproses.cekNmrPbyrn('#frmInduk1770ss', $(this).val(), jnsPbyrn);
            } else {
                common.showMessage("INFO", "Jenis Pembayaran tidak dipilih", "Ok");
            }
        });

        $("#setuju").on("change", function () {
            if (this.checked) {
                switch (kdlbkbn) {
                    case "2":
                        $("#divRedirect1770ss1").show();
                        $('#divRedirect1770ss1').modal('show');
                        redirect1770ss();
                        break;
                    case "1":
                        var cekNtpn = billing.checkPaymentCompletion('1770SS');
                        if (cekNtpn === 1) {
                            statusLengkap = 1;
                            $('#divInfoPbyrnLebih').modal('show');
                            $('#divInfoPbyrnLebih').modal({show: true});
                        } else if (cekNtpn === 0) {
                            statusLengkap = 1;
                        } else {
                            statusLengkap = 0;
                            $('#divInfoTLKB').modal('show');
                            $('#divInfoTLKB').modal({show: true});
                            $("#thnPjkBilling").html("Tahun Pajak : " + $('#year').val());
                            $("#nilaiKB").html("Rp " + number.getVal("#txtBagA7"));
                        }
                        $('#kt_create_account_stepper').find('[data-kt-stepper-action="submit"]').removeAttr("disabled");
                        break;
                    case "0":
                        $('#kt_create_account_stepper').find('[data-kt-stepper-action="submit"]').removeAttr("disabled");
                        break;
                }
            } else {
                $('#kt_create_account_stepper').find('[data-kt-stepper-action="submit"]').attr("disabled", "disabled");
            }
        });

        setDefaultForm();
        sptproses.cekIsEditMode();
    };

    var setDefaultForm = function () {
        $("#txtPembetulanKe").attr("readonly", "readonly");
        $("#buktiBayar_new").hide();
        $("#tblJnsPembayaran").hide();
        $("#panelPembayaran").hide();
        $("#barisCreateBilling").hide();
    };

    var itungBruto = function () {
        var a1 = Number(number.getVal("#txtBagA1"));
        var b1 = Number(number.getVal("#txtBagB1"));
        var b3 = Number(number.getVal("#txtBagB3"));
        var jmlBruto = a1 + b1 + b3;
        if (jmlBruto > Number(60000000)) {
            common.showMessage('INFO', 'Jumlah Penghasilan Bruto Anda (Penjumlahan angka 1, 8 dan 10) lebih dari Rp. 60.000.000, Anda harus menggunakan formulir 1770 S', "info", 'Ok');
            number.setVal("#txtBagA1", 0);
        }
    };

    var itungPph = function () {
        $("#setuju").prop("checked", false);
        $('#kt_create_account_stepper').find('[data-kt-stepper-action="submit"]').attr("disabled", "disabled");

        var jml = sptproses.roundDown(Number(number.getVal("#txtBagA1")) - Number(number.getVal("#txtBagA2")) - Number(number.getVal("#txtBagA3")));
        if (jml < 0) {
            number.setVal("#txtBagA4", 0);
            number.setVal("#txtBagA5", 0);
        } else {
            number.setVal("#txtBagA4", jml);
            number.setVal("#txtBagA5", (jml*5/100));
        }

        var lbkbn = Number(number.getVal("#txtBagA5")) - Number(number.getVal("#txtBagA6"));
        if (lbkbn < 0 && Math.abs(lbkbn) <= 1000) {
            lbkbn = 0;
        }
        number.setVal("#txtBagA7", Math.abs(lbkbn));

        var clr;
        if (lbkbn < 0) {
            $("#lblLbkbn").html("Lebih Bayar");
            clr = "blue";
            kdlbkbn = "2";
        } else if (lbkbn > 0) {
            $("#lblLbkbn").html("Kurang Bayar");
            clr = "red";
            kdlbkbn = "1";
        } else {
            $("#lblLbkbn").html("Nihil");
            clr = "black";
            kdlbkbn = "0";
            statusLengkap = 1;
        }

        setNtpnBox(kdlbkbn);
        $("#lblLbkbn").css({"color": clr, "font-weight": "bold"});
        $("#txtBagA7").css({"color": clr, "font-weight": "bold"});
    };

    var setNtpnBox = function (kode) {
        $("#panelPembayaran").hide();
        switch (kode) {
            case '1':
                $("#panelPembayaran").show();
                break;
            case '2':
                $("#rbss1").prop("checked", false);
                $("#rbss2").prop("checked", false);
                $("#rbss11").prop("checked", false);
                $("#rbss12").prop("checked", false);
                $("#rbss13").prop("checked", false);
                $("#rbss14").prop("checked", false);
                $("#rbss21").prop("checked", false);
                $("#rbss22").prop("checked", false);
                $("#divRedirect1770ss1").show();
                $('#divRedirect1770ss1').modal('show');
                redirect1770ss();
                break;
            default:
                break;
        }
    };

    var redirect1770ss = function () {
        $("input[name=ssLb]:radio").change(function () {
            var ssLb = $("input[name=ssLb]:checked").val();
            if (ssLb === "1") {
                $("#divRedirect1770ss2").show();
                $('#divRedirect1770ss2').modal('show');
            } else {
                $("#divRedirect1770ss3").show();
                $('#divRedirect1770ss3').modal('show');
            }
        });

        $("#btnRedirect1770ss2").click(function () {
            var ssLbA = $("input[name=ssLbA]:checked").val();
            if (ssLbA === "1") {
                $(location).attr('href', '/efile/1770s');
            } else if (ssLbA === "2") {
                $(location).attr('href', '/efile/1770s/wiz');
            } else if (ssLbA === "3") {
                $(location).attr('href', '/efile/upload');
            } else {
                window.location = "https://eform.pajak.go.id/";
            }
        });

        $("#btnRedirect1770ss3").click(function () {
            var ssLbB = $("input[name=ssLbB]:checked").val();
            if (ssLbB === "2") {
                $(location).attr('href', '/efile/upload');
            } else {
                window.location = "https://eform.pajak.go.id/";
            }
        });
    };

    var setParamSptss = function () {
        var bagA = {
            a1PBruto: number.getVal("#txtBagA1"),
            a2Pengurangan: number.getVal("#txtBagA2"),
            a3JnsPtkp: $("#ddlPtkp").val(),
            a31JmlTanggungan: $("#ddlPtkp").val().charAt(1),
            a32Ptkp: number.getVal("#txtBagA3"),
            a4Pkp: number.getVal("#txtBagA4"),
            a5PphTerutang: number.getVal("#txtBagA5"),
            a6PphDipotong: number.getVal("#txtBagA6"),
            a7LbKbN: kdlbkbn,
            a71JmlLbKbN: number.getVal("#txtBagA7")
        };
        var bagB = {
            b1PBrutoFinal: number.getVal("#txtBagB1"),
            b2PphFinal: number.getVal("#txtBagB2"),
            b3PenghasilanDikecualikan: number.getVal("#txtBagB3")
        };
        var bagC = {
            c1JmlHarta: number.getVal("#txtBagC1"),
            c2JmlUtang: number.getVal("#txtBagC2")
        };

        var spt = {'bagA': bagA, 'bagB': bagB, 'bagC': bagC, 'tglSpt': ''};
        return spt;
    };

    var setDataSpt = function () {
        return {
            tahunpajak: $("#year").val(),
            pembetulanke: $("#txtPembetulanKe").val(),
            kodeformulir: '1770SS',
            detilss: setParamSptss(),
            nilaipajak: number.getVal("#txtBagA7"),
            payment: (kdlbkbn === "1" && $("#rb2").is(":checked")) ? billing.getDaftarNoPembayaran() : [],
            statusspt: kdlbkbn,
            nilaipayment: kdlbkbn === "1" ? number.getVal("#txtJmlNtpnPbk") : '',
            flagreskom: kdlbkbn === "1" ? '0' : kdlbkbn === "2" ? '1' : '0',
            flagkirim: statusLengkap,
            fgprep: prepo
        };
    };

    var simpanSpt = function () {
        $.ajax({
            url: "/spt/simpan",
            type: 'POST',
            data: setDataSpt(),
            success: function (data) {
                switch (data.kdStatus) {
                    case "99" :
                        common.showMessageRedirectAnotherPage("ERROR", data.message, "error", "/auth/login");
                        break;
                    case "0" :
                        statusSimpan = 0;
                        common.showMessage("ERROR", data.ketStatus, "error", "Ok");
                        break;
                    case "1" :
                        statusSimpan = 1;
                        $('#txtJnsSpt').val('1770SS');
                        $('#vThPajak').val($('#year').val());
                        $('#vRevno').val($('#txtPembetulanKe').val());
                        $("#vStatusLbKbn").val(kdlbkbn === '1' ? 'Kurang Bayar' : (kdlbkbn === '2' ? "Lebih Bayar" : 'Nihil'));
                        number.setVal("#vJmlLbkbn", number.getVal("#txtBagA7"));
                        $('#vStatusPengiriman').val(data.message === '1' ? 'Lengkap' : 'Draft');
                        data.message === '1' ? $('#reload').show() : $('#reload').hide();
                        break;
                    default :
                        common.showMessage("ERROR", "ERR090: Proses tidak berhasil dilakukana.", "error", "OK");
                        break;
                }
            },
            error: function (jqXhr, status, er) {
                common.showMessage("ERROR", "ERR099: Proses tidak berhasil dilakukanb.", "error", "OK");
            },
            complete: function () {
                // common.unBlockPanel('#kt_app_main');
            }
        });
    };

    var getSpt = function () {
        if ($("#year").val() !== "" && $('#txtPembetulanKe').val() !== "") {
            var prm = {th: $("#year").val(), revno: $('#txtPembetulanKe').val(), jns: '1770SS'};
            common.loadingMessage("Memproses", "Mohon sabar menunggu");
            $.ajax({
                url: "/spt/data",
                type: 'POST',
                data: prm,
                success: function (data) {
                    switch (data.kdStatus) {
                        case "99" :
                            common.showMessageRedirectAnotherPage("ERROR", data.message, "error", "/auth/login");
                            break;
                        case "0" :
                            common.showMessage("ERROR", data.message, "error", "Ok");
                            break;
                        case "1" :
                            resetForm();
                            if (data.message !== null) {
                                var dataSpt = data.message;
                                number.setVal('#txtBagA1', dataSpt.detilss !== null ? dataSpt.detilss.bagA.gross : '0');
                                number.setVal('#txtBagA2', dataSpt.detilss !== null ? dataSpt.detilss.bagA.reduction : '0');
                                $("#ddlPtkp").val(dataSpt.detilss !== null ? dataSpt.detilss.bagA.ptkp_type : '0').trigger("change");
                                number.setVal('#txtBagA6', dataSpt.detilss !== null ? dataSpt.detilss.bagA.pph_deducted : '0').trigger("blur");

                                if (dataSpt.payment !== null) {
                                    if (dataSpt.payment.length > 0) {
                                        $("#rb1").removeAttr("checked");
                                        $("#rb2").attr("checked", "checked").trigger("change");
                                        billing.loadDataSpt(dataSpt.payment);
                                    } else {
                                        $("#rb2").removeAttr("checked");
                                        $("#rb1").attr("checked", "checked").trigger("change");
                                    }
                                }

                                number.setVal('#txtBagB1', dataSpt.detilss !== null ? dataSpt.detilss.bagB.final_gross_tax : '0');
                                number.setVal('#txtBagB2', dataSpt.detilss !== null ? dataSpt.detilss.bagB.pph_final : '0');
                                number.setVal('#txtBagB3', dataSpt.detilss !== null ? dataSpt.detilss.bagB.excluded_income : '0');

                                number.setVal('#txtBagC1', dataSpt.detilss !== null ? dataSpt.detilss.bagC.assets : '0');
                                number.setVal('#txtBagC2', dataSpt.detilss !== null ? dataSpt.detilss.bagC.debt : '0');
                            } else {
                                number.setVal('#txtBagA1', '0');
                                number.setVal('#txtBagA2', '0');
                                number.setVal('#txtBagA6', '0');
                                number.setVal('#txtBagB1', '0');
                                number.setVal('#txtBagB2', '0');
                                number.setVal('#txtBagB3', '0');
                                number.setVal('#txtBagC1', '0');
                                number.setVal('#txtBagC2', '0');
                            }

                            // sptproses.cekPrepopulated('#frm1770ss');
                            // sptproses.cekPrepopulatedFinal('#frm1770ss');
                            // statusCek = 1;
                            break;
                        default :
                            common.showMessage("ERROR", "ERR090: Proses tidak berhasil dilakukanc.", "error", "Ok");
                            break;
                    }
                },
                error: function (jqXhr, status, er) {
                    common.showMessage("ERROR", "ERR099: Proses tidak berhasil dilakukand.", "error", "Ok");
                },
                complete: function (jqXHR, textStatus) {
                    swal.close();
                }
            });
        } else {
            common.showMessage("ERROR", "Tahun Pajak, Status SPT dan Pembetulan Ke belum diisi", "error", "Ok");
        }
    };

    var resetForm = function () {
        $("#ddlPtkp").val("").trigger("change");
        $(".uang").val(0);
        $("#txtKodeBilling").val("");
        $("#txtKodeBillingExpDate").val("");
        $("#buktiBayar_new").hide();
        $("#formTblByr").hide();
        $('#tblJnsPembayaran_length').hide();
        $('#tblJnsPembayaran_filter').hide();
        $('#tblJnsPembayaran_info').hide();
        $('#tblJnsPembayaran_paginate').hide();
        $("#panelPembayaran").hide();
        $("#barisCreateBilling").hide();
        $("#barisKodeBilling").hide();
        $("#barisKodeBillingExpDate").hide();
        $("#setuju").prop("checked", false);
        $('#kt_create_account_stepper').find('[data-kt-stepper-action="submit"]').attr("disabled", "disabled");
    };

    return{
        init: function () {
            formHandler();
        }, cekBruto: function () {
            itungBruto();
        }, hitungPph: function () {
            itungPph();
        }, simpanSpt: function () {
            simpanSpt();
        }, getSpt: function () {
            getSpt();
        }, redirectSs: function () {
            redirect1770ss();
        }
    };
}();

KTUtil.onDOMContentLoaded((function() {
	KTCreateAccount.init();
    spt1770ss.init();
    submision.init();
    billing.init(false);
}));