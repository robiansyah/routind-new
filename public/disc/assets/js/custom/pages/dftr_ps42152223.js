$(document).ready(function () {
    tableDftrPphps42152223();
    $('#btn-cari').on('click', function () {
        tableDftrPphps42152223();
    });

    exportExcel();

});

function exportExcel() {
    $('#btn-ekspor').on('click', function (e) {
        e.preventDefault();

        common.loadingMessage("Memproses Excel", "Mohon sabar menunggu");
        setTimeout(function () {
            downloadExcel();
        }, 2000);

        function downloadExcel() {
            var arrData = [];
            var data = $('#tbl_dftr_ps42152223').DataTable().data();
            $.each(data, function (key, value) {
                var obj = {
                    NO_BUKTI_POTONG: value.noBupot,
                    TANGGAL_BUKTI_POTONG: value.tglBupot,
                    NPWP_PEMOTONG: $('#npwpPemotong').val(),
                    NAMA_PEMOTONG: $('#namaPemotong').val(),
                    IDENTITAS_PENERIMA_PENGHASILAN: value.idDipotong,
                    NAMA_PENERIMA_PENGHASILAN: value.nmDipotong,
                    PENGHASILAN_BRUTO: value.jmlBruto,
                    PPH_DIPOTONG: value.jmlPphDipotong,
                    KODE_OBJEK_PAJAK: value.kdObjPjk,
                    PASAL: value.jnsPjk,
                    MASA_PAJAK: getMonthBupot(value.periode),
                    TAHUN_PAJAK: getYearBupot(value.periode),
                    STATUS: getStatusBupot(value.fgStatus),
                    REV_NO: value.revNo,
                    POSTING: getPosting(value.fgPosting),
                    ID_SISTEM: value.idBupot
                };
                arrData.push(obj);
            });
            var wb = XLSX.utils.book_new();
            var ws = XLSX.utils.json_to_sheet(arrData, {
                header: [
                    "NO_BUKTI_POTONG",
                    "TANGGAL_BUKTI_POTONG",
                    "NPWP_PEMOTONG",
                    "NAMA_PEMOTONG",
                    "IDENTITAS_PENERIMA_PENGHASILAN",
                    "NAMA_PENERIMA_PENGHASILAN",
                    "PENGHASILAN_BRUTO",
                    "PPH_DIPOTONG",
                    "KODE_OBJEK_PAJAK",
                    "PASAL",
                    "MASA_PAJAK",
                    "TAHUN_PAJAK",
                    "STATUS",
                    "REV_NO",
                    "POSTING",
                    "ID_SISTEM"]});
            XLSX.utils.book_append_sheet(wb, ws, "Bukti Potong");
            XLSX.writeFile(wb, 'EKSPOR_BUKTI_POTONG.xlsx');
            swal.close();
        }

    });

    function getMonthBupot(tanggal) {
        var date = tanggal.toString().split("-");
        return date[0];
    }

    function getYearBupot(tanggal) {
        var date = tanggal.toString().split("-");
        return date[1];
    }

    function getStatusBupot(fgStatus) {
        var status;
        switch (fgStatus) {
            case "0":
                status = "Normal";
                break;
            case "1":
                status = "Dibetulkan";
                break;
            case "2":
                status = "Dibatalkan";
                break;
            case "3":
                status = "Dihapus";
                break;
            default:
                status = "";
        }
        return status;
    }

    function getPosting(fgPosting) {
        var res;
        if(fgPosting === "1"){
            res = "Sudah";
        }else{
            res = "Belum";
        }
        return res;
    }
}

function tableDftrPphps42152223() {
    var tblDftrPphps42152223 = "tbl_dftr_ps42152223";
    var paramTblDftrPphps42152223 = {
        kdBupot: "0",
        year: $('#year').val(),
        period: $('#period').val()
    };
    var urlTblDftrPphps42152223 = "/api/pph/dftr_pphbp";
    var colTblDftrPphps42152223 = [
        {data: "periode"},
        {data: "kdObjPjk"},
        {data: "noBupot"},
        {data: "idDipotong"},
        {data: "nmDipotong"},
        {data: "jmlBruto"},
        {data: "jmlPphDipotong"},
        {data: "fgPosting"},
        {data: "idBupot"}

    ];
    var colDefTblDftrPphps42152223 = [
        {
            targets: 0,
            responsivePriority: 1,
            className: 'text-center',
        },
        {
            targets: [1,2,3,4],
            responsivePriority: 1,
            className: 'text-center'
        },
        {
            targets: [5,6],
            responsivePriority: 1,
            className: 'text-end',
            render: function (data, type, full, meta) {
                return common.formatNumber(data);
            }
        },
        {
            targets: 7,
            responsivePriority: 1,
            orderable: false,
            className: 'text-center w-100px',
            render: function (data, type, full, meta) {
                var posting, status, revNo;
                if(full.fgPosting === "1"){
                    posting='<span class="badge badge-success">Sudah&nbsp;Posting</span>';
                }else{
                    posting='<span class="badge badge-warning">Belum&nbsp;Posting</span>';
                }

                if(full.revNo > 0){
                    revNo = "Rev-" + full.revNo;
                }else{
                    revNo = "Normal";
                }

                switch (full.fgStatus) {
                    case "0":
                        status='<span class="badge badge-secondary">'+revNo+'</span>';
                        break;
                    case "1":
                        status='<span class="badge badge-info">Dibetulkan</span>';
                        break;
                    case "2":
                        status='<span class="badge badge-danger">Dibatalkan</span>';
                        break;
                    case "3":
                        status='<span class="badge badge-dark">Dihapus</span>';
                        break;
                }

                return posting + "<br/>" + status;
            }
        },
        {
            targets: -1,
            responsivePriority: 1,
            orderable: false,
            className: 'text-center w-100px',
            render: function (data, type, full, meta) {
                var disabled1 = (full.fgStatus === "3")?"disabled":"";
                var disabled2 = (full.fgStatus !== "0")?"disabled":"";
                return '<button type="button" ' + disabled1 +
                    ' class="btn btn-icon btn-active-light-primary w-25px h-25px view-btn" ' +
                    'data-bs-toggle="tooltip" data-bs-placement="top" title="lihat">' +
                    '<i class="fa fa-eye"></i>' +
                    '</button>' +
                    '<button type="button" ' + disabled2 +
                    ' class="btn btn-icon btn-active-light-primary w-25px h-25px edit-btn" ' +
                    'data-bs-toggle="tooltip" data-bs-placement="top" title="Ubah">' +
                    '<i class="fa fa-edit"></i>' +
                    '</button>' +
                    '<button type="button"' + disabled2 +
                    ' class="btn btn-icon btn-active-light-primary w-25px h-25px delete-btn"' +
                    'data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus">' +
                    '<i class="fa fa-trash-alt"></i>' +
                    ' </button>' +
                    '<button type="button"' + disabled1 +
                    ' class="btn btn-icon btn-active-light-primary w-25px h-25px send-btn"' +
                    'data-bs-toggle="tooltip" data-bs-placement="top" title="Kirim Email">' +
                    '<i class="fa fa-envelope"></i>' +
                    ' </button>';
            }
        }
    ];

    var afterAjaxTblDftrPphps42152223 = function () {

        $('#tbl_dftr_ps42152223 tbody').on('click', '.view-btn', function (e) {
            e.preventDefault();
            var data = $("#tbl_dftr_ps42152223").DataTable().row($(this).parents("tr")).data();
            var idBupot = data.idBupot;
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
                        var actErrorMessage = function () {
                            location.reload();
                        };
                        common.showMessageWithAction("Kesalahan", data.error_msg, "error", "Tutup", actErrorMessage);
                    } else {
                        common.showMessage("Kesalahan", data.error_msg, "error", "Tutup");
                    }
                };
                common.ajaxJsonPost(function () {
                }, paramAjaxRequest, "/api/pph/report_ps42152223", doneAjaxRequest);
            }
        });

        $('#tbl_dftr_ps42152223 tbody').on('click', '.edit-btn', function (e) {
            e.preventDefault();
            var data = $("#tbl_dftr_ps42152223").DataTable().row($(this).parents("tr")).data();
            var idBupot = data.idBupot;
            var revNo = data.revNo;
            common.loadingMessage("Memproses", "Mohon sabar menunggu");
            setTimeout(function () {
                cekLapor(idBupot, "edit", revNo);
            }, 1000);
        });

        $('#tbl_dftr_ps42152223 tbody').on('click', '.delete-btn', function (e) {
            e.preventDefault();
            var data = $("#tbl_dftr_ps42152223").DataTable().row($(this).parents("tr")).data();
            var idBupot = data.idBupot;
            var revNo = data.revNo;
            common.loadingMessage("Memproses", "Mohon sabar menunggu");
            setTimeout(function () {
                cekLapor(idBupot, "hapus", revNo);
            }, 1000);
        });

        $('#tbl_dftr_ps42152223 tbody').on('click', '.send-btn', function (e) {
            e.preventDefault();
            var data = $("#tbl_dftr_ps42152223").DataTable().row($(this).parents("tr")).data();
            var idBupot = data.idBupot;
            var namaDipotong = data.nmDipotong;
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
    };

    common.generateTable(tblDftrPphps42152223, urlTblDftrPphps42152223, paramTblDftrPphps42152223, 5, "asc", colTblDftrPphps42152223, colDefTblDftrPphps42152223, true, false, false, afterAjaxTblDftrPphps42152223);
}

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
