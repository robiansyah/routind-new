$(document).ready(function () {
    $('.djp-select2').each(function () {
        $(this).select2({
            placeholder: $(this).attr('data-placeholder'),
            allowClear: true
        });
    });

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
            if ($('#thnPjk').val() === (new Date().getFullYear()).toString()) end = parseInt(new Date().getMonth() + 1);
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
            if($('#thnPjk').val() === (new Date().getFullYear()).toString()){
                $('#msPjk option').filter(function () { return $(this).html() == getMonthName(new Date().getMonth() + 1); }).first().prop('selected', true).trigger('change');
            }
        }
    });

    $('#btnSubmit').on('click', function (e) {
        e.preventDefault();
        if($('#thnPjk').val() != "" && $('#msPjk').val() != ""){
            djpcommon.loadingMessage("Memproses", "Mohon sabar menunggu");
            setTimeout(function () {
                submitPosting();
            }, 1000);
            function submitPosting() {
                var paramAjax = {
                    thnPajak: $('#thnPjk').val(),
                    msPajak: $('#msPjk').val()
                };

                var ajaxDone = function (data) {
                    if (data.code == 1) {
                        var actDone = function () {
                            djpcommon.loadingMessage("Posting Bukti Potong", "Mohon sabar menunggu");
                            setTimeout(function () {
                                posting(data.data);
                            }, 1000);
                        };
                        djpcommon.showMessageQuestionWithAction("Posting", data.message+"?", "Oke", "Batal", actDone);
                    } else if (data.code == 9) {
                        var actErrorMessage = function () {
                            location.reload();
                        };
                        djpcommon.showMessageWithAction("Kesalahan", data.error_msg, "error", "Tutup", actErrorMessage);
                    } else {
                        djpcommon.showMessage("Kesalahan", data.error_msg, "error", "Tutup");
                    }
                };

                djpcommon.ajaxJsonPost(function () {}, paramAjax, "/api/pph/cek_posting", ajaxDone);
            }

        }else{
            djpcommon.showMessage("Kesalahan", "Tahun Pajak dan/atau Masa Pajak tidak boleh kosong.", "error", "Tutup");
        }
    });
});

function getMonthName(monthNumber) {
    var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    return months[monthNumber - 1];
}

function posting(data){
    var ajaxDone = function (data) {
        if (data.code == 1) {
            var actMessage = function () {
                location.reload();
            };
            djpcommon.showMessageWithAction("Sukses", "Berhasil Mengirim Bukti Potong.", "success", "Oke", actMessage);
        } else if (data.code == 9) {
            var actErrorMessage = function () {
                location.reload();
            };
            djpcommon.showMessageWithAction("Kesalahan", data.error_msg, "error", "Tutup", actErrorMessage);
        } else {
            djpcommon.showMessage("Kesalahan", data.error_msg, "error", "Tutup");
        }
    };

    djpcommon.ajaxJsonPost(function () {}, data, "/api/pph/kirim_posting", ajaxDone);
}