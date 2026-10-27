$("#tbl_dftr_ps42152223").DataTable();
$('.view-btn').on('click', function(e){
    e.preventDefault();
    var idBupot = $(this).attr('data-id');
    common.loadingMessage("Memproses Bukti Potong", "Mohon sabar menunggu");
    setTimeout(function () {
        validasi();
    }, 1000);

    function validasi() {
        var paramAjaxRequest = {
            idBupot: idBupot
        };

        var doneAjaxRequest = function (data) {
            if (data.code == 1) {
                swal.close();
                $('#modal_cetak').modal('show');
                $('#isi_cetak').html('<object class="pdf-content" data="data:application/pdf;base64,' + data.data + '" type="application/pdf" width="100%" height="450px"></object>');
            } else if (data.code == 9) {
                common.showMessageWithAction("Kesalahan", data.error_msg, "error", "Tutup", actErrorMessage);
            } else {
                common.showMessage("Kesalahan", data.error_msg, "error", "Tutup");
            }
        };
        common.ajaxJsonPost(function () {
        }, paramAjaxRequest, "/api/pph/report_ps42152223", doneAjaxRequest);
    }
});

$('.edit-btn').on('click', function (e) {
    e.preventDefault();
    var idBupot = $(this).attr('data-id');
    var revNo = $(this).attr('data-no');
    common.loadingMessage("Memproses", "Mohon sabar menunggu");
    setTimeout(function () {
        cekLapor(idBupot, "edit", revNo);
    }, 1000);
});

$('.delete-btn').on('click', function (e) {
    e.preventDefault();
    var idBupot = $(this).attr('data-id');
    var revNo = $(this).attr('data-no');
    common.loadingMessage("Memproses", "Mohon sabar menunggu");
    setTimeout(function () {
        cekLapor(idBupot, "hapus", revNo);
    }, 1000);
});

$('.send-btn').on('click', function (e) {
    e.preventDefault();
    var idBupot = $(this).attr('data-id');
    var namaDipotong = $(this).attr('data-nama');
    swalWithBootstrapButtons.fire({
        title: "Masukkan email yang akan dikirim",
        allowOutsideClick: false,
        showCloseButton: true,
        confirmButtonText: "Kirim",
        input: 'text',
        inputPlaceholder: "Email",
        inputValidator: function(result) {
            if (!result) {
                return 'Harus Diisi.';
            }
        }
    }).then(function(result) {
        if (result.value) {
            common.loadingMessage("Mengirim Email", "Mohon sabar menunggu");
            setTimeout(function () {
                sendEmail(result.value, idBupot, namaDipotong)
            }, 1000);
        }
    })
});


function cekLapor(idBupot, flag, revNo) {
    var paramAjakDelete = {
        idBupot: idBupot
    };
    var doneAjaxDelete = function (data) {
        if (data.code === 1) {
            var word1 = "";
            var word2 = "";
            if(data.data.fgLapor === "0" && revNo === "0"){
                if (flag === "hapus"){
                    word1 = "Hapus";
                    word2 = "menghapus";
                } else{
                    word1 = "Ubah";
                    word2 = "mengubah";
                }
            }else{
                if (flag === "hapus"){
                    word1 = "Batalkan";
                    word2 = "membatalkan";
                } else{
                    word1 = "Pembetulan";
                    word2 = "pembetulan";
                }
            }
            var actDoneDelete = function () {
                if (flag === "hapus"){
                    deleteBp(idBupot)
                } else{
                    common.formSubmitPost("/ebupot/pph/input-ps42152223", {idBupot: idBupot, status: 'Pembetulan', '_token': $('meta[name=csrf-token]').attr('content')}, 'post')
                }
            };
            common.showMessageQuestionWithAction(word1 +" Bukti Potong", "Apakah Anda yakin akan "+word2+" Bukti Potong?", "Oke", "Batal", actDoneDelete);
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
    }, paramAjakDelete, "/api/pph/check_laporspt", doneAjaxDelete);
}

function deleteBp(idBupot) {
    var paramAjakDelete = {
        idBupot: idBupot
    };
    var doneAjaxDelete = function (data) {
        if (data.code === 1) {
            var actErrorMessage = function () {
                location.reload();
            };
            common.showMessageWithAction("Sukses", "Data berhasil dihapus.", "success", "Oke", actErrorMessage);
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
    }, paramAjakDelete, "/api/pph/delete_bp_ps42152223", doneAjaxDelete);
}

function sendEmail(email, idBupot, namaDipotong) {
    var paramAjax = {
        idBupot: idBupot,
        namaDipotong: namaDipotong,
        email: email
    };
    var doneAjax = function (data) {
        if (data.code === 1) {
            var actErrorMessage = function () {
                location.reload();
            };
            common.showMessageWithAction("Sukses", data.message, "success", "Oke", actErrorMessage);
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
    }, paramAjax, "/api/pph/email_ps42152223", doneAjax);
}