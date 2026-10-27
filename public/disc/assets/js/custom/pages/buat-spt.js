$(document).ready(function () {
    validation();

    var year = parseInt($('#date').val().toString().split("/")[2]) - 1;;
    $('#year').val(year).change();
});

function validation(){
    $('#year').on('change', function () {
        var currentYear = $('#date').val().toString().split("/")[2];
        if($(this).val() === currentYear){
            var confirmAct = function () {
                validasiSpt();
            };
            var cancelAct = function () {
                $('#year').val(null).trigger('change')
            };
            common.showMessageQuestionWithActionAndCancel(
                "Konfirmasi",
                "Anda telah memilih SPT dengan tahun pembukuan/pajak "+$(this).val()+", apakah anda yakin mengunduh formulir tersebut?",
                "warning",
                "Ya",
                "Tidak",
                confirmAct,
                cancelAct)
        }else{
            validasiSpt();
        }

        function validasiSpt() {
            var year = $('#year').val();
            if (year !== null && year !== "") {
                $('#normal').prop("checked", true).trigger("change");
                common.loadingMessage("Memproses", "Mohon sabar menunggu");
                setTimeout(function () {
                    cekSpt($('#year').val());
                }, 1000);
            }
        }
    });

    $('input[name="correction_to"]').on('change', function () {
        if ($('input[name="correction_to"]:checked').val() == "1") {
            $('#correction_no').val("0");
        } else {
            $('#correction_no').val("");
        }
    });

    if ($('input[name="correction_to"]:checked').val() == "1") {
        $('#correction_no').val("0");
    } else {
        $('#correction_no').val("");
    }
}

function cekSpt(year) {
    var paramAjaxRequest = {
        thnPjk: year
    };
    var doneAjaxRequest = function (data) {
        if (data.code == 1) {
            swal.close();
            if(data.data != null){
                $('#correction').prop("checked", true).trigger("change");
                $('#correction_no').val(parseInt(data.data.revNo) + 1);
                if(parseInt(year) >= 2022){
                    common.showMessage("PERHATIAN", "SPT anda " +
                        "merupakan SPT dengan status pembetulan Apabila atas " +
                        "SPT yang dibetulkan pernah diterbitkan SKPPKP, pastikan " +
                        "informasi terkait SKPPKP telah diinput ke dalam SPT sesuai " +
                        "dengan PER-04/PJ/2021", "warning", "Oke");
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
    }, paramAjaxRequest, "/ajax/cek_spt", doneAjaxRequest);
}