var kodeMap = [];
var differentNpwp = [];
var npwpNol = [];
var mataUang = [];
var masaBulan = [];
var butuhNoSk = [];
var butuhNop = [];
var dataWp;

var FormSSE = function () {
    var initFormHandler = function () {

    	loadKodeMap($("#idJnsWp").val());
    	billcommon.getDefaultMasaPajak();
        defaultCurrency();
        billcommon.setMaskRupiah();
        
        $('#kdMap','#kjs','#msPjkAwl','#msPjkAkr','#thnPajak','#currency').select2();

        $("#kdMap").on("change", function () {
            loadJnsSetoran(this.value);
        });

        $("#kjs").on("change", function () {
        	billcommon.getDefaultMasaPajak();
            settingSetoran();
        });

        $(".jenis-npwp").change(function () {
            $("#npwp1").val("");
            $("#nama1").val("");
            $("#alamat1").val("");
            $("#npwp1").blur();
            $("#nama1").blur();
            $("#alamat1").blur();
            $("#nama1").attr("readonly", true);
            $("#alamat1").attr("readonly", true);
            if ($("#npwpSendiri").is(':checked')) {
                $("#blockDifferentNPWP").hide();
            } else {
                $("#blockDifferentNPWP").show();
            }
            settingRuleNpwpLain();
        });

        $("#msPjkAwl").on("change", function () {
            var mspjkawl = $("#msPjkAwl").val();
            $("#msPjkAkr").val(mspjkawl);
        });

        $("#npwp1").on("keyup", function () {
            kjs = $("#kjs").val();
            kdmap = $("#kdMap").val();
            if(billcommon.cleanString($("#npwp1").val()).length === 15) {
                // getInfoNpwpLain(kdMap, kdJnsStr);
            }
        });


        $('#btnGenerate').on("click", function () {
             if ($('#form_sse').valid() === false) {
                 return false;
             } else {
                 if ($("#kd_map").val() === "0" || $("#kd_jns_str").val() === "0") {
                     billcommon.showMessage("INFO", "Jenis Setoran Belum dipilih");
                 } else {
                     $('#captchaModal').modal('show');
                     billcommon.refreshcaptcha();
                     $("#captcha").val('');
                     $("#captcha").focus();
                 }
             }
        
         });
         
        $('#reload').on('click', function(){
            billcommon.refreshCaptcha();
        });
         
         $('#btnOk').on("click", function () {
             handleSimpan();
         })

         $('#btnCetak').on("click", function () {
             handleCetak();
         });
         $('#btnBatal').on("click", function () {
        	 loadKodeMap($("#idJnsWp").val());
             billcommon.getDefaultMasaPajak();
             $("#thnPajak").val('').trigger("change");
             $("#blockJenisNpwp").hide();
             $("#blockNop").hide();
             $("#blockNoSk").hide();
             $("#npwpSendiri").attr("checked", "checked");
             $("#nop").val("");
         	 $("#noSk").val("");
         	 $("#currency").val('01').trigger("change");
         	 $("#terbilang").val("");
         	 $("#jmlStr").val("");
         	 $("#uraian").val("");
             $("#blockMsPjk").show();
             $("#nop").hide;
         	 $("#noSk").hide;
         });

    };
    
    var validateform = function () {
        var form = $('#form_sse');
        var error = $('.alert-danger', form);
        var success = $('.alert-success', form);
        
        $.validator.addMethod("cekJumlahSetor", function (value, element) {
            if ($(".uang").autoNumeric('get') < 1) {
                return false;
            }
            $(element).parent().parent().find(".help-block").remove();
            return true;
        }, "Nilai tidak boleh kosong atau nol(0)");
        $.validator.addMethod("cekDigitJumlahSetor", function (value, element) {
            if ($(".uang").autoNumeric('get').length > 12) {
                return false;
            }
            $(element).parent().parent().find(".help-block").remove();
            return true;
        }, "Jumlah Setor tidak boleh lebih dari 12 digit.");

        $.validator.addMethod("checkMsPjk", function (value, element) {
            var msPjkAwl = parseInt($("#msPjkAwl").val());
            var msPjkAkr = parseInt($("#msPjkAkr").val());

            if (msPjkAwl > msPjkAkr) {
                return false;
            }

            $(element).parent().parent().find(".help-block").remove();

            return true;
        }, "Masa Pajak tidak valid.");

        
        form.validate({
            errorElement: 'span',
            errorClass: 'help-block help-block-error invalid-feedback',
            focusInvalid: false,
            ignore: "",
            rules: {
                npwp15: {
                    required: true
                },
                nama: {
                    required: true
                },
                alamat: {
                    required: true
                },
                kdMap: {
                    required: true
                },
                kjs: {
                    required: true
                },
                msPjkAwl: {
                    required: true,
                },
                msPjkAkr: {
                    required: true
                },
                thnPajak: {
                    required: true
                },
                nop: {
                	required: {
                		depends: function (element) {
	            			var kdJnsStr = $("#kjs").val();
	            			var kdMap = $("#kdMap").val();
	            			
	            			if (kdMap === '' || kdJnsStr === '') {
	            				return false;
	            			}
	            			
	            			var value = butuhNop[kdMap][kdJnsStr];
	            			
	            			if(value === 0){
	            				return false
	            			}
	            			
	            			return true;
                		}
                		
                	}
                },
                noSk: {
                	required: {
                		depends: function (element) {
	            			kdJnsStr = $("#kjs").val();
	            			kdMap = $("#kdMap").val();
	            			
	            			if (kdMap === "" || kdJnsStr === "") {
	            				return false;
	            			}
	            			
	            			var value = butuhNoSk[kdMap][kdJnsStr];
	            			
	            			if (value === 0) {
	            				return false;
	            			}
	            			
	            			return true;
                		}
                		
                	}
                },
                jmlStr: {
                    required: true,
                    cekJumlahSetor: true,
                    cekDigitJumlahSetor: true
                },
                npwp1:{
                	required: {
                		depends: function (element) {
                			var pilihan = $('input[name=jenisNpwp]:checked', '#form_sse').val();
            		        if (pilihan === "1") {
            		        	return true;
            		        }else{
            		        	return false;
            		        }
	            			
                		}
                	}
                },
                nama1:{
                	required: {
                		depends: function (element) {
                			var pilihan = $('input[name=jenisNpwp]:checked', '#form_sse').val();
            		        if (pilihan === "1") {
            		        	return true;
            		        }else{
            		        	return false;
            		        }
	            			
                		}
                	}
                },
                alamat1:{
                	required: {
                		depends: function (element) {
                			var pilihan = $('input[name=jenisNpwp]:checked', '#form_sse').val();
            		        if (pilihan === "1") {
            		        	return true;
            		        }else{
            		        	return false;
            		        }
	            			
                		}
                	}
                }
                
            },
            errorPlacement: function (error, element) { // render error placement for each input type
                if (element.parent(".input-group").length > 0) {
                    error.insertAfter(element.parent(".input-group"));
                } else if (element.parent(".kt-input-icon").length > 0) {
                    error.insertAfter(element.parent(".kt-input-icon"));
                }else if (element.attr("data-error-container")) {
                    error.appendTo(element.attr("data-error-container"));
                } else if (element.parents('.radio-list').length > 0) {
                    error.appendTo(element.parents('.radio-list').attr("data-error-container"));
                } else if (element.parents('.radio-inline').length > 0) {
                    error.appendTo(element.parents('.radio-inline').attr("data-error-container"));
                } else if (element.parents('.checkbox-list').length > 0) {
                    error.appendTo(element.parents('.checkbox-list').attr("data-error-container"));
                } else if (element.parents('.checkbox-inline').length > 0) {
                    error.appendTo(element.parents('.checkbox-inline').attr("data-error-container"));
                } else {
                    error.insertAfter(element); // for other inputs, just perform default behavior
                }
            },
            invalidHandler: function (event, validator) {
                success.hide();
                error.show();
            },
            highlight: function (element) {
                $(element)
                    .closest('.form-group')
                    .addClass('has-error');
            },
            unhighlight: function (element) {
                $(element)
                    .closest('.form-group')
                    .removeClass('has-error');
            },
            success: function (label) {
                label
                    .closest('.form-group')
                    .removeClass('has-error');
            },
            submitHandler: function (form) {
                // success.show();
                error.hide();
            }
        });
    };
    
    var loadKodeMap = function (param) {
        $.ajax({
            url: "/billing/getKdMap",
            type: 'GET',
            data: {idJnsWp: param},
            dataType: 'json',
            contentType: 'application/json',
            mimeType: 'application/json',
            success: function (resp) {
                if (resp.kdStatus === "1") {
                    if (resp.data !== null) {
                        kodeMap = resp.data;
                        getUnique(resp.data);
                    }
                } else {
                    billcommon.showMessage(resp.ketStatus, resp.message);
                }
            },
            error: function (jqXhr, status, er) {
            },
            complete: function () {
            }
        });
    };
    
    function getUnique(kodeMap) {
        var res = [];
        var distKodeMap = [];
        $.each(kodeMap, function (index, value) {
            if ($.inArray(value.type.kdMap, res) === -1) {
                res.push(value.type.kdMap);
                distKodeMap.push({
                	kode: value.type.kdMap,
                    nama: value.type.descMap
                });
            }
            
            if (differentNpwp[value.type.kdMap] === undefined) {
                differentNpwp[value.type.kdMap] = [];
            }
            differentNpwp[value.type.kdMap][value.kdSetor] = value.npwpLain;

            if (npwpNol[value.type.kdMap] === undefined) {
                npwpNol[value.type.kdMap] = [];
            }
            npwpNol[value.type.kdMap][value.kdSetor] = value.npwpNol;

            if (mataUang[value.type.kdMap] === undefined) {
                mataUang[value.type.kdMap] = [];
            }
            mataUang[value.type.kdMap][value.kdSetor] = value.mataUang;

            if (masaBulan[value.type.kdMap] === undefined) {
                masaBulan[value.type.kdMap] = [];
            }
            masaBulan[value.type.kdMap][value.kdSetor] = value.masaBulan;

            if (butuhNop[value.type.kdMap] === undefined) {
                butuhNop[value.type.kdMap] = [];
            }
            butuhNop[value.type.kdMap][value.kdSetor] = value.butuhNop;

            if (butuhNoSk[value.type.kdMap] === undefined) {
                butuhNoSk[value.type.kdMap] = [];
            }
            butuhNoSk[value.type.kdMap][value.kdSetor] = value.butuhNosk;
            
        });
        
        distKodeMap.sort(function (a, b) {
            if (Number(a['kode']) == Number(b['kode'])) {
                return 0;
            }
            if (Number(a['kode']) > Number(b['kode'])) {
                return 1;
            } else {
                return -1;
            }
        });
        
            
        $("#kdMap").empty();

        $("#kdMap").append("<option value=''>Pilih.....</option>");
        
        
        $.each(distKodeMap, function (index, value) {// looping untuk proses
            $("#kdMap").append("<option value=" + value.kode + ">" + value.kode + "-" + value.nama + "</option>");
        });
        $("#kdMap").val('').change();

    }
    
    function loadJnsSetoran(jnsPajak) {
    	
        $("#kjs").empty();
        dataKodeSetor = $(kodeMap).filter(function (i, n) {
            return n.type.kdMap === jnsPajak;
        });
        
        dataKodeSetor.sort(function (a, b) {
            if (Number(a['kdSetor']) == Number(b['kdSetor'])) {
                return 0;
            }
            if (Number(a['kdSetor']) > Number(b['kdSetor'])) {
                return 1;
            } else {
                return -1;
            }
        });
        
        $("#kjs").append("<option value=''>Pilih.....</option>");
        $.each(dataKodeSetor, function (index, nilai) {
            $("#kjs").append("<option value=" + nilai.kdSetor + ">" + nilai.kdSetor + "-" + nilai.descSetor + "</option>");
        });
    }

    var settingSetoran = function () {
        kdJnsStr = $("#kjs").val();
        kdMap = $("#kdMap").val();

        settingDifferentNpwp(kdMap, kdJnsStr);
        settingMsPjk(kdMap, kdJnsStr);
        settingNop(kdMap, kdJnsStr);
        settingNoSk(kdMap, kdJnsStr);

        
    };

    var defaultCurrency = function () {
        $("#currency").attr("disabled", true);
        $("#currency").val("01");
    };

    var settingDifferentNpwp = function (kdMap, kdJnsStr) {
        $("#npwp1").val("");
        $("#nama1").val("");
        $("#alamat1").val("");
      
    	if ((differentNpwp[kdMap][kdJnsStr] === null
            || differentNpwp[kdMap][kdJnsStr] === 0) && npwpNol[kdMap][kdJnsStr] === 0) {
    		$("#blockJenisNpwp").hide();
    		$("#npwpSendiri").prop("checked", true);
    		$(".jenis-npwp").change();
        } else if ((differentNpwp[kdMap][kdJnsStr] === null
            || differentNpwp[kdMap][kdJnsStr] === 0) && npwpNol[kdMap][kdJnsStr] === 1) {
            $("#blockJenisNpwp").hide();
            $("#npwpSendiri").prop("checked", true);
    		$(".jenis-npwp").change();
        } else if ((differentNpwp[kdMap][kdJnsStr] === null
            || differentNpwp[kdMap][kdJnsStr] === 0) && npwpNol[kdMap][kdJnsStr] === 2) {
        	$("#blockJenisNpwp").show();
            $("#npwpSendiri").prop("checked", true);
            $(".jenis-npwp").change();
        } else if ((differentNpwp[kdMap][kdJnsStr] === null
            || differentNpwp[kdMap][kdJnsStr] === 1) && npwpNol[kdMap][kdJnsStr] === 0) {
            $("#blockJenisNpwp").show();
            $("#npwpSendiri").prop("checked", true);
            $(".jenis-npwp").change();
        } else if ((differentNpwp[kdMap][kdJnsStr] === null
            || differentNpwp[kdMap][kdJnsStr] === 1) && npwpNol[kdMap][kdJnsStr] === 1) {
            $("#blockJenisNpwp").show();
            $("#npwpSendiri").prop("checked", true);
            $(".jenis-npwp").change();	
        } else if ((differentNpwp[kdMap][kdJnsStr] === null
                || differentNpwp[kdMap][kdJnsStr] === 2) && npwpNol[kdMap][kdJnsStr] === 0) {
            $("#blockJenisNpwp").show();
            $("#npwpSendiri").prop("checked", true);
            $(".jenis-npwp").change();
        }
    }

    var settingMsPjk = function (kdMap, kdJnsStr) {

        switch (masaBulan[kdMap][kdJnsStr]) {
            case 1:
                $("#blockMsPjk").show();
                $("#msPjkAwl").change();
                $("#msPjkAkr").attr("disabled", true);
                break;
            case 2:
                $("#blockMsPjk").hide();
                break;
            case 3:
            	$("#blockMsPjk").show();
                billcommon.getDefaultMasaPajak();
                $("#msPjkAwl").removeAttr("disabled");
                $("#msPjkAkr").removeAttr("disabled");
                break;
            default:
                break;
        }
    };
    
    var settingNop = function (kdMap, kdJnsStr) {
        switch (butuhNop[kdMap][kdJnsStr]) {
            case 0:
                $("#blockNop").hide();
                $("#nop").val("");
                break;
            case 1:
                $("#blockNop").show();
                $("#nop").val("");
                break;
            case 2:
                $("#blockNop").show();
                $("#nop").val("");
                break;
            default:
                break;
        }
    };

    var settingNoSk = function (kdMap, kdJnsStr) {
        switch (butuhNoSk[kdMap][kdJnsStr]) {
            case 0:
                $("#blockNoSk").hide();
				$("#noSk").val("");
                break;
            case 1:
                $("#blockNoSk").show();
                break;
            default:
                break;
        }
    };

    var settingRuleNpwpLain = function () {
    };

    var handleSimpan = function () {
        billcommon.loadingMessage("Memproses", "Mohon sabar menunggu");
        let dt = new Date();
        let no_of_months = 1;
        dt.setMonth(dt.getMonth() + no_of_months);
        kDMap = $("#kdMap").val();
        kJs = $("#kjs").val();
        npwpLain = $("#npwp15").val();
        npwpPenyetor = $("#npwp15").val();
        namaPenyetor = $("#nama").val();
        mspjka = $("#msPjkAwl").val().toUpperCase();
        mspjkb = $("#msPjkAkr").val().toUpperCase();
        if (masaBulan[kdMap][kdJnsStr] === 2) {
            mspjka = document.getElementById('msPjkAwl').value = "00";
            mspjkb = document.getElementById('msPjkAkr').value = "00";
        }
        if (npwpNol[kDMap][kJs] === 2) {
            if (npwpLain.substr(0, 9) === '000000000' && npwpLain.substr(12, 3) === '000') {
                npwpPenyetor = npwpLain;
                namaPenyetor = $("#nama1").val();
            }
        }

        var param = {
            capca: $("#captcha").val(),
            npwp: $('input[name=jenisNpwp]:checked', '#form_sse').val() === "1" ? billcommon.cleanString($("#npwp1").val()) : billcommon.cleanString($("#npwp15").val()),
            nama: $('input[name=jenisNpwp]:checked', '#form_sse').val() === "1" ? $("#nama1").val() : $("#nama").val(),
            alamat: $('input[name=jenisNpwp]:checked', '#form_sse').val() === "1" ? billcommon.cleanString2($("#alamat1").val()) : $("#alamat").val(),
            kdMap: kDMap,
            kjs: kJs,
            msPjkAwl: mspjka,
            msPjkAkr: mspjkb,
            thnPjk: $("#thnPajak").val(),
            noSk: $("#noSk").val() !== "" ? billcommon.cleanString($("#noSk").val()) : "000000000000000",
            nop: $("#nop").val() !== "" ? billcommon.cleanString($("#nop").val()) : "",
            jmlStr : $("#jmlStr").val().replace(/[.,]/g, ''),
            currCode: $("#currency").val() === "01" ? "360" : "840",

            uraian: billcommon.cleanString2($("#uraian").val()),
            npwpPenyetor: npwpPenyetor,
            namapenyetor: namaPenyetor
        };
        $.ajax({
            url: "/billing/getBillingCode",
            type: 'POST',
            data: param,
            success: function (data) {
                if (data.kdStatus === "1") {
                    var dataBilling = data.data;
                    if (dataBilling !== null) {
                        if (data.kdStatus === "1") {
                            handleCetak();
                        } else {
                            billcommon.showMessage(dataBilling.responseCode, dataBilling.responseDescription);
                        }
                    } else {
                        billcommon.showMessage(data.ketStatus, "terjadi kegagalan service");
                    }
                } else {
                    if (data.message === null) {
                        billcommon.showMessage(data.ketStatus, "terjadi kegagalan service");
                    } else {
                        billcommon.showMessage(data.ketStatus, data.message);
                    }
                }
            },
            error: function (jqXhr, status, er) {
                billcommon.showMessage(status, "Captcha Salah, Kode : " + jqXhr.status + ", " + er);
            }
        });
    };

    var handleCetak = function () {
        var param = {
            npwp: $('#npwp15').val(),
        };

        $.ajax({
            url: "/billing/cetakBilling",
            type: 'POST',
            data: param,
            
            success: function (data) {
            	billcommon.downloadPdf(data.message, "Cetakan Kode Billing.pdf");
                loadKodeMap($("#idJnsWp").val());
                billcommon.getDefaultMasaPajak();
                $("#thnPajak").val('').trigger("change");
                $("#blockJenisNpwp").hide();
                $("#blockNop").hide();
                $("#blockNoSk").hide();
                $("#npwpSendiri").attr("checked", "checked");
                $("#nop").val("");
                $("#noSk").val("");
                $("#currency").val('01').trigger("change");
                $("#terbilang").val("");
                $("#jmlStr").val("");
                $("#uraian").val("");
                $("#blockMsPjk").show();
                $("#nop").hide;
                $("#noSk").hide;
            },
            error: function (data, status, er) {
            },
            complete: function () {
                billcommon.showMessage('success', "Sukses");
            }
        });
    };
    
    return{
        init: function () {
            initFormHandler();
            billcommon.setMask();
            billcommon.setMaskRupiah();
            validateform();
        }
    };
}();

jQuery(document).ready(function () {
    FormSSE.init();
});