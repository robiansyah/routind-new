$( document ).ready(function() {
    var refTarif = Array([50,0],[100,5],[500,15], [999999999, 25]);
    $("#tbl_final").DataTable();
    $('#tambahItem').click(function () {
        $('#itemBtn').val("create");
        $('#item_id').val('');
        $('#itemForm').trigger("reset");
        $('#itemHeading').html("Tambah Bukti Potong Final");
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
            $('#itemHeading').html("Edit Bukti Potong Final");
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

    $('#bruto').change(function() {
        var bruto = number.getVal('#bruto');
        number.setVal('#dpp', bruto);
        hitung();
    });

    $('.hitung').change(function() {
        hitung();
    });

    $('#object_code').change(function(){
        var object = $('#object_code').val();
        if(object=='21-401-01' || object=='21-401-02'){
            $('#dpp').attr('readonly', 'true');
            $('#tarif').attr('readonly', 'true');
        }else{
            $('#dpp').attr('readonly', 'false');
            $('#tarif').attr('readonly', 'false');
        }
        hitung();
    });

    function hitung(){
        var object = $('#object_code').val();
        var dpp = number.getVal('#dpp');
        if(object=='21-401-01') {
            number.setVal('#pph', itungPph(dpp));
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

    function itungPph(harta) {
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
});
