$(document).ready(function () {
    tableDftrPphss();
    $('#btn-cari').on('click', function () {
        tableDftrPphss();
    });
});

function tableDftrPphss() {
    var tblDftrPphss = "tbl_dftr_pphss";
    var paramTblDftrPphss = {
        year: $('#year').val(),
        period: $('#period').val()
    };
    var urlTblDftrPphss = "/api/pph/dftr_pphss";
    var colTblDftrPphss = [
        {data: "periode"},
        {data: "kdObjPajak"},
        {data: "noBuktiSetor"},
        {data: "jmlBruto"},
        {data: "jmlSetor"},
        {data: "idSetor"}
    ];
    var colDefTblDftrPphss = [
        {
            targets: 0,
            responsivePriority: 1,
            className: 'text-center',
            render: function (data, type, full, meta) {
                return '<div style="width: 100%;">' + data + '<div>';
            }
        },
        {
            targets: 1,
            responsivePriority: 1,
            className: 'text-center'
        },
        {
            targets: 2,
            responsivePriority: 1,
            className: 'text-center'
        },
        {
            targets: [3,4],
            responsivePriority: 1,
            className: 'text-right',
            render: function (data, type, full, meta) {
                return common.formatNumber(data);
            }
        },
        {
            targets: -1,
            responsivePriority: 1,
            orderable: false,
            className: 'text-center',
            render: function (data, type, full, meta) {
                return '<button type="button" ' +
                    ' class="btn btn-icon btn-active-light-primary w-25px h-25px edit-btn" ' +
                    'data-bs-toggle="tooltip" data-bs-placement="top" title="Ubah">' +
                    '<i class="fa fa-edit"></i>' +
                    '</button>' +
                    '<button type="button"' +
                    ' class="btn btn-icon btn-active-light-primary w-25px h-25px delete-btn"' +
                    'data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus">' +
                    '<i class="fa fa-trash-alt"></i>' +
                    ' </button>';
            }
        }
    ];

    var afterAjaxTblDftrPphss = function () {

        $('#tbl_dftr_pphss tbody').on('click', '.edit-btn', function (e) {
            e.preventDefault();
            var data = $("#tbl_dftr_pphss").DataTable().row($(this).parents("tr")).data();
            var id = data.id;
            common.loadingMessage("Memproses", "Mohon sabar menunggu");
            console.log('edit');
            setTimeout(function () {
                cekLapor(id, "edit");
            }, 1000);
        });

        $('#tbl_dftr_pphss tbody').on('click', '.delete-btn', function (e) {
            e.preventDefault();
            var data = $("#tbl_dftr_pphss").DataTable().row($(this).parents("tr")).data();
            var id = data.id;
            common.loadingMessage("Memproses", "Mohon sabar menunggu");
            setTimeout(function () {
                cekLapor(id,"hapus");
            }, 1000);
        });
    };

    common.generateTable(
        tblDftrPphss,
        urlTblDftrPphss,
        paramTblDftrPphss,
        5,
        "asc",
        colTblDftrPphss,
        colDefTblDftrPphss,
        false,
        false,
        false,
        afterAjaxTblDftrPphss);
}

function cekLapor(id, flag) {
    var paramAjakDelete = {
        id: id,
    };
    var doneAjaxDelete = function (data) {
        if (data.code == 1) {
            var word1 = "";
            var word2 = "";
            if(data.data.fgLapor === "0"){
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
                    if(word1 === "Hapus"){
                        deleteBuktiSetor(id)
                    }else{
                        common.showMessage("Kesalahan", "Bukti setor tidak dapat dihapus karena telah dilaporkan dalam SPT.", "error", "Tutup");
                    }
                } else{
                    common.formSubmitPost("/ebupot/pph/input-disetor-sendiri", {id: id, status: 'Pembetulan', '_token': $('meta[name=csrf-token]').attr('content')}, 'post')
                }
            };
            common.showMessageQuestionWithAction(word1 +" Bukti Setor", "Apakah Anda yakin akan "+word2+" Bukti Setor?", "Oke", "Batal", actDoneDelete);
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
    }, paramAjakDelete, "/api/pph/checkbs_laporspt", doneAjaxDelete);
}

function deleteBuktiSetor(id) {
    var paramAjakDelete = {
        fgSsKb: "1",
        id: id,
        npwp: $('#npwp-user').val()
    };
    var doneAjaxDelete = function (data) {
        if (data.code == 1) {
            var actErrorMessage = function () {
                location.reload();
            };
            common.showMessageWithAction("Sukses", "Data berhasil dihapus.", "success", "Oke", actErrorMessage);
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
    }, paramAjakDelete, "/api/spt/delete_bukt_isetor", doneAjaxDelete);
}