$(document).ready(function () {
    masking();
    upload();
    thnPajak();
    formValidation();
    tblDok();
    downloadExcel();
});

function getMonthName(monthNumber) {
    var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    return months[monthNumber - 1];
}

function masking() {
    $('.djp-select2').each(function () {
        $(this).select2({
            placeholder: $(this).attr('data-placeholder'),
            allowClear: true
        });
    });

    $("#npwp").inputmask({
        "mask": "99.999.999.9-999.999"
    });
}

function thnPajak() {
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
}

function upload(){
    var customFunc = function(filename){
        var result = false;
        var namafile = filename.substring(0, 15);
        var npwp = $("#npwp").inputmask("unmaskedvalue");
        if(namafile == npwp){
            result = true;
        }else{
            djpcommon.showMessage("Format Nama file tidak sesuai", "Mohon sesuaikan dengan format yang ada pada petunjuk panduan", "info", "OK");
            $("#file_error").html("Nama file harus sesuai dengan format yang ada pada petunjuk panduan");
        }
        return result;
    };
    djpcommon.settingFormUpload("xls", 2, customFunc);
}

function formValidation() {

    $('.djp-select2').on('change', function () {
        $(this).closest('.form-group').removeClass('has-error');
        $(this).closest('.form-group.form-group-md').find('span.invalid-feedback').hide();
    });

    $('#filepicker').on('change', function () {
        $(this).closest('.form-group').removeClass('has-error');
        $(this).closest('.form-group.form-group-md').find('span.invalid-feedback').hide();
    });

    var param = {
        thnPjk: {
            required: true
        },
        msPjk: {
            required: true
        },
        file: {
            required: true
        }
    };

    var msg = {
    };

    var actForm = function () {
        submitForm();
    };
    $.validator.addMethod('accept', function () { return true; });
    djpcommon.validateForm($('#formImport'), param, msg, actForm);
}

function submitForm() {
    var data = new FormData();
    var param = JSON.stringify({
        npwp: $("#npwp").inputmask("unmaskedvalue"),
        mspjk: $('#msPjk').val(),
        thnpjk: $('#thnPjk').val(),
        jnsBp: "PPHUNI"
    });
    data.append('file', $('#filepicker')[0].files[0]);
    data.append('param', param);

    $('#btnSubmit').attr('disabled', true);
    Swal.fire({
        title: 'Proses mengupload file',
        showConfirmButton: false,
        showCloseButton: false,
        showCancelButton: false,
        allowEscapeKey: false,
        allowOutsideClick: false,
        html:
            '<div id="progressParent" class="progress progress-lg" role="progressbar">' +
            '<div id="progress" class="progress-bar progress-bar-striped progress-bar-animated progress-lg"' +
            'role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;text-align: center"></div>',
        onOpen: function () {
            swal.showLoading();
        }
    });
    var ajaxReq = $.ajax({
        url: ctx + 'api/pph/import_bp',
        type: 'POST',
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        xhr: function () {
            var xhr = $.ajaxSettings.xhr();

            xhr.upload.onprogress = function (event) {
                var perc = Math.round((event.loaded / event.total) * 100);
                $('#progress').text(perc + '%');
                $('#progress').css('width', perc + '%');
            };
            return xhr;
        },
        beforeSend: function (xhr) {
            //Reset alert message and progress bar
            $('#progress').text('');
            $('#progress').css('width', '0%');
        }
    });

    ajaxReq.done(function (data) {
        setTimeout(function () {
            if (data === null || data === "") {
                djpcommon.showMessage("Kesalahan", "Terjadi kegagalan server. Mohon ulangi kembali", "error", "OK");
            } else {
                if(data.code == 1){
                    var actErrorMessage = function () {
                        location.reload();
                    };
                    djpcommon.showMessageWithAction("Sukses", "Data berhasil diunggah.", "success", "Oke", actErrorMessage);
                }else if (data.code == 9) {
                    var actErrorMessage = function () {
                        location.reload();
                    };
                    djpcommon.showMessageWithAction("Kesalahan", data.error_msg, "error", "Tutup", actErrorMessage);
                } else {
                    djpcommon.showMessage("Kesalahan", data.error_msg, "error", "Tutup");
                }
            }
            $('#btnSubmit').removeAttr('disabled');
        }, 1000);
    });
}

function tblDok() {
    $('#btn-refresh').on('click', function () {
        $('#tbl_dftr_import').DataTable().clear();
        $('#tbl_dftr_import').DataTable().ajax.reload();
    });

    var idTbl = "tbl_dftr_import";
    var paramTbl = {};
    var urlTbl = ctx + "api/pph/dftr_dok";
    var colTbl = [
        {data: "noTiket"},
        {data: "namaFile"},
        {data: "tglUpload"},
        {data: "jmlBaris"},
        {data: "status"},
        {data: "ketUpload"},
        {data: null}
    ];
    var colDefTbl = [

        {
            targets: [0,1,2,3,5],
            responsivePriority: 1,
            className: 'text-center'
        },
        {
            targets: 4,
            responsivePriority: 1,
            className: 'text-center',
            render: function (data, type, full, meta) {
                var status;
                switch(data){
                    case "0":
                        status = "Belum Diproses";
                        break;
                    case "1":
                        status = "Sedang Diproses";
                        break;
                    case "2":
                        status = "Io Exception";
                        break;
                    case "3":
                        status = "Sukses Validasi";
                        break;
                    case "4":
                        status = "Gagal Validasi";
                        break;
                    case "5":
                        status = " Sukses Validasi Error Generate Bupot";
                        break;
                }
                return status;
            }
        },
        {
            targets: -1,
            responsivePriority: 1,
            orderable: false,
            className: 'text-center',
            render: function (data, type, full, meta) {
                if(full.status === "3" || full.status === "4" || full.status === "5"){
                    return '<div class="d-flex"><button type="button" ' +
                        'class="btn btn-djp btn-sm btn-elevate btn-circle btn-icon mb-1 mr-1 view-btn" ' +
                        'data-skin="djp" data-container="body" ' +
                        'data-toggle="kt-tooltip" data-placement="bottom" title=""' +
                        'data-original-title="Lihat">' +
                        '<i class="fa fa-eye"></i>' +
                        '</button></div>';
                }else{
                    return "";
                }
            }
        }
    ];
    var afterAjaxTbl = function () {
        $('#tbl_dftr_import tbody').on('click', '.view-btn', function (e) {
            e.preventDefault();
            var data = $("#tbl_dftr_import").DataTable().row($(this).parents("tr")).data();
            var idTiket = data.noTiket;
            var paramAjax = {
                idTiket: idTiket
            };
            var ajaxDone = function (dataCek) {
                if (dataCek.code == 1) {
                    if(dataCek.data.fgValidasi === "1"){
                        detilDok(idTiket);
                    }else {
                        djpcommon.showMessage("Informasi", "Masih dalam proses.", "info", "Tutup");
                    }
                } else if (dataCek.code == 9) {
                    var actErrorMessage = function () {
                        location.reload();
                    };
                    djpcommon.showMessageWithAction("Kesalahan", dataCek.error_msg, "error", "Tutup", actErrorMessage);
                } else {
                    djpcommon.showMessage("Kesalahan", dataCek.error_msg, "error", "Tutup");
                }
            };
            djpcommon.ajaxJsonPost(function () {}, paramAjax, ctx + "api/pph/cek_validasi", ajaxDone);
        });
    };
    djpcommon.generateTable(idTbl, urlTbl, paramTbl, 5, "desc", colTbl, colDefTbl, false, false, false, afterAjaxTbl);
}

function detilDok(idTiket) {
    $('#modal_detil').modal("show");
    var idTbl1 = "tbl_detil_dok";
    var paramTbl1 = {
        idTiket: idTiket
    };
    var urlTbl1 = ctx + "api/pph/detil_dok";
    var colTbl1 = [
        {data: "jnsBupot"},
        {data: "rowKe"},
        {data: "fgProses"},
        {data: "msgProses"}
    ];
    var colDefTbl1 = [
        {
            targets: [0,1],
            responsivePriority: 1,
            className: 'text-center'
        },
        {
            targets: 2,
            responsivePriority: 1,
            className: 'text-center',
            render: function (data, type, full, meta) {
                var str = "";
                if(data === "1"){
                    str = "Error";
                }else{
                    str = "Success";
                }
                return str;
            }
        },
        {
            targets: 3,
            responsivePriority: 1,
            className: 'text-center',
            render: function (data, type, full, meta) {
                var str = data.toString();
                str.replace("\\r\\n", "");
                return str;
            }
        }
    ];
    var afterAjaxTbl1 = function () {
        $('#btn-cari').on('click', function(e) {
            e.preventDefault();
            var params = {};
            params[2] = $('input[name="optCari"]:checked').val();
            $.each(params, function(i, val) {
                // apply search params to datatable
                $("#tbl_detil_dok").DataTable().column(i).search(val ? val : '', false, false);
            });
            $("#tbl_detil_dok").DataTable().table().draw();
        });
    };
    djpcommon.generateTable(idTbl1, urlTbl1, paramTbl1, 5, "desc", colTbl1, colDefTbl1, true, true, false, afterAjaxTbl1);
}

function downloadExcel() {
    $('#btn-excel').on('click', function(e) {
        e.preventDefault();
        var arrData = [];
        var data = $('#tbl_detil_dok').DataTable().data();
        $.each(data, function (key, value) {
            var strStatus = "";
            if(value.fgProses === "1"){
                strStatus = "Error";
            }else{
                strStatus = "Success";
            }
            var strMsgStatus = value.msgProses.toString();
            strMsgStatus.replace("\\r\\n", "");
            var obj = {
                JENIS_PASAL: value.jnsBupot,
                BARIS_EXCEL: value.rowKe,
                STATUS_VALIDASI: strStatus,
                KETERANGAN_VALIDASI: strMsgStatus
            };
            arrData.push(obj);
        });
        var wb = XLSX.utils.book_new();
        var ws = XLSX.utils.json_to_sheet(arrData, {header:["JENIS_PASAL","BARIS_EXCEL","STATUS_VALIDASI","KETERANGAN_VALIDASI"]});
        XLSX.utils.book_append_sheet(wb, ws, "Hasil Validasi");
        XLSX.writeFile(wb, 'HASIL_VALIDASI.xlsx');
    });
}