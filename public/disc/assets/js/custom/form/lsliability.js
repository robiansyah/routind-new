/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var daftarUtangHandler = function () {

    var setupTableUtang = function () {
        var nEditHutang = null;
        var barisUtang;

        number.setVal('#txtSubJBC', 0);
        number.setVal('#txtJBC', 0);

        var uTable = $('#tblHutang').DataTable({
            'destroy': true,
            "pageLength": 5,
            "pagingType": "simple_numbers",
            "language": {
                "zeroRecords": "Tidak ditemukan data yang sesuai",
                "lengthMenu": "_MENU_ records",
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data ",
                "infoEmpty": "Menampilkan 0 sampai 0 dari 0 data ",
                "paginate": {
                    "previous": "<<",
                    "next": ">>"
                }
            },
            "order": [[0, 'asc']],
            "columnDefs": [{
                    'sortable': false,
                    'targets': [0, 1, 2, 3, 4, 5]
                }
            ],
            "rowCallback": function (row, data, index) {
                if ($("#thnPajak").val() === "2013") {
                    $("td:eq(0)", row).css("text-align", "left");
                    $("td:eq(1)", row).css("text-align", "left");
                    $("td:eq(2)", row).css("text-align", "center");
                    var nilai = "<input type='text' style='text-align:right' readonly class='form-control  ut' value=" + data[4] + "></input>";
                    $("td:eq(3)", row).html(nilai);
                } else {
                    $("td:eq(0)", row).css("text-align", "center");
                    $("td:eq(1)", row).css("text-align", "left");
                    $("td:eq(2)", row).css("text-align", "left");
                    $("td:eq(3)", row).css("text-align", "center");
                    var nilai = "<input type='text' style='text-align:right' readonly class='form-control  ut' value=" + data[4] + "></input>";
                    $("td:eq(4)", row).html(nilai);
                }
            },
            "drawCallback": function (row, data, start, end, display) {
                $('.ut').autoNumeric('init', {aDec: ',', aSep: '.', mDec: '0'});
            },
            "footerCallback": function (row, data, start, end, display) {
                var total = Number(0);
                if (data !== null) {
                    for (var i = 0; i < data.length; i++) {
                        total += Number(data[i][4]) * 1;
                    }
                }

                var subTotal = Number(0);
                for (var i = start; i < end; i++) {
                    subTotal += Number(data[i][4]) * 1;
                }

                number.setVal('#txtSubJBC', subTotal);
                number.setVal('#txtJBC', total);
            }
        });
        $('#tblHutang_filter').hide(); // modify table search input
        $('#tblHutang_length').hide(); // modify table per page dropdown

        $('#utang_new').on("click", function () {
            $('#divHutang').modal('show');
            $('#divHutang').modal({show: true});
            common.resetForm('#divHutang');
            nEditHutang = null;
        });

        $('#btnTambahUtang').on("click", function (e) {
            e.preventDefault();
            if ($("#DuPemberi").val().trim() !== "" && $("#DuAlmtPemberi").val().trim() !== "" &&
                    $("#DuThPinjam").val().trim() !== "" && $("#DuJmlPinjaman").val().trim() !== "") {
                    if ($("#DuJmlPinjaman").val() !== '0') {
                if (nEditHutang === false || nEditHutang === null) {
                    uTable.row.add([$("#DhKdHtg").val(),
                        $("#DuPemberi").val(),
                        $("#DuAlmtPemberi").val(),
                        $("#DuThPinjam").val(),
                        number.getVal("#DuJmlPinjaman"),
                        '<a class="edit" href="#">Ubah</a> | <a class="delete" href="#">Hapus</a>']);
                    uTable.draw();
                } else {
                    var tbl = $("#tblHutang").dataTable();
                    tbl.fnUpdate($("#DhKdHtg").val(), barisUtang, 0, false);
                    tbl.fnUpdate($("#DuPemberi").val(), barisUtang, 1, false);
                    tbl.fnUpdate($("#DuAlmtPemberi").val(), barisUtang, 2, false);
                    tbl.fnUpdate($("#DuThPinjam").val(), barisUtang, 3, false);
                    tbl.fnUpdate(number.getVal("#DuJmlPinjaman"), barisUtang, 4, false);
                    tbl.fnUpdate('<a class="edit" href="">Ubah</a> | <a class="delete" href="">Hapus</a>', barisUtang, 5, false);
                    tbl.fnDraw();
                    nEditHutang = null;
                }
                 } else {
                    common.showMessage("INFO", "Jumlah Pinjaman tidak boleh 0 Rupiah");
                }
            } else {
                common.showMessage("INFO", "Data tidak lengkap");
            }
            common.resetForm('#divHutang');
            $('#divHutang').modal('hide');
        });

        $('#tblHutang').on('click', 'a.edit', function (e) {
            e.preventDefault();
            barisUtang = $(this).parents('tr')[0];
            if (nEditHutang === null || nEditHutang === false) {
                nEditHutang = true;
            }
            var oTr = $(this).closest("tr")[0];
            var rData = $('#tblHutang').dataTable().fnGetData(oTr);
            $("#DhKdHtg").val(rData[0]);
            $("#DuPemberi").val(rData[1]);
            $("#DuAlmtPemberi").val(rData[2]);
            $("#DuThPinjam").val(rData[3]);
            number.setVal("#DuJmlPinjaman", rData[4]);
            $('#divHutang').modal('show');
            $('#divHutang').modal({show: true});
        });

        $('#tblHutang').on('click', 'a.delete', function (e) {
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
                    $("#tblHutang").dataTable().fnDeleteRow(nRow);
                }
            });
        });
    };

    var setupColumn = function (tahun, preview) {
        $("#divKodeHtg").hide();
        if (tahun === "2013") {
            $('#tblHutang').DataTable().column(0).visible(false);
        } else {
            $('#tblHutang').DataTable().column(0).visible(true);
            $("#divKodeHtg").show();
        }

        if (preview) {
            $('#tblHutang').DataTable().column(5).visible(false);
        } else {
            $('#tblHutang').DataTable().column(5).visible(true);
        }
    };

    var setDataUtang = function (arrayHutang) {
        var tblHutang = $('#tblHutang').DataTable();
        tblHutang.clear();
        $.each(arrayHutang, function (i, value) {
            tblHutang.row.add([
                arrayHutang[i].kodeUtang,
                arrayHutang[i].nmPbrPinjam,
                arrayHutang[i].almtPbrPinjam,
                arrayHutang[i].thPinjam,
                arrayHutang[i].jmlPinjam,
                '<a class="edit" href="#">Ubah</a> | <a class="delete" href="#">Hapus</a>'
            ]).draw();
        });
    };

    var resetTHutang = function () {
        var tblHutang = $('#tblHutang').DataTable();
        tblHutang.clear().draw();
    };

    function cekCompletionUtang(th) {
        var dataHutang = $('#tblHutang').DataTable().data();
        var test;
        if (dataHutang.length > 0) {
            for (i = 0; i < dataHutang.length; i++) {
                if (th !== '2013') {
                    if (dataHutang[i][0] === '-' || dataHutang[i][0] === "") {
                        test = 0;
                        break;
                    }
                }
                if (dataHutang[i][1] === '-' || dataHutang[i][1] === "" ||
                        dataHutang[i][2] === '-' || dataHutang[i][2] === "" ||
                        dataHutang[i][3] === '-' || dataHutang[i][3] === "" ||
                        dataHutang[i][4] === '-' || dataHutang[i][4] === "") {
                    test = 0;
                    break;
                } else {
                    test = 1;
                }
            }
        } else {
            test = 1;
        }
        if (test === 1) {
            return true;
        } else {
            return false;
        }
    }

    var setTahunPeminjaman = function (control) {
        var tahun = new Date().getFullYear();
        var ctrl = $(control);
        ctrl.empty();
        ctrl.append("<option value=''></option>");
        for (var i = tahun; i >= 2000; i--) {
            ctrl.append("<option value='" + i + "'>" + i + "</option>");
        }
        ctrl.addClass("select2me");
    };

    return {
        init: function () {
            setupTableUtang();
        }, setup: function (tahun, preview) {
            setupColumn(tahun, preview);
        }, setUtang: function (arrayUtang) {
            setDataUtang(arrayUtang);
        }, resetTabelHutang: function () {
            resetTHutang();
        }, cekUtangCompletion: function (th) {
            return cekCompletionUtang(th);
        }, setTahunPinjam: function (ctl) {
            setTahunPeminjaman(ctl);
        }
    };
}();

