$(document).ready(function () {
    if ($('#msgError').val() !== "") {
        var actErrorMessage = function () {
            window.location.href = "/ebupot/sptmasa/penyiapan-spt";
        };
        djpcommon.showMessageWithAction("Kesalahan", $('#msgError').val(), "error", "Tutup", actErrorMessage);
    }

    $('#btnReset').on('click', function () {
        window.location.href = "/ebupot/sptmasa/penyiapan-spt";
    });

    masking();
    tableLampDoss();
    tableLampDopp();
    tableLampDbp1();
    tableLampDbp2();
    upload();
    sertel();
});

function masking() {
    $("#npwp").inputmask({
        "mask": "99.999.999.9-999.999"
    });
    $(".currency").each(function () {
        if($(this).val() == ""){
            $(this).val("0");
        }
        $(this).inputmask({
            alias: "currency",
            prefix: "",
            groupSeparator: ".",
            digits: "0",
        });
    });
}

function tableLampDoss() {
    var columns = [
        {data: "nmObjPjk"},
        {data: "kdObjPjk"},
        {data: "jmlBruto"},
        {data: "jmlPph"}
    ];
    var columnsDefs = [
        {
            targets: 0,
            className: 'text-left'
        },
        {
            targets: 1,
            className: 'text-center'
        },
        {
            targets: [2,3],
            responsivePriority: 1,
            className: 'text-right',
            render: function (data, type, full, meta) {
                return '<div class="currency-mask">' + data + '<div>';
            }
        }
    ];

    dataTableCustom("tbl_doss", columns, columnsDefs);
}

function tableLampDopp() {
    var columns = [
        {data: "nmObjPjk"},
        {data: "kdObjPjk"},
        {data: "jmlBruto"},
        {data: "jmlPph"}
    ];
    var columnsDefs = [
        {
            targets: 0,
            className: 'text-left'
        },
        {
            targets: 1,
            className: 'text-center'
        },
        {
            targets: [2,3],
            responsivePriority: 1,
            className: 'text-right',
            render: function (data, type, full, meta) {
                return '<div class="currency-mask">' + data + '<div>';
            }
        }
    ];

    dataTableCustom("tbl_dopp", columns, columnsDefs);
}

function tableLampDbp1() {
    var columns = [
        {data: "pasal"},
        {data: "idDipotong"},
        {data: "nama"},
        {data: "kdObjPjk"},
        {data: "noBupot"},
        {data: "tglBupot"},
        {data: "jmlBruto"},
        {data: "pphDipotong"},
        {data: "keterangan"}
    ];
    var columnsDefs = [
        {
            targets: [1,2, -1],
            className: 'text-left'
        },
        {
            targets: [0,3,4,5],
            className: 'text-center'
        },
        {
            targets: [6,7],
            responsivePriority: 1,
            className: 'text-right',
            render: function (data, type, full, meta) {
                return '<div class="currency-mask">' + data + '<div>';
            }
        }
    ];

    dataTableCustom("tbl_dbp1", columns, columnsDefs);
}

function tableLampDbp2() {
    var columns = [
        {data: "kdMap"},
        {data: "kjs"},
        {data: "noBuktiSetor"},
        {data: "tglSetor"},
        {data: "jmlSetor"}
    ];
    var columnsDefs = [
        {
            targets: 2,
            className: 'text-left'
        },
        {
            targets: [0,1,3],
            className: 'text-center'
        },
        {
            targets: -1,
            responsivePriority: 1,
            className: 'text-right',
            render: function (data, type, full, meta) {
                return '<div class="currency-mask">' + data + '<div>';
            }
        }
    ];

    dataTableCustom("tbl_dbp2", columns, columnsDefs);
}

function upload(){
    var customFunc = function(filename){
        return true;
    };
    djpcommon.settingFormUpload("p12", 5, customFunc);
}

function sertel() {
    var privateKey = null;
    var cert = null;
    var signature = null;
    var file = null;
    var password = null;
    var pkcs12Der = null;
    var npwpSes = $('#npwp').inputmask("unmaskedvalue");
    var npwpFormatedSes = $('#npwp').val();

    var prepareSign = function () {
        var defer = $.Deferred();

        // Get file
        // var fileInput = document.getElementById('filepicker');
        // var fileTO = $('#filepicker');
        // file = fileInput.files[0];
        //
        // // Read it
        // var reader = new FileReader();
        // reader.onload = function (e) {
        //     var contents = e.target.result;
        //     pkcs12Der = arrayBufferToString(contents);
        //     var pkcs12Asn1 = null;
        //     var pkcs12 = null;
        //
        //     password = $('#passphrase').val();
        //
        //     var filename = fileTO.val();
        //     var parts = filename.split('.');
        //     var ext = parts[parts.length - 1];
        //     if (ext.toLowerCase() != "p12") {
        //         swal.fire({
        //             title: "Kesalahan",
        //             text: "File bukan sertifikat elekronik",
        //             type: "error",
        //             allowOutsideClick: false,
        //             confirmButtonText: "OK",
        //             buttonsStyling: false,
        //             confirmButtonClass: "btn btn-djp"
        //         });
        //         return false;
        //     }
        //
        //     try {
        //         pkcs12Asn1 = forge.asn1.fromDer(pkcs12Der);
        //     } catch (e) {
        //         swal.fire({
        //             title: "Kesalahan",
        //             text: "File Sertifikat tidak valid",
        //             type: "error",
        //             allowOutsideClick: false,
        //             confirmButtonText: "OK",
        //             buttonsStyling: false,
        //             confirmButtonClass: "btn btn-djp"
        //         });
        //         return false;
        //     }
        //
        //     try {
        //         pkcs12 = forge.pkcs12.pkcs12FromAsn1(pkcs12Asn1, false, password);
        //     } catch (e) {
        //         swal.fire({
        //             title: "Kesalahan",
        //             text: "Passphrase tidak valid",
        //             type: "error",
        //             allowOutsideClick: false,
        //             confirmButtonText: "OK",
        //             buttonsStyling: false,
        //             confirmButtonClass: "btn btn-djp"
        //         }).then(function (result) {
        //             if (result.value) {
        //                 $('#passphrase').val("");
        //             }
        //         });
        //         return false;
        //     }
        //
        //     // load keys
        //     // for (var sci = 0; sci < pkcs12.safeContents.length; ++sci) {
        //     //     var safeContents = pkcs12.safeContents[sci];
        //     //     for (var sbi = 0; sbi < safeContents.safeBags.length; ++sbi) {
        //     //         var safeBag = safeContents.safeBags[sbi];
        //     //         if (safeBag.type === forge.pki.oids.keyBag) {
        //     //             //Found plain private key
        //     //             privateKey = safeBag.key;
        //     //         }
        //     //         else if (safeBag.type === forge.pki.oids.pkcs8ShroudedKeyBag) {
        //     //             // found encrypted private key
        //     //             privateKey = safeBag.key;
        //     //         }
        //     //         else if (safeBag.type === forge.pki.oids.certBag) {
        //     //             // this bag has a certificate...
        //     //             var cn = safeBag.cert.subject.getField('CN').value;
        //     //             //get certificate wp
        //     //             if (cn.indexOf(npwpSes) !== -1) {
        //     //                 cert = safeBag.cert;
        //     //             }
        //     //         }
        //     //     }
        //     // }
        //
        //     // if (cert === null) {
        //     //     swal.fire({
        //     //         title: "Kesalahan",
        //     //         text: "Sertifikat tidak bisa digunakan untuk NPWP " + npwpFormatedSes,
        //     //         type: "error",
        //     //         allowOutsideClick: false,
        //     //         confirmButtonText: "OK",
        //     //         buttonsStyling: false,
        //     //         confirmButtonClass: "btn btn-djp"
        //     //     }).then(function (result) {
        //     //         if (result.value) {
        //     //             $('#passphrase').val("");
        //     //         }
        //     //     });
        //     //     return false;
        //     // }
        // };
        // reader.readAsArrayBuffer(file);

        setTimeout(function () {
            defer.resolve();
        }, 1000);
        return defer;
    };

    function arrayBufferToString(buffer) {
        var binary = '';
        var bytes = new Uint8Array(buffer);
        var len = bytes.byteLength;
        for (var i = 0; i < len; i++) {
            binary += String.fromCharCode(bytes[ i ]);
        }
        return binary;
    }

    var doSign = function () {
        var defer = $.Deferred();

        var p7 = forge.pkcs7.createSignedData();
        p7.content = forge.util.createBuffer($('#signature').val(), 'utf8');
        p7.addSigner({
            key: privateKey,
            certificate: cert,
            digestAlgorithm: forge.pki.oids.sha256
        });
        p7.sign({detached: true});

        var pem = forge.pkcs7.messageToPem(p7);
        var pemWithoutHeader = pem.replace("-----BEGIN PKCS7-----", '');
        var pemWithoutHeaderAndFooter = pemWithoutHeader.replace("-----END PKCS7-----", '');
        signature = pemWithoutHeaderAndFooter.trim();

        setTimeout(function () {
            defer.resolve();
        }, 500);
        return defer;
    };

    var sendSertel = function () {
        var defer = $.Deferred();

        var msThnPajak = $('#msThnPajak').val();
        var param = msThnPajak.split("/");

        var paramAjax = {
            npwp: $('#npwp').inputmask("unmaskedvalue"),
            idSpt: $('#idSpt').val(),
            // serial: cert.serialNumber,
            // signature: signature,
            msPjk: param[1],
            thnPjk: param[0]
        };

        var doneAjax = function (data) {
            if (data.code == 1) {
                var actDone = function () {
                    window.location.href = "/ebupot/sptmasa/penyiapan-spt";
                };
                djpcommon.showMessageWithAction("Sukses", "SPT Masa berhasil dikirim.", "success", "Oke", actDone);
            } else if (data.code == 9) {
                var actErrorMessage = function () {
                    location.reload();
                };
                djpcommon.showMessageWithAction("Kesalahan", data.error_msg, "error", "Tutup", actErrorMessage);
            } else {
                djpcommon.showMessage("Kesalahan", data.error_msg, "error", "Tutup");
            }
        };

        djpcommon.ajaxJsonPost(function(){}, paramAjax, "/api/spt/save_kirim", doneAjax);

        setTimeout(function () {
            defer.resolve();
        }, 1000);
        return defer;
    };


    var submitSpt = function () {
        privateKey = null;
        cert = null;
        djpcommon.loadingMessage("Memproses Sertifikat Elektronik", "Mohon sabar menunggu");
        // prepareSign().then(doSign).then(sendSertel);
        prepareSign().then(sendSertel);
    };

    var paramFormSertel = {
        passphrase: {
            required: true
        },
        file: {
            required: true,
            accept: false
        }
    };
    djpcommon.validateForm($('#formSertel'), paramFormSertel, {}, submitSpt);

    // $('#btnSubmit').on('click', function (e) {
    //     e.preventDefault();
    //     submitSpt();
    // });
}

function dataTableCustom(idTable, columns, columnDefs){
    $("#"+idTable).DataTable({
        searching: false,
        bDestroy: true,
        lengthMenu: [
            [5, 10, 25, 30],
            [5, 10, 25, 30],
        ],
        pageLength: 5,
        processing: true,
        language: {
            processing:
                '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Sedang memproses...</span>',
            sLengthMenu: "Tampilkan _MENU_ entri",
            sZeroRecords: "Tidak ditemukan",
            sInfo: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
            sInfoEmpty: "Menampilkan 0 sampai 0 dari 0 entri",
            sInfoFiltered: "(disaring dari _MAX_ entri keseluruhan)",
            sInfoPostFix: "",
            sSearch: "Cari:",
            sUrl: "",
            oPaginate: {
                sFirst: "Pertama",
                sPrevious: "Sebelumnya",
                sNext: "Selanjutnya",
                sLast: "Terakhir"
            }
        },
        columns: columns,
        columnDefs: columnDefs,
        drawCallback: function (settings) {
            $('[data-toggle="kt-tooltip"]').tooltip({
                trigger: "hover",
            });
            $(".currency-mask").inputmask({
                alias: "currency",
                prefix: "",
                groupSeparator: ".",
                digits: "0",
            });
            $(".currency-mask").each(function () {
                if ($(this).val() == "") {
                    $(this).val(0);
                }
            });
        }
    });
}