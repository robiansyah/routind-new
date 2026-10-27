"use strict";
var billing = function () {
    var setupTableBayar = function (preview) {
        var barisJnsPembayaran = 0;
        var editJnsPembayaran = null;
        var oTable = $('#tblJnsPembayaran').DataTable({
            "destroy": true,
            "pageLength": -1,
            "pagingType": "simple_numbers",
            "language": {
                "zeroRecords": "Tidak ditemukan data yang sesuai",
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data ",
                "infoEmpty": "Menampilkan 0 sampai 0 dari 0 data ",
                "paginate": {
                    "previous": "<<",
                    "next": ">>"}
            },
            "order": [[0, 'asc']],
            "columnDefs": [{
                    'sortable': false,
                    'targets': [0, 1, 2, 3, 4]
                }
            ],
            "rowCallback": function (row, data, index) {
                var jml = "<input type='text' readonly style='text-align:right;font-weight:bold' class='form-control form-control-sm text-number jmlNtpnPbk' value=" + data[3] + "></input>";
                $("td:eq(0)", row).css("text-align", "center");
                $("td:eq(1)", row).css("text-align", "center");
                $("td:eq(2)", row).css("text-align", "center");
                $("td:eq(3)", row).html(jml);
                if (preview) {
                    $("td:eq(4)", row).html("-");
                } else {
                    $("td:eq(4)", row).css("text-align", "center");
                }
            },
            "drawCallback": function () {
                $('.jmlNtpnPbk').autoNumeric('init', {aDec: ',', aSep: '.', mDec: '0'});
            },
            "footerCallback": function (row, data, start, end, display) {
                var total = Number(0);
                for (var i = 0; i < data.length; i++) {
                    total += Number(data[i][3]) * 1;
                }
                number.setVal('#txtJmlNtpnPbk', total);
            }
        });
        $('#tblJnsPembayaran_filter').hide();
        $('#tblJnsPembayaran_length').hide();
        if (preview) {
            $('#tblJnsPembayaran').DataTable().column(4).visible(false);
        } else {
            $('#tblJnsPembayaran').DataTable().column(4).visible(true);
            $('#tblJnsPembayaran_wrapper .dataTables_info').hide();
            $('#tblJnsPembayaran_wrapper .dataTables_paginate').hide();
            $('#tblJnsPembayaran_wrapper .dataTables_wrapper').hide();
            $('#tblJnsPembayaran_wrapper .table-scrollable').hide();
        }

        $('#buktiBayar_new').click(function () {
            $("#rbByr1").prop('checked', false);
            $("#rbByr2").prop('checked', false);
            common.resetForm('#divJnsPembayaran');

            $('#divJnsPembayaran').modal('show');
            $('#divJnsPembayaran').modal({show: true});
            editJnsPembayaran = false;
        });

        $('#btnAddBuktiBayar').on("click", function (e) {
            e.preventDefault();
            if ($("#pbyrnNomor").val() !== "" && $("#pbyrnTglBuktiByr").val() !== "" && $("#pbyrnJml").val() !== "") {
                var jnsPbyrn = $("input:radio[name='rbPbyrn']:checked").val();
                var isExist = cekBayar($("#pbyrnNomor").val().toUpperCase());
                if (!isExist) {
                    if (editJnsPembayaran) {
                        var tableJnsPembayaran = $('#tblJnsPembayaran').dataTable();
                        tableJnsPembayaran.fnUpdate(jnsPbyrn === '1' ? "NTPN" : "Pemindahbukuan", barisJnsPembayaran, 0, false);
                        tableJnsPembayaran.fnUpdate($("#pbyrnNomor").val().toUpperCase(), barisJnsPembayaran, 1, false);
                        tableJnsPembayaran.fnUpdate($("#pbyrnTglBuktiByr").val(), barisJnsPembayaran, 2, false);
                        tableJnsPembayaran.fnUpdate(number.getVal("#pbyrnJml"), barisJnsPembayaran, 3, false);
                        tableJnsPembayaran.fnUpdate('<a class="edit" href="">Ubah</a> | <a class="delete" href="">Hapus</a>', barisJnsPembayaran, 4, false);
                        tableJnsPembayaran.fnDraw();
                        editJnsPembayaran = false;
                    } else {
                        $("#tblJnsPembayaran").DataTable().row.add([
                            jnsPbyrn === '1' ? "NTPN" : "Pemindahbukuan",
                            $("#pbyrnNomor").val().toUpperCase(),
                            $("#pbyrnTglBuktiByr").val(),
                            number.getVal("#pbyrnJml"),
                            '<a class="edit" href="#">Ubah</a> | <a class="delete" href="#">Hapus</a>'
                        ]).draw();
                    }
                } else {
                    common.showMessage("INFO", "Data sudah direkam", "info");
                }
                $('#divJnsPembayaran').hide();
                $('#divJnsPembayaran').modal('hide');
            } else {
                common.showMessage("INFO", "Data Pembayaran tidak Lengkap", "info");
            }
        });


        $('#tblJnsPembayaran').on('click', 'a.edit', function (e) {
            e.preventDefault();
            editJnsPembayaran = true;
            var oTr = $(this).closest("tr")[0];
            var rData = $("#tblJnsPembayaran").dataTable().fnGetData(oTr);
            if (rData[0] === 'NTPN') {
                $("#rbByr1").prop('checked', true);
                $("#rbByr2").removeAttr("checked");
            } else if (rData[0] === 'Pemindahbukuan') {
                $("#rbByr1").removeAttr("checked");
                $("#rbByr2").prop('checked', true);
            }
            $("#pbyrnNomor").val(rData[1]);
            $("#pbyrnTglBuktiByr").val(rData[2]);
            number.setVal("#pbyrnJml", rData[3]);

            $('#divJnsPembayaran').modal('show');
            $('#divJnsPembayaran').show();
        });


        $('#tblJnsPembayaran').on('click', 'a.delete', function (e) {
            e.preventDefault();
            var nRow = $(this).parents('tr')[0];
            swal.fire({
                title: 'Apakah Anda yakin ingin menghapus data ini?',
                type: 'question',
                confirmButtonText: "<i class='la la-thumbs-up'></i> Ya",
                buttonsStyling: false,
                confirmButtonClass: "btn btn-djp",
                showCancelButton: true,
                cancelButtonText: "<i class='la la-ban'></i> Tidak",
                cancelButtonClass: "btn btn-secondary",
                reverseButtons: true
            }).then(function (result) {
                if (result.value) {
                    $("#tblJnsPembayaran").dataTable().fnDeleteRow(nRow);
                }
            });
        });
    };

    var resetTBayar = function () {
        $('#tblJnsPembayaran').DataTable().clear().draw();
    };

    var cekBayar = function (inBayar) {
        var data = $('#tblJnsPembayaran').dataTable().fnGetData();
        if (data.length > 0) {
            for (var i = 0, max = data.length; i < max; i++) {
                if (inBayar === data[i][1]) {
                    return true;
                }
            }
        } else {
            return false;
        }
    };

    var createBillingCode = function (p, f) {
        common.loadingMessage("Memproses", "Mohon sabar menunggu");
        $("#barisKodeBilling").hide();
        $.ajax({
            url: "/billing/code",
            type: 'POST',
            // dataType: 'json',
            data: p,
            // contentType: 'application/json',
            // mimeType: 'application/json',
            success: function (data) {
                switch (data.kdStatus) {
                    case "1":
                        $("#barisKodeBilling").show();
                        $("#barisKodeBillingExpDate").show();
                        $("#barisKeteranganBilling").show();
                        $("#barisCreateBilling").hide();
                        $("#txtKodeBilling").val(data.ketStatus);
                        $("#txtKodeBillingExpDate").val(data.message);
                        break;
                    default:
                        common.showMessage("ERROR", data.message, "error");
                        break;
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

    function checkPaymentCompletion(jnsSpt) {
        if ($("#rb2").is(":checked")) {
            var jmlNtpnPbk = parseInt(number.getVal("#txtJmlNtpnPbk"));
            var nilaiKB = 0;
            if (jnsSpt === '1770SS') {
                nilaiKB = parseInt(number.getVal("#txtBagA7"));
            } else if (jnsSpt === '1770S') {
                nilaiKB = parseInt(number.getVal("#Idk16"));
            }
            if (jmlNtpnPbk > nilaiKB) {
                return 1;
            } else if (jmlNtpnPbk === nilaiKB) {
                return 0;
            } else {
                return -1;
            }
        } else {
            return -1;
        }
    }

    var setupColumn = function (preview) {
        if (preview) {
            $('#tblJnsPembayaran').DataTable().column(4).visible(true);
        } else {
            $('#tblJnsPembayaran').DataTable().column(4).visible(false);
        }
    };

    var setDataPayment = function (arrayPayment) {
        var tblPbyrn = $('#tblJnsPembayaran').DataTable();
        $('#tblJnsPembayaran_filter').hide();
        $('#tblJnsPembayaran_length').hide();

        tblPbyrn.clear();
        $.each(arrayPayment, function (i, value) {
            var tglBayar = arrayPayment[i].tglBayar.split("-").reverse().join("-");
            tblPbyrn.row.add([
                arrayPayment[i].jnstrx === 1 ? 'NTPN' : 'Pemindahbukuan',
                arrayPayment[i].ntpnPbk,
                tglBayar,
                arrayPayment[i].nilai,
                '<a class="edit" href="#">Ubah</a> | <a class="delete" href="#">Hapus</a>'
            ]).draw();
        });
    };

    function getDaftarNoPembayaran() {
        var lsNoPembayaran = [];
        if ($("#rb2").is(":checked")) {
            var oTable = $('#tblJnsPembayaran').DataTable();
            var data = oTable.data();
            for (var i = 0; i < data.length; i++) {
                var date = new Date(data[i][2].split("-").reverse().join("-"));
                lsNoPembayaran.push({
                    jnstrx: data[i][0] === 'NTPN' ? 1 : 2,
                    ntpnPbk: data[i][1],
                    tglBayar: data[i][2],
                    nilai: data[i][3]
                });
            }
        }
        return lsNoPembayaran;
    }


    return {
        init: function (preview) {
            setupTableBayar(preview);
        },
        resetTabelBayar: function () {
            resetTBayar();
        },
        cekBayar: function (inBayar) {
            cekBayar(inBayar);
        },
        createBillingCode: function (p, f) {
            createBillingCode(p, f);
        },
        checkPaymentCompletion: function (jnsSpt) {
            return checkPaymentCompletion(jnsSpt);
        },
        setup: function (preview) {
            setupColumn(preview);
        },
        loadDataSpt: function (data) {
            setDataPayment(data);
        },
        getDaftarNoPembayaran: function () {
            return getDaftarNoPembayaran();
        }
    };
}();