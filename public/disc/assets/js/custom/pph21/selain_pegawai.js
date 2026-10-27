$( document ).ready(function() {
    var refTarif = Array([50,0],[100,5],[500,15], [999999999, 25]);
    $("#tbl_tidak").DataTable();
    $('#tambahItem').click(function () {
        $('#itemBtn').val("create");
        $('#item_id').val('');
        $('#itemForm').trigger("reset");
        $('#itemHeading').html("Tambah Bukti Potong Selain Pegawai Tetap");
        $('#itemBtn').html('Simpan');
        $('#itemModal').modal('show');
        var today = new Date();
        var year = today.getFullYear();
        var month = today.getMonth()+1;
        if(month < 10){
            month = '0'+month;
        }
        $('#year').val(year).change();
//        $('#period').val(month).change();
    });

    $('body').on('click', '.editItem', function () {
        var item_id = $(this).data('id');
        $.get('/pph21/bupot/tidak_final/' + item_id +'/edit', function (result) {
            $('#itemHeading').html("Edit Bukti Potong Selain Pegawai Tetap");
            $('#itemBtn').html('Update');
            $('#itemBtn').val("edit-item");
            $('#itemModal').modal('show');
            $('#item_id').val(result.id);
            $('#item_no').val(result.no);
            $('#date').val(result.date);
            $('#name').val(result.name);
            $('#address').val(result.address);
            $('#year').val(result.year).change();
            $('#period').val(result.period).change();
            $('#object_code').val(result.object_code).change();
            $('#ptkp').val(result.ptkp_code).change();
            number.setVal('#dpp', result.dpp);
            number.setVal('#bruto', result.bruto);
            number.setVal('#pph', result.pph);
            number.setVal('#tarif', result.tarif);
            if(result.npwp != null){
                $("#tanpa_npwp").hide();
                $("#nik").val(null);
                $("#dengan_npwp").show();
                $('#npwp').val(result.npwp);
            }else{
                $('#not').prop('checked', true);
                $("#tanpa_npwp").show();
                $('#nik').val(result.nik);
                $("#dengan_npwp").hide();
                $("#npwp").val(null);
                if(result.country_code != null){
                    $('#asing').prop('checked', true);
                    $("#country_list").show();
                    $("#country_code").val(result.country_code).change();
                }
            }
        })
    });

    $('#itemBtn').click(function (e) {
        e.preventDefault();
        if($("#itemForm").valid()){
            $("#itemForm").submit()
        }
    });

    $("#not").change(function() {
        if(this.checked) {
            $("#dengan_npwp").hide();
            $("#npwp").val(null);
            $("#tanpa_npwp").show();
        }else{
            $("#tanpa_npwp").hide();
            $("#nik").val(null);
            $("#dengan_npwp").show();
        }
    });

    $("#asing").change(function() {
        if(this.checked) {
            $("#country_list").show();
            $('#not').prop('checked', true);
            $("#not").prop('disabled', true);
            $("#dengan_npwp").hide();
            $("#npwp").val(null);
            $("#tanpa_npwp").show();
        }else{
            $("#country_list").hide();
            $("#country_code").val(null).change();
            $("#not").prop('disabled', false);
            // $('#not').prop('checked', false);
            // $("#tanpa_npwp").hide();
            // $("#nik").val(null);
            // $("#dengan_npwp").show();
        }
    });

    var pengali = function(){
        var npwp = $("#npwp").val();
        if(npwp == ''){
            return 1;
        }else{
            return 1;
        }
    }

    $('#ptkp').change(function() {
        $("#bruto").val(0);
        $("#dpp").val(0);
        $("#tarif").val(0);
        $("#pph").val(0);
    });

    $('#bruto').change(function() {
        var bruto = number.getVal('#bruto');
        if($("#object_code option:selected").text() == '21-100-03 - Pegawai Tidak Tetap (Dibayar Harian)' && bruto <= 2500000 || $('#object_code').val()=='27-100-99'){
            number.setVal('#dpp', bruto);
            var tarif = $('#tarif').val();
            number.setVal('#pph', (bruto*tarif/100)*pengali());
        }else if($("#object_code option:selected").text() == '21-100-03 - Pegawai Tidak Tetap (Dibayar Bulanan)' || $("#object_code").val()=='21-100-10' || $("#object_code").val()=='21-100-11'){
            if($('#ptkp').val()==''){
                common.showMessage("Kesalahan", "PTKP Belum Dipilih", "error", "Tutup");
            }else{
                number.setVal('#dpp', bruto);
                var paramAjax = {
                    bruto: bruto,
                    ptkp: $('#ptkp').val(),
                };
                var doneAjax = function (data) {
                    if (data.code == 1) {
                        number.setVal('#dpp', bruto);
                        $('#tarif').val(data.data);
                        number.setVal('#pph', (bruto*data.data/100)*pengali());
                    } else {
                        common.showMessage("Kesalahan", "PTKP Belum Dipilih", "error", "Tutup");
                    }
                };

                common.ajaxJsonPost(function () {
                }, paramAjax, "/api/pph/ter", doneAjax);
            }
        }else if($("#object_code").val()=='21-401-01' || $("#object_code").val()=='21-401-02' || $("#object_code").val()=='21-499-99' ){
            var bruto = number.getVal('#bruto');
            number.setVal('#dpp', bruto);
            hitung();
        }else{
            number.setVal('#dpp', bruto/2);
            $("#tarif").val(itungTarif(bruto/2));
            number.setVal('#pph', itungPph(bruto/2));
        }
    });

    $('.hitung').change(function() {
        hitung();
    });

    $('#object_code').change(function() {
        $("#bruto").val(0);
        $("#dpp").val(0);
        $("#tarif").val(0);
        $("#pph").val(0);
        if($(this).val()=='21-100-99' || $(this).val()=='21-499-99'){
            $("#dpp").prop('readonly', false);
            $("#tarif").prop('readonly', false);
            $("#dpp").removeClass("form-control-solid");
            $("#tarif").removeClass("form-control-solid");
            $("#tarif").val(0);
        }else{
            $("#dpp").prop('readonly', true);
            $("#tarif").prop('readonly', true);
            $("#dpp").addClass("form-control-solid");
            $("#tarif").addClass("form-control-solid");
            if($(this).val()=='27-100-99'){
                $("#tarif").val(20);
            }else if($("#object_code option:selected").text() == '21-100-03 - Pegawai Tidak Tetap (Dibayar Harian)'){
                $("#tarif").val(0.5);
            }else{
                $("#tarif").val(0);
            }
        }
        hitung();
    });

    function hitung(){
        var object = $('#object_code').val();
        var dpp = number.getVal('#dpp');
        if(object=='21-401-01') {
            number.setVal('#pph', itungPphFinal(dpp));
            if(dpp<=50000000){
                number.setVal('#tarif', 0);
            }else if(dpp<=100000000){
                number.setVal('#tarif', 5);
            }else if(dpp<=500000000){
                number.setVal('#tarif', 15);
            }else{
                number.setVal('#tarif', 25);
            }
        }else if(object=='21-401-02') {
            if(dpp<=50000000){
                number.setVal('#tarif', 0);
                number.setVal('#pph', 0);
            }else{
                number.setVal('#tarif', 5);
                number.setVal('#pph', ((dpp-50000000)*5/100)*pengali());
            }
        }else{
            var tarif = number.getVal('#tarif');
            number.setVal('#pph', (dpp*tarif/100)*pengali());
        }
    }


    $('#date').flatpickr();

    Inputmask({
        "mask" : "9999999999999999"
    }).mask("#npwp");

    Inputmask({
        "mask" : "9999999999999999"
    }).mask("#nik");

    jQuery.validator.addMethod("noSpace", function (value, element) {
        return value.indexOf("_") < 0 && value !== "";
    }, "Harap periksa kembali Isian Anda");

    $(".uang").autoNumeric('init', {aSep: '.', aDec: ',', mDec: '0', vMin: '0'});

    $("#itemForm").validate({
        errorElement: 'div', //default input error message container
        errorClass: 'fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback', // default input error message class
        rules: {
            npwp : {
                required: '#not:unchecked',
                noSpace: '#not:unchecked',
            },
            nik : {
                required: '#not:checked',
                noSpace: '#not:checked',
            },
            name : {
                required: true,
            },
            address : {
                required: true,
            },
            country_code : {
                required: '#asing:checked',
            },
            period : {
                required: true,
            },
            year : {
                required: true,
            },
            dpp : {
                required: true,
            },
            bruto : {
                required: true,
            },
            tarif : {
                required: true,
            },
            pph : {
                required: true,
            },
            date : {
                required: true,
            },
        },
    });

    $("#tanpa_npwp").hide();
    $("#country_list").hide();

    function itungPphFinal(harta) {
        var jmlLapis = refTarif.length;
        pajak = 0;
        var max = 0;
        var pengurang;
        var trf;
        for (i = 0; i < jmlLapis; i++) {
            if (i === 0) {
                max = parseFloat(refTarif[i][0]);
            } else {
                max = parseFloat(refTarif[i][0]) - parseFloat(refTarif[i - 1][0]);
            }
            pengurang = max * parseFloat(1000000);
            trf = parseFloat(refTarif[i][1]) / parseFloat(100);
            if (harta > pengurang) {
                pajak = parseFloat(pajak) + (pengurang * trf);
                harta = parseFloat(harta) - (pengurang);
            } else {
                pajak = parseFloat(pajak) + (harta * trf);
                harta = 0;
            }
        }
        if (pajak < 0) {
            pajak = 0;
        }
        return pajak;
    }

    function itungPph(harta) {
        var refTarif = Array([60,5],[250,15],[500,25],[5000,30],[999999,35]);
        var jmlLapis = refTarif.length;
        pajak = 0;
        var max = 0;
        var pengurang;
        var trf;
        for (i = 0; i < jmlLapis; i++) {
            if (i === 0) {
                max = parseFloat(refTarif[i][0]);
            } else {
                max = parseFloat(refTarif[i][0]) - parseFloat(refTarif[i - 1][0]);
            }
            pengurang = max * parseFloat(1000000);
            trf = parseFloat(refTarif[i][1]) / parseFloat(100);
            if (harta > pengurang) {
                pajak = parseFloat(pajak) + (pengurang * trf);
                harta = parseFloat(harta) - (pengurang);
            } else {
                pajak = parseFloat(pajak) + (harta * trf);
                harta = 0;
            }
        }
        if (pajak < 0) {
            pajak = 0;
        }
        return pajak;
    }

    function itungTarif(harta) {
        var tarif = 0;
        if(harta <= 60000000){
            tarif = 5;
        }else if(250000000){
            tarif = 15;
        }else if(500000000){
            tarif = 25;
        }else if(5000000000){
            tarif = 30;
        }else{
            tarif = 35;
        }

        return tarif;
    }
});
