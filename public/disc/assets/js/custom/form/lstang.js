/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var daftarKeluargaHandler = function () {
    var thn = "";
    var nRow;
    var nEdit = null;
    var setupTabelTanggungan = function () {
        var tTable = $('#tblTanggungan').dataTable({
            "pageLength": 5,
            "pagingType": "simple_numbers",
            "destroy": true,
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

                $("td:eq(0)", row).css("text-align", "left");
                $("td:eq(1)", row).css("text-align", "center");
                $("td:eq(2)", row).css("text-align", "center");
                $("td:eq(3)", row).css("text-align", "center");
                $("td:eq(4)", row).css("text-align", "left");
            }
        });
        jQuery('#tblTanggungan_wrapper .dataTables_filter').hide(); // modify table search input
        jQuery('#tblTanggungan_wrapper .dataTables_length').hide(); // modify table per page dropdown 
                
		var form = $('#frmKeluarga');
		form.validate({
			errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error invalid-feedback', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "", // validate all fields including form hidden input
            rules: {
                DkNik: {
                    digits: true
                }
            },
			messages: {
				DkNik: {
					digits: "Masukkan angka saja"
				}
			},
			highlight: function (element) { // hightlight error inputs
                $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element) { // revert the change done by hightlight
                $(element).closest('.form-group').removeClass('has-error'); // set error class to the control group
                $(element).removeClass('is-invalid');
            },
            success: function (label) {
                label.closest('.form-group').removeClass('has-error'); // set success class to the control group
            },
            errorPlacement: function (error, element) { // render error placement for each input type
                if (element.parent(".input-group").length > 0) {
                    error.insertAfter(element.parent(".input-group"));
                } else if (element.parent(".kt-input-icon").length > 0) {
                    error.insertAfter(element.parent(".kt-input-icon"));
                } else if (element.attr("data-error-container")) {
                    error.appendTo(element.attr("data-error-container"));
                } else if (element.parents('.radio-list').length > 0) {
                    error.appendTo(element.parents('.radio-list').attr("data-error-container"));
                } else if (element.parents('.radio-inline').length > 0) {
                    error.appendTo(element.parents('.radio-inline').attr("data-error-container"));
                } else if (element.parents('.checkbox-list').length > 0) {
                    error.appendTo(element.parents('.checkbox-list').attr("data-error-container"));
                } else if (element.parents('.checkbox-inline').length > 0) {
                    error.appendTo(element.parents('.checkbox-inline').attr("data-error-container"));
                } else {
                    error.insertAfter(element); // for other inputs, just perform default behavior
                }
            },
            invalidHandler: function (event, validator) {
                event.preventDefault();
            },
			submitHandler: function (form) {
                alert("hola");
            }
        });
			
        $('#keluarga_new').click(function () {
			form.validate().resetForm();
			form.find('.has-error').removeClass("has-error");
            $('#divKeluarga').modal('show');
            $('#divKeluarga').modal({show: true});
            common.resetForm('#divKeluarga');
            nEdit = null;
        });
        
        $('#btnAddKeluarga').click(function (e) {
            e.preventDefault();
            var cekData = false;
            if (form.valid()) {
                if ($("#DkNmKel").val().trim() !== "" && $("#DkHubKel").val().trim() !== "" &&
                        $("#DkPekerjaan").val() !== "") {
                    if (thn === "2013" && $("#DkTglLhr").val().trim() !== "") {
                        cekData = true;
                    } else if (thn !== "2013" && $("#DkNik").val().trim() !== "") {
                        cekData = true;
                    } 
                    if (cekData) {
                        if (nEdit === false || nEdit === null) {
                            tTable.fnAddData([$("#DkNmKel").val(),
                                $("#DkTglLhr").val(),
                                $("#DkNik").val(),
                                $("#DkHubKel").val(),
                                $("#DkPekerjaan").val(),
                                '<a class="edit" href="#">Ubah</a> | <a class="delete" href="#">Hapus</a>'
                            ]);
                            tTable.fnDraw();
                            common.resetForm('#divKeluarga');
                        } else {
                            tTable.fnUpdate($("#DkNmKel").val(), nRow, 0, false);
                            tTable.fnUpdate($("#DkTglLhr").val(), nRow, 1, false);
                            tTable.fnUpdate($("#DkNik").val(), nRow, 2, false);
                            tTable.fnUpdate($("#DkHubKel").val(), nRow, 3, false);
                            tTable.fnUpdate($("#DkPekerjaan").val(), nRow, 4, false);
                            tTable.fnUpdate('<a class="edit" href="">Ubah</a> | <a class="delete" href="">Hapus</a>', nRow, 5, false);
                            tTable.fnDraw();
                            common.resetForm('#divKeluarga');
                            nEdit = null;
                        }
                    } else {
                        common.showMessage("INFO", "Data tidak lengkap");
                    }
                } else {
                    common.showMessage("INFO", "Data tidak lengkap");
                }
                $('#divKeluarga').modal('hide');
            } else {
                common.showMessage("INFO", "NIK harus berupa Angka");
            }
        });
        
        $('#tblTanggungan').on('click', 'a.edit', function (e) {
            e.preventDefault();
            nRow = $(this).parents('tr')[0];
            if (nEdit === null) {
                nEdit = true;
            }
            var oTr = $(this).closest("tr")[0];
            var rData = $("#tblTanggungan").dataTable().fnGetData(oTr);
            $("#DkNmKel").val(rData[0]);
            $("#DkTglLhr").val(rData[1]);
            $("#DkNik").val(rData[2]);
            $("#DkHubKel").val(rData[3]);
            $("#DkPekerjaan").val(rData[4]);
            $('#divKeluarga').modal('show');
            $('#divKeluarga').modal({show: true});
        });
        
        $('#tblTanggungan').on('click', 'a.delete', function (e) {
            e.preventDefault();
            var nRow = $(this).parents('tr')[0];
            swalWithBootstrapButtons.fire({
                title: 'Apakah Anda yakin ingin menghapus data ini?',
                icon: 'warning',
                confirmButtonText: "<i class='la la-thumbs-up'></i> Ya",
                showCancelButton: true,
                cancelButtonText: "<i class='la la-ban'></i> Tidak",
                reverseButtons: true
            }).then(function (result) {
                if (result.value) {
                    tTable.fnDeleteRow(nRow);
                }
            });
        });
    };
    
    var setupColumn = function (tahun, preview) {
        $('#tblTanggungan').DataTable().column(1).visible(false);
        $('#tblTanggungan').DataTable().column(2).visible(false);
        $('#divNIK').hide();
        $('#divTglLahir').hide();
        thn = tahun;
        if (tahun === "2013") {
            $('#tblTanggungan').DataTable().column(1).visible(true);
            $('#divTglLahir').show();
        } else {
            $('#tblTanggungan').DataTable().column(2).visible(true);
            $('#divNIK').show();
        }
        if (preview) {
            $('#tblTanggungan').DataTable().column(5).visible(false);
        } else {
            $('#tblTanggungan').DataTable().column(5).visible(true);
        }
    };

    var setDataKeluarga = function (arrayKel) {
        $('#tblTanggungan').DataTable().clear();
        $.each(arrayKel, function (i, value) {
            $('#tblTanggungan').DataTable().row.add([
                arrayKel[i].nmAgKel,
                arrayKel[i].tglLahir,
                arrayKel[i].nik,
                arrayKel[i].hubKel,
                arrayKel[i].kerja,
                '<a class="edit" href="#">Ubah</a> | <a class="delete" href="#">Hapus</a>'
            ]).draw();
        });
    };

    var resetTKel = function () {
        var tblKel = $('#tblTanggungan').DataTable();
        tblKel.clear().draw();
    };

    return {
        init: function () {
            setupTabelTanggungan();
        }, setup: function (tahun, preview) {
            setupColumn(tahun, preview);
        }, setTanggungan: function (arrayKel) {
            setDataKeluarga(arrayKel);
        }, resetTableTanggungan: function () {
            resetTKel();
        }
    };
}();
