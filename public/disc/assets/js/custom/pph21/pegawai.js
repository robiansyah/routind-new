$( document ).ready(function() {
    var refTarif = Array([50,0],[100,5],[500,15], [999999999, 25]);
    $("#tbl_tidak").DataTable();
    $('#tambahItem').click(function () {
        $('#itemBtn').val("create");
        $('#item_id').val('');
        $('#itemForm').trigger("reset");
        $('#itemHeading').html("Tambah Bukti Potong Pegawai Tetap");
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
        $.get('/pph21/bupot/pegawai/' + item_id +'/edit', function (result) {
            $('#itemHeading').html("Edit Bukti Potong Pegawai Tetap");
            $('#itemBtn').html('Update');
            $('#itemBtn').val("edit-item");
            $('#itemModal').modal('show');
            $('#item_id').val(result.id);
            $('#item_no').val(result.no);
            $('#date').val(result.date);
            $('#name').val(result.name);
            $('#address').val(result.address);
            $('#position').val(result.position);
            $('#year').val(result.year).change();
            $('#period').val(result.period).change();
            $('#ptkp').val(result.ptkp_code).change();
            if(result.status=='Pegawai Tetap'){
                $('#object_code').val('21-100-01').change();
            }else{
                $('#object_code').val('21-100-02').change();
            }
            number.setVal('#dpp', result.bruto);
            number.setVal('#bruto', result.bruto);
            number.setVal('#pph', result.terutang);
            number.setVal('#tarif', result.rates);
            $('#npwp').val(result.nik);
        })
    });

    $('#itemBtn').click(function (e) {
        e.preventDefault();
        if($("#itemForm").valid()){
            $("#itemForm").submit()
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
    });

    $('.hitung').change(function() {
        hitung();
    });

    $('#object_code').change(function() {
        $("#bruto").val(0);
        $("#dpp").val(0);
        $("#tarif").val(0);
        $("#pph").val(0);

        $("#dpp").prop('readonly', true);
        $("#tarif").prop('readonly', true);
        $("#dpp").addClass("form-control-solid");
        $("#tarif").addClass("form-control-solid");

    });

    $('.hitung').change(function() {
        var dpp = number.getVal('#dpp');
        var tarif = number.getVal('#tarif');
        number.setVal('#pph', (dpp*tarif/100)*pengali());
    });


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
            position : {
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
});
