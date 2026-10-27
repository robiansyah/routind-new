"use strict";
var KTCreateAccount = function() {
	var e, t, i, o, a, r, s = [];
	return {
		init: function() {
			(e = document.querySelector("#kt_modal_create_account")) && new bootstrap.Modal(e), (t = document.querySelector("#kt_create_account_stepper")) && (i = t.querySelector("#kt_create_account_form"), o = t.querySelector('[data-kt-stepper-action="submit"]'), a = t.querySelector('[data-kt-stepper-action="next"]'), (r = new KTStepper(t)).on("kt.stepper.changed", (function(e) {
				4 === r.getCurrentStepIndex() ? (o.classList.remove("d-none"), o.classList.add("d-inline-block"), a.classList.add("d-none")) : 5 === r.getCurrentStepIndex() ? (o.classList.add("d-none"), a.classList.add("d-none")) : (o.classList.remove("d-inline-block"), o.classList.remove("d-none"), a.classList.remove("d-none"))
			})), r.on("kt.stepper.next", (function(e) {
				console.log("stepper.next");
				var t = s[e.getCurrentStepIndex() - 1];
				t ? t.validate().then((function(t) {
					if(r.getCurrentStepIndex()==1){
                        "Valid" == t ? (spt1770s.getSpt(), e.goNext(), KTUtil.scrollTop()) : Swal.fire({
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
                    }else{
                        "Valid" == t ? (spt1770s.simpanDraft(), e.goNext(), KTUtil.scrollTop()) : Swal.fire({
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
                    }
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
					mharta: {
						validators: {
							notEmpty: {
								message: "Daftar harta harus diisi. Semua kolom harus terisi dan tidak ada data yang bernilai 0 "
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
                    mbupot: {
                        validators: {
                            notEmpty: {
                                message: "Daftar Pemotongan/Pemungutan PPh harus diisi. Semua kolom harus terisi dan tidak ada data yang bernilai 0 "
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
					card_name: {
						validators: {
							notEmpty: {
								message: "Name on card is required"
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
				s[3].validate().then((function(t) {
					console.log("validated!"), "Valid" == t ? (spt1770s.simpanSpt(), e.preventDefault(), o.disabled = !0, o.setAttribute("data-kt-indicator", "on"), setTimeout((function() {
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
			})), $(i.querySelector('[name="mharta"]')).on("change", (function() {
				s[1].revalidateField("mharta")
			})), $(i.querySelector('[name="mbupot"]')).on("change", (function() {
				s[2].revalidateField("mbupot")
			})))
		}
	}
}();

var kdlbkbn;
var statusDraft = 0;
var statusLengkap = 0;
var statusSimpan = 0;
var pisahHarta;
var statusbyr;

var spt1770s = function () {

    var initForm = function () {
        $("#pnlStatusKawin").hide();
        $("#divStatusNikah").hide();
        $("#divKwjbnPajak").hide();
        $("#divNpwpPasangan").hide();
        $("input[name=rbnikah]:radio").removeAttr("checked");
        $("#divKodeHarta").hide();
        $("#divKodeHtg").hide();
        $("#panelPisahHarta").hide();
        $("#barisLebihBayar").hide();
        $(".dates").flatpickr();
        setDefaultPanelPembayaran();
        sptproses.cekIsEditMode();
        pisahHarta = 0;
        daftarAsetHandler.setTahunPerolehan("#DhThPerolehan");
        daftarUtangHandler.setTahunPinjam('#DuThPinjam');
    };

    var setDefaultPanelPembayaran = function () {
        $("input[name=rdBayar]:radio").removeAttr("checked");
        $("#txtKodeBilling").val("");
        $("#txtKodeBillingExpDate").val("");
        $("#buktiBayar_new").hide();
        $("#formTblByr").hide();
        $('#tblJnsPembayaran_length').hide();
        $('#tblJnsPembayaran_filter').hide();
        $('#tblJnsPembayaran_info').hide();
        $('#tblJnsPembayaran_paginate').hide();
        $("#panelPembayaran").hide();
        $("#barisTglNtpn").hide();
        $("#barisCreateBilling").hide();
        $("#barisKodeBilling").hide();
        $("#barisKodeBillingExpDate").hide();
    };

    var settingForm = function (frm, frmInd) {
        /*
         * Step 1
         */
        $("#year").on("change", function () {
            setFormByTahunPajak($(this).val());
            // if (spt1770 === "x")
            //     sptproses.getRev(this.value);
            // sptproses.getTarifPph(this.value);
            // sptproses.getPtkp(this.value);
        });

        $("input[name=status]:radio").on("change", function () {
            setPembetulan($(this).val());
        });
        $("input[name=rbnikah]:radio").on("change", function () {
            setPerkawinan($(this).val());
        });
        $("#ddlStatusKwjbnPajak").on("change", function () {
            setFormByStatusKewajiban($(this).val());
        });

        /*
         * lampiran II
         */
        $("#btnPrepopulated").on("click", function () {
            var prepo = $("input:radio[name='prepo']:checked").val();
            if (prepo === "1") {
                if (dataPrep !== null)
                    setDataPrepopulated(dataPrep);
                if (dataPrepFinal !== null)
                    setDataPrepopulatedFinal(dataPrepFinal);
            }
        });

        $("#harta_th_lalu").click(function () {
            getHartaThLalu($("#year").val());
        });

        $("#utang_th_lalu").click(function () {
            getUtangThLalu($("#year").val());
        });

        $("#keluarga_th_lalu").click(function () {
            getKelgThLalu($("#year").val());
        });

        /*
         * Lampiran I
         */
        $(".bgIa").on("blur", function () {
            itungA();
        });
        $(".bgIb").on("blur", function () {
            itungB();
        });
        $(".induk").on("blur", function () {
            htPPh();
        });

        $('#BpJnsPajak').on("change", function () {
            //$('#BpNpwpPemotong').val("");
            //$('#BpNmPemotong').val("");
            switch (this.value) {
                case "4":
                    $('#BpNmPemotong').prop("readonly", false);
                    $('#BpNpwpPemotong').prop("readonly", false);
                    break;
                case "7":
                    $('#BpNpwpPemotong').prop("readonly", true);
                    $('#BpNmPemotong').prop("readonly", true);
                    $('#BpNpwpPemotong').val("000000000000000");
                    $('#BpNmPemotong').val("SKPPKP");
                    break;
                default:
                    $('#BpNmPemotong').prop("readonly", false);
                    $('#BpNpwpPemotong').prop("readonly", false);
                    break;
            }
        });

//        $("#BpNpwpPemotong").on("blur", function () {
//            if ($('#BpJnsPajak').val() === "4" || $('#BpJnsPajak').val() === "7") {
//                null;
//            } else {
//                getDataNpwp($(this).val(), 1, frmInd);
//            }
//        });

        $("#BpJmlPotong").on("blur", function () {
            if ($('#BpJnsPajak').val() === "7" && $('#BpJmlPotong').val() > "0") {
                common.showMessage("INFO", "Nilai SKPPKP harus Negatif", "info");
                $('#BpJmlPotong').val(($('#BpJmlPotong').val().replace(/\./g, '')) * -1);
            }
        });

        $("#txtNpwpPasangan").on("blur", function () {
            //getDataNpwp($(this).val(), 0);
        });

        $("#IdkPtkp").on("change", function () {
            setPtkp(this.value);
        });

        $('#Idk7').on("change", function () {
            htPPh();
        });

        $("input[name=rbpisahharta]:radio").on("change", function () {
            setPanelPisahHarta();
        });

        $("input[name=rdBayar]:radio").on("change", function () {
            setPanelPembayaran();
        });

        $("#btnBilling").on("click", function () {
            var param = {pajak: number.getVal('#Idk16'), thPajak: $('#year').val(), jenis: jns};
            billing.createBillingCode(param, frm);
        });

        $("#pbyrnNomor").on("blur", function () {
            var jnsPbyrn = $("input:radio[name='rbPbyrn']:checked").val();
            if (jnsPbyrn === '1' || jnsPbyrn === '2') {
                sptproses.cekNmrPbyrn(frmInd, $(this).val(), jnsPbyrn);
            } else {
                common.showMessage("INFO", "Jenis Pembayaran tidak dipilih");
            }
        });

        $("#setuju").on("change", function () {
            if (this.checked) {
                var cekAsset = daftarAsetHandler.cekAssetCompletion($("#year").val());
                var cekUtang = daftarUtangHandler.cekUtangCompletion($("#year").val());
                var cekBp = daftarBuktiPotongHandler.cekBpCompletion();
                var cekTglLunas = $("#tglSsp").val() !== '';
                var cekNtpn = billing.checkPaymentCompletion('1770S');
                var cekLB = $("#CbLebihBayar").val() !== '' && Number(number.getVal("#Idk1")) !== 0;
                $('#kt_create_account_stepper').find('[data-kt-stepper-action="submit"]').removeAttr("disabled");
                switch (kdlbkbn) {
                    case "2"://lb
                        if (isUploadPDFWeb === "true" && cekLB && cekAsset && cekUtang && cekBp) {
                            statusLengkap = 1;
                            $('#divInfoLB').modal('show');
                            $('#divInfoLB').modal({show: true});
                        } else {
                            statusLengkap = 0;
                            $('#divInfoTLLB').modal('show');
                            $('#divInfoTLLB').modal({show: true});
                        }
                        break;
                    case "1"://kb
                        if (cekTglLunas && cekAsset && cekUtang && cekBp) {
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
                                $("#nilaiKB").html("Rp " + common.formatNumber(number.getVal("#Idk16")));
                            }
                        } else {
                            statusLengkap = 0;
                            $('#divInfoTLKB').modal('show');
                            $('#divInfoTLKB').modal({show: true});
                            $("#thnPjkBilling").html("Tahun Pajak : " + $('#year').val());
                            $("#nilaiKB").html("Rp " + common.formatNumber(number.getVal("#Idk16")));
                        }
                        break;
                    case "0":
                        if (cekAsset && cekUtang && cekBp) {
                            statusLengkap = 1;
                        } else {
                            statusLengkap = 0;
                            $('#divInfoTLNhl').modal('show');
                            $('#divInfoTLNhl').modal({show: true});
                        }
                        break;
                }
            } else {
                $('#kt_create_account_stepper').find('[data-kt-stepper-action="submit"]').attr("disabled", "disabled");
            }
        });
    };

    var setFormByTahunPajak = function (thPajak) {
        if (thPajak === "2013") {
            $("#pnlStatusKawin").hide();
            $("#divStatusNikah").hide();
            $("#divFiskalLn").show();
            $("#CbLebihBayar option[value='1']").removeAttr('disabled');
        } else {
            $("#pnlStatusKawin").show();
            $("#divStatusNikah").show();
            $("#divFiskalLn").hide();
            $("#CbLebihBayar option[value='1']").attr('disabled', 'disabled');
        }
        //       initBagB06(thPajak);
        daftarAsetHandler.setup(thPajak, false);
        daftarUtangHandler.setup(thPajak, false);
        daftarKeluargaHandler.setup(thPajak, false);
        initPilihanPtkp(thPajak);
    };

    var initPilihanPtkp = function (thPjk) {
        var options = [];
        if (thPjk === '2013') {
            options = ["Tidak Kawin/TK", "Kawin/K", "Kawin Penghasilan Istri Digabung (K/I)", "Hidup Berpisah(HB)", "Pisah Harta(PH)", "Menjalankan Kewajiban Sendiri (MT)"];
        } else {
            options = ["Tidak Kawin/TK", "Kawin/K", "Kawin Penghasilan Istri Digabung (K/I)"];
        }
        $('#IdkPtkp').empty();
        $.each(options, function (index, value) {
            $('#IdkPtkp').append("<option value='" + index + "'>" + value + "</option>");
        });
    };

    var setPembetulan = function (kodePembetulan) {
        if (kodePembetulan === 'normal') {
            $("#txtPembetulanKe").val('0');
            $("#txtPembetulanKe").attr("readonly", "readonly");
        } else {
            $("#txtPembetulanKe").removeAttr("readonly");
            $("#txtPembetulanKe").val('').focus();
        }
    };

    var setPerkawinan = function (kodePerkawinan) {
        if (kodePerkawinan === '2') {
            $("#divKwjbnPajak").show();
            $("#divNpwpPasangan").show();
            $("#ddlStatusKwjbnPajak").val('1').trigger('change');
            $("#ddlStatusKwjbnPajak option[value='0']").attr('disabled', 'disabled');
        } else {
            $("#ddlStatusKwjbnPajak option[value='0']").removeAttr('disabled');
            $("#ddlStatusKwjbnPajak").val('0').trigger('change');
            $("#divKwjbnPajak").hide();
            $("#divNpwpPasangan").hide();
        }
    };

    var setFormByStatusKewajiban = function (status) {
        $("#IdkPtkp option[value='0']").removeAttr('disabled');
        $("#IdkPtkp option[value='1']").removeAttr('disabled');
        $("#IdkPtkp option[value='2']").removeAttr('disabled');
        pisahHarta = '0';
        $('#panelPisahHarta').hide();
        switch (status) {
            case "1"://KK
                $("#IdkPtkp option[value='0']").attr('disabled', 'disabled');
                $('#txtNpwpPasangan').val('').attr('disabled', 'disabled').rules("remove", "required");
                $("#IdkPtkp").val('1');
                $("#Idk7").val('0').trigger("change");
                break;
            case "0"://Tidak Kawin
            case "2"://HB
                $('#txtNpwpPasangan').removeAttr('disabled');
                $('#txtNpwpPasangan').rules("remove", "required");
                $('#txtNpwpPasangan').focus();
                $("#IdkPtkp option[value='1']").attr('disabled', 'disabled');
                $("#IdkPtkp option[value='2']").attr('disabled', 'disabled');
                $("#IdkPtkp").val('0');
                $("#Idk7").val('0').trigger("change");
                break;
            case "3"://PISAH
            case "4"://MT
                pisahHarta = '1';
                $('#panelPisahHarta').show();
                $('#txtNpwpPasangan').removeAttr('disabled');
                $('#txtNpwpPasangan').rules("add", {required: true});
                $('#txtNpwpPasangan').focus();
                $("#IdkPtkp option[value='0']").attr('disabled', 'disabled');
                $("#IdkPtkp option[value='1']").attr('disabled', 'disabled');
                $("#IdkPtkp").val('2');
                $("#Idk7").val('0').trigger("change");
                break;
            default:
                break;
        }
    };
    var getHartaThLalu = function (obj) {
        common.loadingMessage("Memproses", "Mohon sabar menunggu");
        $.ajax({
            url: "/spt/asset",
            type: 'GET',
            data: {th: obj},
            success: function (data) {
                if (data.kdStatus === "1") {
                    daftarAsetHandler.setharta(data.message.daftarHarta);
                } else {
                    common.showMessage("INFO", data.message, "info");
                }
            },
            error: function (jqXhr, status, er) {
                common.showMessage("ERROR", "ERR099: Proses tidak berhasil dilakukan.", "error", "OK");
            },
            complete: function () {
                swal.close();
            }
        });
    };

    var getUtangThLalu = function (obj) {
        common.loadingMessage("Memproses", "Mohon sabar menunggu");
        $.ajax({
            url: "/spt/liability",
            type: 'GET',
            data: {th: obj},
            success: function (data) {
                if (data.kdStatus === "1") {
                    daftarUtangHandler.setUtang(data.message.daftarUtang);
                } else {
                    common.showMessage("INFO", data.message, "info");
                }
            },
            error: function (jqXhr, status, er) {
                common.showMessage("ERROR", "ERR099: Proses tidak berhasil dilakukan.", "error", "OK");
            },
            complete: function () {
                swal.close();
            }
        });
    };

    var getKelgThLalu = function (obj) {
        common.loadingMessage("Memproses", "Mohon sabar menunggu");
        $.ajax({
            url: "/spt/tang",
            type: 'GET',
            data: {th: obj},
            success: function (data) {
                if (data.kdStatus === "1") {
                    daftarKeluargaHandler.setTanggungan(data.message.daftarKeluarga);
                } else {
                    common.showMessage("INFO", data.message, "info");
                }

            },
            error: function (jqXhr, status, er) {
                common.showMessage("ERROR", "ERR099: Proses tidak berhasil dilakukan.", "error", "OK");
            },
            complete: function () {
                swal.close();
            }
        });
    };

    var itungA = function () {
        var sumIA = 0;
        $('.bgIa').each(function () {
            sumIA += Number(number.getVal($(this)));
        });
        number.setVal("#txtJumlahA", sumIA);
        number.setVal("#Idk2", sumIA).trigger("blur");
    };

    var itungB = function () {
        var sumIB = 0;
        $('.bgIb').each(function () {
            sumIB += Number(number.getVal($(this)));
        });
        number.setVal("#txtJumlahB", sumIB);
    };
    var htPPh = function () {
        $("#cbSetuju").prop("checked", false);
        getNilaiPtkp();
        getPhNetto();
        getPph();
    };

    var getNilaiPtkp = function () {
        var kdPtkp = $("#IdkPtkp").val() === "" ? "0" : $("#IdkPtkp").val();
        var jmlTang = $("#Idk7").val() === "" ? "0" : $("#Idk7").val();
        var ptkp;
        if (kdPtkp === "3") {
            kdPtkp = "0";
            ptkp = sptproses.getNilaiPtkp(kdPtkp, jmlTang);
        } else if (kdPtkp === "4" || kdPtkp === "5") {
            kdPtkp = "2";
            ptkp = sptproses.getNilaiPtkp(kdPtkp, jmlTang);
            //ptkp = "0";
        } else {
            ptkp = sptproses.getNilaiPtkp(kdPtkp, jmlTang);
        }
        number.setVal('#Idk71', ptkp);

    };
    var getPhNetto = function () {
        var phNetto = Number(number.getVal("#Idk1")) + Number(number.getVal("#Idk2")) + Number(number.getVal("#Idk3"));
        number.setVal("#Idk4", phNetto);
        var phNettoMinZkt = phNetto - Number(number.getVal("#Idk5"));
        number.setVal("#Idk6", phNettoMinZkt);
    };
    var getPph = function () {
        var pajak;
        number.setVal("#Idk12", number.getVal("#txtJAC"));
        if (pisahHarta === "1") {
            //pisah harta
            var totalPenghasilan = sptproses.roundDown(Number(number.getVal("#idkPenghasilanSuami")) + Number(number.getVal("#idkPenghasilanIstri")));
            var ptkp = sptproses.getNilaiPtkp("2", $("#Idk7").val());
            var Pkp = totalPenghasilan > 0 ? sptproses.roundDown(totalPenghasilan - ptkp) : 0;
            number.setVal('#Idk8', 0);
            pajak = Pkp > 0 ? sptproses.hitungPph(Pkp) : 0;
            if (totalPenghasilan > 0) {
                var rbpisahharta = $("input[name=rbpisahharta]:checked").val();
                if (rbpisahharta === "1") {
                    pajak = (Number(number.getVal("#idkPenghasilanSuami")) / totalPenghasilan) * pajak;
                } else {
                    pajak = (Number(number.getVal("#idkPenghasilanIstri")) / totalPenghasilan) * pajak;
                }
            } else {
                pajak = 0;
            }
        } else {
            //normal
            $("#rbsuami").prop("checked", false);
            $("#rbistri").prop("checked", false);
            var Pkp = sptproses.roundDown(Number(number.getVal("#Idk6")) - Number(number.getVal("#Idk71")));
            number.setVal('#Idk8', Pkp < 0 ? 0 : Pkp);
            pajak = sptproses.hitungPph(Pkp);

        }
        number.setVal('#Idk9', pajak);
        var JmlPph = pajak + Number(number.getVal("#Idk10"));
        number.setVal('#Idk11', JmlPph);
        var totalPajak = JmlPph - Number(number.getVal("#Idk12"));
        var clr;
        if (totalPajak < 0) {
            statusbyr = "2";
            $("#lblStatusPajak").html("PPh Yang Lebih Dipotong/Dipungut");
            clr = "blue";
        } else {
            statusbyr = "1";
            $("#lblStatusPajak").html("PPh Yang harus dibayar sendiri");
            clr = "red";
        }
        number.setVal('#Idk13', Math.abs(totalPajak));
        $("#lblStatusPajak").css({"color": clr, "font-weight": "bold"});
        getPphAkhir(totalPajak);
    };
    var getPphAkhir = function (totalPph) {
        var JmlKredit = Number(number.getVal("#Idk14a")) + Number(number.getVal("#Idk14b")) + Number(number.getVal("#Idk14c"));
        number.setVal("#Idk15", JmlKredit);
        var Pjk = totalPph - JmlKredit;
        var clr;
        //pembulatan LB sampai dengan 1000
        if (Pjk < 0 && Math.abs(Pjk) <= 1000) {
            Pjk = 0;
        }
        if (Pjk < 0) {
            $("#lblPph").html("Lebih Bayar");
            clr = "blue";
            $("#IdkBlokAngs").hide();
            kdlbkbn = '2';
        } else if (Pjk > 0) {
            $("#lblPph").html("Kurang Bayar");
            clr = "red";
            $("#IdkBlokAngs").show();
            kdlbkbn = "1";
        } else {
            $("#lblPph").html("Nihil");
            clr = "green";
            $("#IdkBlokAngs").hide();
            kdlbkbn = "0";
            statusLengkap = 1;
        }
        setNtpnBox(kdlbkbn);
        number.setVal("#Idk16", Math.abs(Pjk));
        $("#lblPph").css({"color": clr, "font-weight": "bold"});

    };
    var setNtpnBox = function (kode) {
        $("#panelPembayaran").hide();
        $("#barisLebihBayar").hide();
        $("#panelUploadLampiran").hide();
        switch (kode) {
            case '1':
                $("#panelPembayaran").show();
                break;
            case '2':
                $("#tglSsp").val('');
                $("#barisLebihBayar").show();
                $("#panelUploadLampiran").show();
                break;
            default:
                $("#tglSsp").val('');
                break;
        }
    };

    var getDataNpwp = function (pnpwp, bp, frmInd) {
        common.loadingMessage("Memproses", "Mohon sabar menunggu");
        $("#BpNmPemotong").val('');
        $.ajax({
            url: "/ref/npwp",
            type: 'POST',
            data: {npwp: pnpwp},
            success: function (data) {
                switch (data.kdStatus) {
                    case "99" :
                        common.showMessageRedirectAnotherPage("ERROR", data.message, "error", "/auth/login");
                        break;
                    case "0" :
                        common.showMessage("INFO", 'NPWP tidak valid', "info");
                        $("#BpNpwpPemotong").val('');
                        break;
                    case "1" :
                        $("#BpNmPemotong").val(data.message);
                        $("#BpNoBuktiPotong").focus();
                        break;
                    default :
                        common.showMessage("ERROR", "ERR090: Proses tidak berhasil dilakukan.", "error");
                        break;
                }
            },
            error: function (jqXhr, status, er) {
                common.showMessage("ERROR", "ERR099: Proses tidak berhasil dilakukan.", "error");
            }, complete: function (jqXHR, textStatus) {
                swal.close();
            }
        });
    };

    var setPtkp = function (value) {
        if ($("#year").val() === "2013") {
            if (value === "4" || value === "5") {
                $('#panelPisahHarta').show();
                pisahHarta = '1';
            } else {
                $('#panelPisahHarta').hide();
                pisahHarta = '0';
            }
        } else {
            if (value === "2") {
                $('#panelPisahHarta').show();
                pisahHarta = '1';
            } else {
                $('#panelPisahHarta').hide();
                pisahHarta = '0';
            }
        }
        htPPh();
    };

    var setPanelPisahHarta = function () {
        if ($("input[name='rbpisahharta']:checked").val() == '1') {
            $('#idkPenghasilanSuami').attr('readonly', 'true');
            number.setVal('#idkPenghasilanSuami', number.getVal('#Idk6'));
            $('#idkPenghasilanIstri').removeAttr('readonly').val("").focus();
        } else {
            $('#idkPenghasilanIstri').attr('readonly', 'true');
            number.setVal('#idkPenghasilanIstri', number.getVal('#Idk6'));
            $('#idkPenghasilanSuami').removeAttr('readonly').val("").focus();
        }
        htPPh();
    };

    var setPanelPembayaran = function () {

        $("#thPjkBilling").html("Tahun Pajak : " + $('#year').val());
        $('#divInfoKB').modal('show');
        $('#divInfoKB').modal({show: true});

        $("#tglSsp").val('');
        $("#formTblByr").hide();
        $("#barisTglNtpn").hide();
        $("#buktiBayar_new").hide();
        $("#tblJnsPembayaran").hide();
        $('#tblJnsPembayaran_length').hide();
        $('#tblJnsPembayaran_filter').hide();
        $('#tblJnsPembayaran_info').hide();
        $('#tblJnsPembayaran_paginate').hide();

        $("#barisCreateBilling").hide();
        $("#barisKodeBilling").hide();
        $("#barisKodeBillingExpDate").hide();

        var rdBayar = $("input[name=rdBayar]:checked").val();
        if (rdBayar === "1") {
            $("#tglSsp").val('');
            billing.resetTabelBayar();
            $("#barisCreateBilling").show();
        } else {
            $("#barisTglNtpn").show();
            $("#buktiBayar_new").show();
            $("#formTblByr").show();
            $("#tblJnsPembayaran").show();
            $('#tblJnsPembayaran_info').show();
            $('#tblJnsPembayaran_paginate').show();
        }
    };

    var showData = function () {
        var prm = {th: $("#year").val(), revno: $('#txtPembetulanKe').val(), jns: '1770S'};
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
                        common.showMessage("ERROR", data.message, "error");
                        break;
                    case "1" :
                        resetForm();
                        if (data.message !== null) {
                            prodata.loadSpt(data.message);
                        } else {
                            var sessiData = sessi.get(vNpwp, jns, $("#year").val());
                            if (sessiData !== undefined) {
                                prodata.loadSpt(sessiData);
                            }
                        }
                        break;
                    default :
                        common.showMessage("ERROR", "ERR090: Proses tidak berhasil dilakukan.", "error");
                        break;
                }
            },
            error: function (jqXhr, status, er) {
                common.showMessage("ERROR", "ERR099: Proses tidak berhasil dilakukan.", "error");
            },
            complete: function (jqXHR, textStatus) {
                swal.close();
            }
        });
    };
    var getSpt = function () {
        if ($("#year").val() !== "" && $('#txtPembetulanKe').val() !== "") {
            showData();
        } else {
            common.showMessage("ERROR", "Tahun Pajak, Status SPT dan Pembetulan Ke belum diisi", "error");
        }
    };

    var resetForm = function () {
        $(".uang").autoNumeric('set', 0);
        $(".uangskppkp").autoNumeric('set', 0);
        daftarBuktiPotongHandler.resetTabelBuktiPotong();
        daftarFinalHandler.resetTabelFinal();
        daftarAsetHandler.resetTabelHarta();
        daftarUtangHandler.resetTabelHutang();
        daftarKeluargaHandler.resetTableTanggungan();
        $("#txtNtpn").val("");
        $("#txtKodeBilling").val("");
        $("#cbSetuju").prop("checked", false);
    };

    var setDataPrepopulated = function (a) {
        if (a !== null) {
            if (a.statusPtkp === "0") {
                $('#rbnikah1').attr("checked", "checked").trigger("change");
            } else {
                $('#rbnikah2').attr("checked", "checked").trigger("change");
            }
            number.setVal("#Idk1", a.jmlPenghasilanNetto);
            $("#IdkPtkp").val(a.statusPtkp).trigger("change");
            $("#Idk7").val(a.jmlTanggungan).trigger("change");
            var jmlPphDiPotong = 0;
            var lsBp = a.daftarBuktiPotong.daftarBuktiPotong;
            daftarBuktiPotongHandler.setDataBuktiPotong(lsBp);
            for (var i = 0; i < lsBp.length; i++) {
                jmlPphDiPotong += Number(lsBp[i].jmlPPhDiPotong);
            }
            number.setVal("#Idk12", jmlPphDiPotong).trigger("blur");
        }
    };

    var setDataPrepopulatedFinal = function (a) {
        if (a !== null) {
            daftarFinalHandler.setPrepFinal(a);
            itungA();
        }
    };

    var cekData = function () {
        var cekAsset = daftarAsetHandler.cekAssetCompletion($("#year").val());
        var cekUtang = daftarUtangHandler.cekUtangCompletion($("#year").val());
        return (cekAsset && cekUtang) ? true : false;
    };

    var simpanDraft = function () {
        common.loadingMessage("Memproses", "Mohon sabar menunggu");
        htPPh();
        statusDraft = 0;
        var b = $("input:radio[name='prepo']:checked").val();
        var sptmodel = prodata.setData('01', b);
        sessi.save(vNpwp, sptmodel);
        $.ajax({
            url: "/spt/draft",
            type: 'POST',
            data: sptmodel,
            success: function (data) {
                switch (data.kdStatus) {
                    case "99" :
                        common.showMessageRedirectAnotherPage("ERROR", data.message, "error", "/auth/login");
                        break;
                    case "0" :
                        common.showMessage("ERROR", data.ketStatus, "error");
                        break;
                    case "1" :
                        statusDraft = 1;
                        $("input[name='vThPajak']").val($('#year').val());
                        $("input[name='vRevNo']").val($('#txtPembetulanKe').val());
                        $("input[name='vToken']").val($('#ac').val());
                        break;
                    default :
                        common.showMessage("ERROR", "ERR090: Proses tidak berhasil dilakukan.", "error");
                        break;
                }
            },
            error: function (jqXhr, status, er) {
                common.showMessage("ERROR", "ERR099: Proses tidak berhasil dilakukan.", "error");
            },
            complete: function () {
                swal.close();
            }
        });
//        }
    };

    var simpanSpt = function () {
        statusSimpan = 0;
        var b = $("input:radio[name='prepo']:checked").val();
        var sptmodel = prodata.setData('01', b);
        sessi.save(vNpwp, sptmodel);
        $.ajax({
            url: "/spt/simpan",
            type: 'POST',
            data: sptmodel,
            success: function (data) {
                switch (data.kdStatus) {
                    case "99" :
                        common.showMessageRedirectAnotherPage()("ERROR", data.message, "error", "/auth/login");
                        break;
                    case "0" :
                        common.showMessage("ERROR", data.ketStatus, "error");
                        break;
                    case "1" :
                        statusSimpan = 1;
                        $('#txtJnsSpt').val('1770S');
                        $('#vThPajak').val($('#year').val());
                        $('#vRevno').val($('#txtPembetulanKe').val());
                        $("#vStatusLbKbn").val(kdlbkbn === '1' ? 'Kurang Bayar' : kdlbkbn === '2' ? "Lebih bayar" : 'Nihil');
                        number.setVal("#vJmlLbkbn", number.getVal("#Idk16"));
                        $('#vStatusPengiriman').val(data.message === '1' ? 'Lengkap' : 'Draft');
                        data.message === '1' ? $('#reload').show() : $('#reload').hide();
                        // spt1770swizard.goNext();
                        break;
                    default :
                        common.showMessage("ERROR", "ERR090: Proses tidak berhasil dilakukan.", "error");
                        break;
                }
            },
            error: function (jqXhr, status, er) {
                common.showMessage("ERROR", "ERR099: Proses tidak berhasil dilakukan.", "error");
            },
            complete: function () {
                swal.close();
            }
        });
    };

    return {
        init: function (frm, frmInd) {
            initForm();
            settingForm(frm, frmInd);
        }, getSpt: function () {
            getSpt();
        }, cekData: function () {
            return cekData();
        }, hitungPPh: function () {
            htPPh();
        }, simpanDraft: function () {
            simpanDraft();
        }, simpanSpt: function () {
            simpanSpt();
        }
    };
}();

KTUtil.onDOMContentLoaded((function() {
	KTCreateAccount.init();
    spt1770s.init();
    billing.init(false);
    daftarFinalHandler.init(false);
    daftarAsetHandler.init();
    daftarUtangHandler.init();
    daftarKeluargaHandler.init();
    daftarBuktiPotongHandler.init();
    submision.init();
}));