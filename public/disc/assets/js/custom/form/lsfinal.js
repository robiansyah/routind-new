var daftarFinalHandler = function () {

    var barisFinal;
    var editFinal = null;

    var initTable = function (preview) {
        var tblFinal = $("#tblPphFinal").DataTable({
            //"data": source,
            "responsive": false,
            "destroy": true,
            "searching": false,
            "paging": false,
            "lengthChange": false,
            "language": {
                "zeroRecords": "Tidak ditemukan data yang sesuai"
            },
            "order": [[0, 'asc']],
            "columnDefs": [
                {
                    'sortable': false,
                    'targets': [0, 1, 2, 3, 4]
                }
            ],
            "rowCallback": function (row, data, index) {
                var dpp, pph;
                if (data[0] === "11") {
                    dpp = "<input type='text' readonly style='text-align:right' class='form-control text-number dpp' value=''></input>";
                    pph = "<input type='text' readonly style='text-align:right' class='form-control text-number final' value=''></input>";
                } else {
                    dpp = "<input type='text' readonly style='text-align:right;font-weight:bold' class='form-control text-number dpp' value=" + data[2] + "></input>";
                    pph = "<input type='text' readonly style='text-align:right;font-weight:bold' class='form-control text-number final' value=" + data[3] + "></input>";
                }
                $("td:eq(0)", row).css("text-align", "center");
                $("td:eq(1)", row).css("text-align", "left");
                $("td:eq(2)", row).html(dpp);
                $("td:eq(3)", row).html(pph);
                if (preview) {
                    $("td:eq(4)", row).html("-");
                }
            },
            "drawCallback": function () {
                $('.dpp').autoNumeric('init', {aDec: ',', aSep: '.', mDec: '0'});
                $('.final').autoNumeric('init', {aDec: ',', aSep: '.', mDec: '0'});
            },
            "footerCallback": function (row, data, start, end, display) {
                var total = Number(0);
                for (var i = 0; i < data.length; i++) {
                    total += Number(data[i][3]) * 1;
                }
                number.setVal('#txtJBA', total);
            }
        });
        $('#tblPphFinal_wrapper .dataTables_info').hide();
        $('#tblPphFinal_wrapper .dataTables_paginate').hide();

        if (preview) {
            $('#tblPphFinal').DataTable().column(4).visible(false);
        } else {
            $('#tblPphFinal').DataTable().column(4).visible(true);
        }
    };

    var cekDataFinal = function (inFinal, prep) {
        var tblFnl = $('#tblPphFinal').dataTable().api();
        var data = tblFnl.data();
        if (data.length > 0) {
            for (var i = 0, max = data.length; i < max; i++) {
                if (inFinal === data[i][0]) {
                    if (prep) {
                        barisFinal = i;
                    }
                    return true;
                }
            }
        } else {
            return false;
        }
    };

    var handleBtnAdd = function () {
        $('#final_new').on("click", function () {
            $('#divFinal').show();
            $('#divFinal').modal('show');
            common.resetForm("#divFinal");

            $("#ddlKewajibanFinal").val('1').trigger('change');
            $("#ddlKewajibanFinal").removeAttr("disabled");
            editFinal = false;
        });

        $('#btnAddFinal').on("click", function (e) {
            e.preventDefault();
            if ($("#txtDppFinal").val().trim() !== "" && $("#txtPphFinal").val().trim() !== "") {
                if (editFinal === false || editFinal === null) {
                    var isExist = cekDataFinal($("#ddlKewajibanFinal").val(), false);
                    if (!isExist) {
                        insertDataFinal(number.getVal("#txtDppFinal"), number.getVal("#txtPphFinal"));
                    } else {
                        common.showMessage("INFO", "Data sudah direkam", "info");
                    }
                } else {
                    editDataFinal(barisFinal, number.getVal("#txtDppFinal"), number.getVal("#txtPphFinal"));
                    common.resetForm("#divFinal");
                    editFinal = null;
                }
            } else {
                common.showMessage("INFO", "Data tidak lengkap", "info");
            }
            $('#divFinal').hide();
            $('#divFinal').modal('hide');
        });
    };

    var handleBtnEdit = function () {
        $('#tblPphFinal').on('click', 'a.edit', function (e) {
            e.preventDefault();
            barisFinal = $(this).parents('tr')[0];
            if (editFinal === null || editFinal === false) {
                editFinal = true;
            }
            var hTable = $("#tblPphFinal").dataTable();
            var oTr = $(this).closest("tr")[0];
            var rData = hTable.fnGetData(oTr);
            $("#ddlKewajibanFinal").val(rData[0]).trigger("change").attr("disabled", "disabled");
            number.setVal("#txtDppFinal", rData[2]);
            number.setVal("#txtPphFinal", rData[3]);

            $('#divFinal').modal('show');
            $('#divFinal').show();
        });
    };

    var handleBtnDelete = function () {
        $('#tblPphFinal').on('click', 'a.delete', function (e) {
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
                    $("#tblPphFinal").dataTable().fnDeleteRow(nRow);
                }
            });
        });
    };

    var resetTFinal = function () {
        var tblFinal = $('#tblPphFinal').DataTable();
        tblFinal.clear().draw();
    };

    var setDataFinal = function (objFinal) {
        $.each(objFinal, function (key, value) {
            if (key === "phBungaDep" && value !== null) {
                $("#ddlKewajibanFinal").val("1");
                $.each(objFinal, function (k, v) {
                    if (k === "pjkBungaDep" & v !== null) {
                        insertDataFinal(value, v);
                    }
                });
            } else if (key === "phBungaObl" && value !== null) {
                $("#ddlKewajibanFinal").val("2");
                $.each(objFinal, function (k, v) {
                    if (k === "pjkBungaObl" & v !== null) {
                        insertDataFinal(value, v);
                    }
                });
            } else if (key === "phJualSaham" && value !== null) {
                $("#ddlKewajibanFinal").val("3");
                $.each(objFinal, function (k, v) {
                    if (k === "pjkJualSaham" & v !== null) {
                        insertDataFinal(value, v);
                    }
                });
            } else if (key === "phHadiah" && value !== null) {
                $("#ddlKewajibanFinal").val("4");
                $.each(objFinal, function (k, v) {
                    if (k === "pjkHadiah" & v !== null) {
                        insertDataFinal(value, v);
                    }
                });
            } else if (key === "phPesangon" && value !== null) {
                $("#ddlKewajibanFinal").val("5");
                $.each(objFinal, function (k, v) {
                    if (k === "pjkPesangon" & v !== null) {
                        insertDataFinal(value, v);
                    }
                });
            } else if (key === "phHonor" && value !== null) {
                $("#ddlKewajibanFinal").val("6");
                $.each(objFinal, function (k, v) {
                    if (k === "pjkHonor" & v !== null) {
                        insertDataFinal(value, v);
                    }
                });
            } else if (key === "phAlihTB" && value !== null) {
                $("#ddlKewajibanFinal").val("7");
                $.each(objFinal, function (k, v) {
                    if (k === "pjkAlihTB" & v !== null) {
                        insertDataFinal(value, v);
                    }
                });
            } else if (key === "phSewaTB" && value !== null) {
                $("#ddlKewajibanFinal").val("8");
                $.each(objFinal, function (k, v) {
                    if (k === "pjkSewaTB" & v !== null) {
                        insertDataFinal(value, v);
                    }
                });
            } else if (key === "phBgnGunaSerah" && value !== null) {
                $("#ddlKewajibanFinal").val("9");
                $.each(objFinal, function (k, v) {
                    if (k === "pjkBgnGunaSerah" & v !== null) {
                        insertDataFinal(value, v);
                    }
                });
            } else if (key === "phBungaSimp" && value !== null) {
                $("#ddlKewajibanFinal").val("10");
                $.each(objFinal, function (k, v) {
                    if (k === "pjkBungaSimp" & v !== null) {
                        insertDataFinal(value, v);
                    }
                });
            } else if (key === "phTrDerivatif" && value !== null) {
                $("#ddlKewajibanFinal").val("11");
                $.each(objFinal, function (k, v) {
                    if (k === "pjkTrDerivatif" & v !== null) {
                        insertDataFinal(value, v);
                    }
                });
            } else if (key === "phDividen" && value !== null) {
                $("#ddlKewajibanFinal").val("12");
                $.each(objFinal, function (k, v) {
                    if (k === "pjkDividen" & v !== null) {
                        insertDataFinal(value, v);
                    }
                });
            } else if (key === "phIstri" && value !== null) {
                $("#ddlKewajibanFinal").val("13");
                $.each(objFinal, function (k, v) {
                    if (k === "pjkPhIstri" & v !== null) {
                        insertDataFinal(value, v);
                    }
                });
            } else if (key === "phLain" && value !== null) {
                $("#ddlKewajibanFinal").val("14");
                $.each(objFinal, function (k, v) {
                    if (k === "pjkPhLain" & v !== null) {
                        insertDataFinal(value, v);
                    }
                });
            }
        });
    };

    var setDataPrepFinal = function (lsPrepFinal) {
        var pphBruto = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        var pphTerutang = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $.each(lsPrepFinal, function (i, value) {
            var id = 0;
            switch (lsPrepFinal[i].kdObjekPajak) {
                case "IIA1" :
                    setFinal(1, lsPrepFinal[i]);
                    break;
                case "IIA2" :
                    setFinal(2, lsPrepFinal[i]);
                    break;
                case "IIA3" :
                    setFinal(3, lsPrepFinal[i]);
                    break;
                case "IIA4" :
                    setFinal(4, lsPrepFinal[i]);
                    break;
                case "IIA5" :
                    setFinal(5, lsPrepFinal[i]);
                    break;
                case "IIA6" :
                    setFinal(6, lsPrepFinal[i]);
                    break;
                case "IIA7" :
                    setFinal(7, lsPrepFinal[i]);
                    break;
                case "IIA8" :
                    setFinal(8, lsPrepFinal[i]);
                    break;
                case "IIA10" :
                    setFinal(10, lsPrepFinal[i]);
                    break;
                case "IIA12" :
                    setFinal(12, lsPrepFinal[i]);
                    break;
                case "IIA14" :
                    setFinal(14, lsPrepFinal[i]);
                    break;

                case "IA1" :
                    number.setVal("#BagA01", lsPrepFinal[i].jmlPenghasilanBruto);
                    break;
                case "IA2" :
                    number.setVal("#BagA02", lsPrepFinal[i].jmlPenghasilanBruto);
                    break;
                case "IA3" :
                    number.setVal("#BagA03", lsPrepFinal[i].jmlPenghasilanBruto);
                    break;
                case "IA6" :
                    number.setVal("#BagA06", lsPrepFinal[i].jmlPenghasilanBruto);
                    break;

                case "IdA1" :
                    var jmlA1 = Number(number.getVal("#Idk1")) + lsPrepFinal[i].jmlPenghasilanBruto;
                    number.setVal("#Idk1", jmlA1);
                    break;
                case "IdD14a" :
                    number.setVal("#Idk14a", lsPrepFinal[i].jmlPphTerutang);
                    break;
            }
        });

        function setFinal(id, lsPrepFinal) {
            $("#ddlKewajibanFinal").val(id);
            pphBruto[id - 1] += lsPrepFinal.jmlPenghasilanBruto;
            pphTerutang[id - 1] += lsPrepFinal.jmlPphTerutang;
            if (pphTerutang[id - 1] <= pphBruto[id - 1]) {
                var isExist = cekDataFinal($("#ddlKewajibanFinal").val(), true);
                if (!isExist) {
                    insertDataFinal(lsPrepFinal.jmlPenghasilanBruto, lsPrepFinal.jmlPphTerutang);
                } else {
                    editDataFinal(barisFinal, pphBruto[id - 1], pphTerutang[id - 1]);
                }
            } else {
                common.showMessage("ERROR", "Data tidak valid", "error");
            }
        }
    };

    var insertDataFinal = function (dpp, pjk) {
        var dppNum = Number(dpp);
        var pjkNum = Number(pjk);
        if (dppNum >= pjkNum) {
            var a = $("select[name='ddlKewajibanFinal'] option:selected").text().split('.');
            $("#tblPphFinal").dataTable().api().row.add([
                $("#ddlKewajibanFinal").val(),
                a[1],
                dpp,
                pjk,
                '<a class="edit" href="#">Ubah</a> | <a class="delete" href="#">Hapus</a>'
            ]).draw();
        } else {
            common.showMessage("INFO", "Data tidak valid", "info");
        }
    };

    var editDataFinal = function (row, dpp, pjk) {
        var dppNum = Number(dpp);
        var pjkNum = Number(pjk);
        if (dppNum >= pjkNum) {
            var tableFinal = $('#tblPphFinal').dataTable();
            var a = $("select[name='ddlKewajibanFinal'] option:selected").text().split('.');
            tableFinal.fnUpdate($("#ddlKewajibanFinal").val(), row, 0, false);
            tableFinal.fnUpdate(a[1], row, 1, false);
            tableFinal.fnUpdate(dpp, row, 2, false);
            tableFinal.fnUpdate(pjk, row, 3, false);
            tableFinal.fnUpdate('<a class="edit" href="">Ubah</a> | <a class="delete" href="">Hapus</a>', row, 4, false);
            tableFinal.fnDraw();
        } else {
            common.showMessage("INFO", "Data tidak valid", "info");
        }
    };

    return {
        init: function (preview) {
            initTable(preview);
            handleBtnAdd();
            handleBtnEdit();
            handleBtnDelete();
        }, resetTabelFinal: function () {
            resetTFinal();
        }, setFinal: function (objFinal) {
            setDataFinal(objFinal);
        }, setPrepFinal: function (objPrepFinal) {
            setDataPrepFinal(objPrepFinal);
        }
    };
}();