$( document ).ready(function() {
    $("#tbl_personalia").DataTable();
    $('#tambahItem').click(function () {
        $('#itemBtn').val("create");
        $('#item_id').val('');
        $('#itemForm').trigger("reset");
        $('#itemHeading').html("Tambah Personalia");
        $('#itemBtn').html('Simpan');
        $('#itemModal').modal('show');
    });

    $('body').on('click', '.editItem', function () {
        var item_id = $(this).data('id');
        $.get('/pph21/personalia/' + item_id +'/edit', function (result) {
            $('#itemHeading').html("Edit Personalia");
            $('#itemBtn').html('Update');
            $('#itemBtn').val("edit-item");
            $('#itemModal').modal('show');
            $('#item_id').val(result.id);
            $('#name').val(result.name);
            $('#npwp').val(result.npwp);
            if(result.gender == 'Perempuan'){
                $('input[type=radio][name=gender][value=Perempuan]').prop("checked", true);
            }else{
                $('input[type=radio][name=gender][value=Laki-Laki]').prop("checked", true);
            }
            $('#address').val(result.address);
            $('#ptkp').val(result.ptkp).change();
            $('#position').val(result.position);
            $('#start_date').val(result.start_date);

        })
    });

    $('#itemBtn').click(function (e) {
        e.preventDefault();
        if($("#itemForm").valid()){
            $("#itemForm").submit();
        }
    });

    $('#statusBtn').click(function (e) {
        e.preventDefault();
        if($("#myForm").valid()){
            $("#myForm").submit();
        }
    });

    Inputmask({
        "mask" : "9999999999999999"
    }).mask("#npwp");
    $('#start_date').flatpickr();
    $('#end_date').flatpickr();
    
    jQuery.validator.addMethod("noSpace", function (value, element) {
        return value.indexOf("_") < 0 && value !== "";
    }, "Harap periksa kembali NPWP anda");
    $("#itemForm").validate({
        errorElement: 'div', //default input error message container
        errorClass: 'fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback', // default input error message class
        rules: {
            name : {
                required: true,
            },
            npwp : {
                required: true,
                noSpace: true,
            },
            address : {
                required: true,
            },
            ptkp : {
                required: true,
            },
            position : {
                required: true,
            },
            start_date : {
                required: true,
            },
        },
    });
    
    
});
