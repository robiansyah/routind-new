/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var daftarAsetHandler = function () {
    var editHarta = null;
    var barisHarta;
    var setTabelHarta = function () {
        $("#txtJBB").val('');
        var hTable = $('#tblHarta').DataTable({
            "destroy": true,
            "pageLength": 5,
            "pagingType": "simple_numbers",
            "language": {
                "zeroRecords": "Tidak ditemukan data yang sesuai",
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data ",
                "infoEmpty": "Menampilkan 0 sampai 0 dari 0 data ",
                "paginate": {
                    "previous": "<<",
                    "next": ">>"
                }
            },
            "order": [[0, 'asc']],
            "columnDefs": [
                {
                    'sortable': false,
                    'targets': [0, 1, 2, 3, 4, 5]
                }
            ],
            "rowCallback": function (row, data, index) {
                if ($("#ThnPajak").val() === "2013") {
                    $("td:eq(0)", row).css("text-align", "left");
                    $("td:eq(1)", row).css("text-align", "center");
                    var nilai = "<input type='text' readonly class='form-control form-control-sm form-control-solid text-end' value=" + data[3] + "></input>";
                    $("td:eq(2)", row).html(nilai);
                    $("td:eq(2)", row).css("text-align", "right");
                    $("td:eq(3)", row).css("text-align", "left");
                } else {
                    $("td:eq(0)", row).css("text-align", "center");
                    $("td:eq(1)", row).css("text-align", "left");
                    $("td:eq(2)", row).css("text-align", "center");
                    var nilai = "<input type='text' readonly class='form-control form-control-sm form-control-solid text-end' value=" + data[3] + "></input>";
                    $("td:eq(3)", row).html(nilai);
                    $("td:eq(3)", row).css("text-align", "right");
                    $("td:eq(4)", row).css("text-align", "left");
                }
            },
            "drawCallback": function () {
                //$(".hp").number(true, 0, ",", ".");
                $('.hp').autoNumeric('init', {aDec: ',', aSep: '.', mDec: '0'});
            },
            "footerCallback": function (row, data, start, end, display) {
                var total = Number(0);
                for (var i = 0; i < data.length; i++) {
                    total += Number(data[i][3]) * 1;
                }

                var subTotal = Number(0);
                for (var i = start; i < end; i++) {
                    subTotal += Number(data[i][3]) * 1;
                }
                number.setVal('#txtSubJBB', subTotal);
                number.setVal('#txtJBB', total);
            }
        });
        $('#tblHarta_wrapper .dataTables_filter').hide(); // modify table search input
        $('#tblHarta_wrapper .dataTables_length').hide(); // modify table per page dropdown

        $('#harta_new').on("click", function () {
            $('#divHarta').show();
            $('#divHarta').modal('show');
            $("#DhKdHarta").val('').trigger("change");
            $("#DhKdHarta").removeAttr("disabled");
            common.resetForm("#divHarta");
            editHarta = false;
        });
        $('#btnAddHarta').on("click", function (e) {
            e.preventDefault();
            if ($("#DhKdHarta").val().length === 500) {
                common.showMessage("INFO", "Pastikan inputan karakter Anda benar.");
            }
            if ($("#DhJnsHarta").val().trim() !== "" && $("#DhThPerolehan").val().trim() !== "" &&
                    $("#DhHarga").val().trim() !== "" && $("#DhKeterangan").val().trim() !== "") {
                if ($("#DhHarga").val() !== '0') {
                    if (editHarta === false || editHarta === null) {
                        hTable.row.add([
                            $("#DhKdHarta").val(),
                            $("#DhJnsHarta").val(),
                            $("#DhThPerolehan").val(),
                            number.getVal("#DhHarga"),
                            $("#DhKeterangan").val(),
                            '<a class="edit" href="#">Ubah</a> | <a class="delete" href="#">Hapus</a>'
                        ]).draw();
                    } else {
                        var tableHarta = $('#tblHarta').dataTable();
                        tableHarta.fnUpdate($("#DhKdHarta").val(), barisHarta, 0, false);
                        tableHarta.fnUpdate($("#DhJnsHarta").val(), barisHarta, 1, false);
                        tableHarta.fnUpdate($("#DhThPerolehan").val(), barisHarta, 2, false);
                        tableHarta.fnUpdate(number.getVal("#DhHarga"), barisHarta, 3, false);
                        tableHarta.fnUpdate($("#DhKeterangan").val(), barisHarta, 4, false);
                        tableHarta.fnUpdate('<a class="edit" href="">Ubah</a> | <a class="delete" href="">Hapus</a>', barisHarta, 5, false);
                        tableHarta.fnDraw();
                        common.resetForm("#divHarta");
                        editHarta = null;
                    }
                    $("#mharta").val("Sudah Ada");
                } else {
                    common.showMessage("INFO", "Nilai harta tidak boleh 0 Rupiah");
                }
            } else {
                common.showMessage("INFO", "Data tidak lengkap");
            }
            $('#divHarta').hide();
            $('#divHarta').modal('hide');
        });

        $('#tblHarta').on('click', 'a.edit', function (e) {
            e.preventDefault();
            barisHarta = $(this).parents('tr')[0];
            if (editHarta === null || editHarta === false) {
                editHarta = true;
            }
            var hTable = $("#tblHarta").dataTable();
            var oTr = $(this).closest("tr")[0];
            var rData = hTable.fnGetData(oTr);
            $("#DhKdHarta").val(rData[0]).trigger('change');
            $("#DhJnsHarta").val(rData[1]);
            $("#DhThPerolehan").val(rData[2]).trigger('change');
            number.setVal("#DhHarga", rData[3]);
            $("#DhKeterangan").val(rData[4]);
            $('#divHarta').modal('show');
            $('#divHarta').show();
        });
        $('#tblHarta').on('click', 'a.delete', function (e) {
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
                    $("#tblHarta").dataTable().fnDeleteRow(nRow);
                }
            });
        });
    };
    var setupColumn = function (tahun, preview) {
        $("#divKodeHarta").hide();
        if (tahun === "2013") {
            $('#tblHarta').DataTable().column(0).visible(false);
        } else {
            $('#tblHarta').DataTable().column(0).visible(true);
            $("#divKodeHarta").show();
        }
        if (preview) {
            $('#tblHarta').DataTable().column(5).visible(false);
        } else {
            $('#tblHarta').DataTable().column(5).visible(true);
        }
    };
    var setDataHarta = function (arrayHarta) {
        var tblHarta = $('#tblHarta').DataTable();
        tblHarta.clear();
        $.each(arrayHarta, function (i, value) {
            tblHarta.row.add([
                arrayHarta[i].kodeHarta,
                arrayHarta[i].jnsHarta,
                arrayHarta[i].thPerolehan,
                arrayHarta[i].harga,
                arrayHarta[i].ket,
                '<a class="edit" href="#">Ubah</a> | <a class="delete" href="#">Hapus</a>'
            ]).draw();
        });
        $("#mharta").val("Sudah Ada");
    };
    var resetTHarta = function () {
        var tblHarta = $('#tblHarta').DataTable();
        tblHarta.clear().draw();
    };
    function cekCompletionAsset(th) {
        var dataHarta = $('#tblHarta').DataTable().data();
        var test;
        if (dataHarta.length > 0) {
            for (i = 0; i < dataHarta.length; i++) {
                if (th !== '2013') {
                    if (dataHarta[i][0] === '-' || dataHarta[i][0] === "") {
                        test = 0;
                        break;
                    }
                }
                if (dataHarta[i][1] === '-' || dataHarta[i][1] === "" ||
                        dataHarta[i][2] === '-' || dataHarta[i][2] === "" ||
                        dataHarta[i][3] === '-' || dataHarta[i][3] === "" ||
                        dataHarta[i][4] === "") {
                    test = 0;
                    break;
                } else {
                    test = 1;
                }
            }
        } else {
            test = 0;
        }
        if (test === 1) {
            return true;
        } else {
            return false;
        }
    }

    var setTahunPerolehan = function (ctl) {
        var tahun = new Date().getFullYear();
        var ctrl = $(ctl);
        ctrl.empty();
        ctrl.append("<option value=''></option>");
        for (var i = tahun; i >= 2000; i--) {
            ctrl.append("<option value='" + i + "'>" + i + "</option>");
        }
        ctrl.addClass("select2me");

    };
    return {
        init: function () {
            setTabelHarta();
        }, setup: function (tahun, preview) {
            setupColumn(tahun, preview);
        }, setharta: function (arrayHarta) {
            setDataHarta(arrayHarta);
        }, resetTabelHarta: function () {
            resetTHarta();
        }, cekAssetCompletion: function (th) {
            return cekCompletionAsset(th);
        }, setTahunPerolehan: function (ctl) {
            setTahunPerolehan(ctl);
        }
    };
}();
