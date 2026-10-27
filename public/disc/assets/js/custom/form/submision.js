var submision = function () {
    var requestToken = function (p, f) {
        common.loadingMessage("Memproses", "Mohon sabar menunggu");
        $.ajax({
            url: "/submit/token",
            type: 'POST',
            data: p,
            success: function (data) {
                if (data.kdStatus === "1") {
                    swal.close();
                    $('#btnAmbilToken').removeAttr("disabled");
                    $('#divToken').modal('hide');
                    common.showMessage("SUCCESS", data.ketStatus, "success", "Ok");
                } else {
                    $('#codeServer').html('');
                    $('#codeServer').hide();
                    common.showMessage("ERROR", data.ketStatus, "error");
                }
            },
            error: function (jqXhr, status, er) {
                common.showMessage("ERROR", "ERR099: Proses tidak berhasil dilakukana.", "error", "OK");
            }
        });
    };

    var submitSpt = function (p, f, ctl) {
        common.loadingMessage("Memproses", "Mohon sabar menunggu");
        $.ajax({
            url: "/submit/spt",
            type: 'POST',
            data: p,
            success: function (data) {
                const actSuccess = function () {
                    location.href = "/spt/arsip";
                };
                common.showMessageWithAction('Sukses', data.ketStatus, 'success', 'Ok, got it!', actSuccess);
            },
            error: function (jqXhr, status, er) {
                common.showMessage("ERROR", "ERR099: Kode Keamanan Salah.", "error", "OK");
                common.refreshCaptcha();
            },
            complete: function (jqXHR, textStatus) {
                $('#btnSubmitSpt').removeAttr("disabled");
            }
        });
    };

    var setForm = function () {

        var nohp = "";
        $("input[name=rdKodeVer]:radio").on("change", function () {
            if ($("#rbEmail").attr("checked")) {
                $('#divEmail').removeClass("disabled").removeClass("hidden");
                $('#divTokenId').addClass("hidden");
                $('#txtToken').val('');
            } else {
                $('#divTokenId').removeClass("disabled").removeClass("hidden");
                $('#divEmail').addClass("hidden");
                $('#txtToken').val('');
            }
        });

        $("input[name=tokenvia]:radio").on("change", function () {
            var tokenvia = $("input:radio[name='tokenvia']:checked").val();
            if (tokenvia === '0') {
                nohp = "0";
            } else {
                nohp = "1";
            }
        });

        $('#btnSubmitSpt').on("click", function () {
            $('#btnSubmitSpt').attr("disabled", "disabled");
            var obj = {
                token: $("#txtToken").val(),
                thPajak: $("#vThPajak").val(),
                pembetulan: $("#vRevno").val(),
                jnsSpt: $("#txtJnsSpt").val()
            };
            if ($("#txtToken").val() === null || $("#txtToken").val().length === 0) {
                common.showMessage("WARNING", "Masukkan Kode Verifikasi", "warning");
                $('#btnSubmitSpt').removeAttr("disabled");
            } else {
                submision.submitSpt(obj, '#divSubmit');
            }
        });

        $('#btnAmbilToken2').on("click", function () {
            if (statusLengkap === 0 || statusLengkap === "0") {
                $('#divToken').modal('hide');
                var jns = $('#txtJnsSpt').val();
                if (jns === "1770SS") {
                    if (kdlbkbn === '1') {
                        $('#divInfoTLKB').modal('show');
                        $('#divInfoTLKB').modal({show: true});
                    } else if (kdlbkbn === '2') {
                        $("#divRedirect1770ss1").show();
                        $('#divRedirect1770ss1').modal('show');
                        spt1770ss.redirectSs();
                    }
                } else if (jns === "1770S") {
                    if (kdlbkbn === '1') {
                        $('#divInfoTLKB').modal('show');
                        $('#divInfoTLKB').modal({show: true});
                    } else if (kdlbkbn === '2') {
                        $('#divInfoTLLB').modal('show');
                        $('#divInfoTLLB').modal({show: true});
                    } else if (kdlbkbn === '0') {
                        $('#divInfoTLNhl').modal('show');
                        $('#divInfoTLNhl').modal({show: true});
                    }
                }
            } else if (statusLengkap === 1 || statusLengkap === "1") {
                $('#divToken').modal('show');
                $('#divToken').modal({show: true});
            }
        });
        
        $('#btnAmbilToken').on("click", function () {
            if (statusLengkap === 0 || statusLengkap === "0") {
                $('#divToken').modal('hide');
                var jns = $('#txtJnsSpt').val();
                if (jns === "1770SS") {
                    if (kdlbkbn === '1') {
                        $('#divInfoTLKB').modal('show');
                        $('#divInfoTLKB').modal({show: true});
                    } else if (kdlbkbn === '2') {
                        $("#divRedirect1770ss1").show();
                        $('#divRedirect1770ss1').modal('show');
                        spt1770ss.redirectSs();
                    }
                } else if (jns === "1770S") {
                    if (kdlbkbn === '1') {
                        $('#divInfoTLKB').modal('show');
                        $('#divInfoTLKB').modal({show: true});
                    } else if (kdlbkbn === '2') {
                        $('#divInfoTLLB').modal('show');
                        $('#divInfoTLLB').modal({show: true});
                    } else if (kdlbkbn === '0') {
                        $('#divInfoTLNhl').modal('show');
                        $('#divInfoTLNhl').modal({show: true});
                    }
                }
            } else if (statusLengkap === 1 || statusLengkap === "1") {
                $('#btnAmbilToken').attr("disabled", "disabled");
                var obj = {
                    thPajak: $("#vThPajak").val(),
                    pembetulan: $("#vRevno").val(),
                    nohp: nohp,
                    jnsSpt: $("#txtJnsSpt").val()
                };

                submision.requestToken(obj, '#divSubmit');
            }
        });
    };

    return {
        init: function () {
            setForm();
        },
        submitSpt: function (p, f) {
            submitSpt(p, f);
        },
        requestToken: function (p, f) {
            requestToken(p, f);
        },
    };
}();