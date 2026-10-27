/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var daftarBuktiPotongHandler = function () {
    var barisBp;
    var nEdit = null;
    var setupTableBupot = function () {
        var oTable = $('#tblBuktiPotong').dataTable({
            "destroy": true,
            "pageLength": 5,
            "pagingType": "simple_numbers",
            "language": {
                "zeroRecords": "Tidak ditemukan data yang sesuai",
                "lengthMenu": "_MENU_ records",
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data ",
                "infoEmpty": "Menampilkan 0 sampai 0 dari 0 data ",
                "paginate": {
                    "previous": "<<",
                    "next": ">>"}
            },
            "order": [[0, 'asc']],
            "columnDefs": [{
                    'sortable': false,
                    'targets': [0, 1, 2, 3, 4, 5, 6]
                }
            ],
            "rowCallback": function (row, data, index) {
                $("td:eq(1)", row).css("text-align", "center");
                $("td:eq(2)", row).css("text-align", "center");
                $("td:eq(3)", row).css("text-align", "center");
                $("td:eq(4)", row).css("text-align", "center");
                var nilai = "<input type='text' style='text-align:right' readonly class='form-control text-number bp' value=" + data[5] + "></input>";
                $("td:eq(5)", row).html(nilai);
            },
            "drawCallback": function () {
                $('.bp').autoNumeric('init', {aDec: ',', aSep: '.', mDec: '0'});
            },
            "footerCallback": function (row, data, start, end, display) {
                var total = Number(0);
                for (var i = 0; i < data.length; i++) {                    
                    total += Number(data[i][5]) * 1;
                }

                number.setVal('#txtJAC', total);
            }
        });
        $('#tblBuktiPotong_filter').hide();
        $('#tblBuktiPotong_length').hide();

        $('#buktiPotong_new').click(function () {
            if($("#thnPajak").val() >= 2022 && $("#txtPembetulanKe").val() > 0){
                $('#skppkpOpt').show();
            }else{
                $('#skppkpOpt').hide();
            }
            $('#divBuktiPotong').modal('show');
            $('#divBuktiPotong').modal({show: true});
            common.resetForm('#divBuktiPotong');
            nEdit = false;
        });
        
        $('#btnAddBuktiPotong').click(function (e) {
            e.preventDefault();
            if ($("#BpNpwpPemotong").val().trim() !== "" && $("#BpNoBuktiPotong").val().trim() !== ""
                    && $("#BpTglBuktiPotong").val().trim() !== "" && $("#BpJmlPotong").val().trim() !== "") {
                if (nEdit === false || nEdit === null) {
                    oTable.fnAddData([
                        $("#BpNmPemotong").val(),
                        setNpwpPemotong($("#BpNpwpPemotong").val()),
                        $("#BpNoBuktiPotong").val(),
                        $("#BpTglBuktiPotong").val(),
                        setJnsPajak($("#BpJnsPajak").val()),
                        number.getVal("#BpJmlPotong"),
                        '<a class="edit" href="#">Ubah</a> | <a class="delete" href="#">Hapus</a>'
                    ]);
                    oTable.fnDraw();
                } else {
                    oTable.fnUpdate($("#BpNmPemotong").val(), barisBp, 0, false);
                    oTable.fnUpdate(setNpwpPemotong($("#BpNpwpPemotong").val()), barisBp, 1, false);
                    oTable.fnUpdate($("#BpNoBuktiPotong").val(), barisBp, 2, false);
                    oTable.fnUpdate($("#BpTglBuktiPotong").val(), barisBp, 3, false);
                    oTable.fnUpdate(setJnsPajak($("#BpJnsPajak").val()), barisBp, 4, false);
                    oTable.fnUpdate(number.getVal("#BpJmlPotong"), barisBp, 5, false);
                    oTable.fnUpdate('<a class="edit" href="">Ubah</a> | <a class="delete" href="">Hapus</a>', barisBp, 6, false);
                    oTable.fnDraw();

                    nEdit = null;
                }
                $('#divBuktiPotong').modal('hide');
                $("#mbupot").val("Sudah Ada");
            } else {
                common.showMessage("INFO", "Data Bukti Pemotongan Tidak Lengkap");
            }
        });

        $('#tblBuktiPotong').on('click', 'a.edit', function (e) {
            e.preventDefault();
            barisBp = $(this).parents('tr')[0];
            if (nEdit === null || nEdit === false) {
                nEdit = true;
            }
            var kodeJenisPajak;
            var oTr = $(this).closest("tr")[0];
            var rData = $("#tblBuktiPotong").dataTable().fnGetData(oTr);
            switch (rData[4]) {
                case 'Pasal 22':
                    kodeJenisPajak = 2;
                    break;
                case 'Pasal 23':
                    kodeJenisPajak = 3;
                    break;
                case 'Pasal 24':
                    kodeJenisPajak = 4;
                    break;
                case 'Pasal 26':
                    kodeJenisPajak = 5;
                    break;
                case 'DTP':
                    kodeJenisPajak = 6;
                    break;
                case 'SKPPKP':
                    kodeJenisPajak = 7;
                    break;
                default:
                    kodeJenisPajak = 1;
                    break;
            }

            $("#BpNmPemotong").val(rData[0]);
            $("#BpNpwpPemotong").val(rData[1].replace(/_/g, '').replace('-', '').replace(/\./gi, ''));
            $("#BpNoBuktiPotong").val(rData[2]);
            $("#BpTglBuktiPotong").val(rData[3]);
            $("#BpJnsPajak").val(kodeJenisPajak).trigger("change");
            number.setVal("#BpJmlPotong", rData[5]);

            $('#divBuktiPotong').modal('show');
            $('#divBuktiPotong').modal({show: true});
        });
        
        $('#tblBuktiPotong').on('click', 'a.delete', function (e) {
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
                    oTable.fnDeleteRow(nRow);
                }
            });
        });
    };
    
    function setJnsPajak(a) {
        var nmJenisPajak;
        switch (a) {
            case '2' :
            case 2 :
                nmJenisPajak = 'Pasal 22';
                break;
            case '3' :
            case 3 :
                nmJenisPajak = 'Pasal 23';
                break;
            case '4' :
            case 4 :
                nmJenisPajak = 'Pasal 24';
                break;
            case '5' :
            case 5 :
                nmJenisPajak = 'Pasal 26';
                break;
            case '6' :
            case 6 :
                nmJenisPajak = 'DTP';
                break;
            case '7' :
            case 7 :
                nmJenisPajak = 'SKPPKP';
                break;
            default:
                nmJenisPajak = 'Pasal 21';
                break;
        }       
        return nmJenisPajak;
    }
    
    function setNpwpPemotong(npwp) {
        return npwp.substr(0, 2) + '.' + npwp.substr(2, 3) + '.' + npwp.substr(5, 3) + '.' + npwp.substr(8, 1) + '-' + npwp.substr(9, 3) + '.' + npwp.substr(12, 3);
    }

    var setDataBp = function (lsBuktiPotong) {
        var tblBp = $('#tblBuktiPotong').DataTable();
        tblBp.clear();
        $.each(lsBuktiPotong, function (i, value) {
            tblBp.row.add([
                lsBuktiPotong[i].nmPemotong,
                setNpwpPemotong(lsBuktiPotong[i].npwpPemotong),
                lsBuktiPotong[i].nomorBP,
                lsBuktiPotong[i].tglBP,
                setJnsPajak(lsBuktiPotong[i].pasalPph),
                lsBuktiPotong[i].jmlPPhDiPotong,
                '<a class="edit" href="#">Ubah</a> | <a class="delete" href="#">Hapus</a>'
            ]).draw();
        });
    };

    var setupColumn = function (preview) {
        if (preview) {
            $('#tblBuktiPotong').DataTable().column(6).visible(false);
        } else {
            $('#tblBuktiPotong').DataTable().column(6).visible(true);
        }
    };

    var resetTBuktiPotong = function () {
        var tblBp = $('#tblBuktiPotong').DataTable();
        tblBp.clear().draw();
    };
    function cekCompletionBuktiPotong() {
        var dataBp = $('#tblBuktiPotong').DataTable().data();
        if (dataBp.length === 0) {
            return false;
        } else {
            return true;  
        }
    }
    
    return{
        init: function () {
            setupTableBupot();
        }, setDataBuktiPotong: function (lsBp) {
            setDataBp(lsBp);
        }, setup: function (preview) {
            return setupColumn(preview);
        }, resetTabelBuktiPotong: function () {
            resetTBuktiPotong();
        }, cekBpCompletion: function () {
            return cekCompletionBuktiPotong();
        }
    };
}();