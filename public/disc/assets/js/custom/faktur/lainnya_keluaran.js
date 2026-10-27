$( document ).ready(function() {
    $('#tambahItem').click(function () {
        $('#itemBtn').val("create");
        $('#item_id').val('');
        $('#itemForm').trigger("reset");
        $('#itemHeading').html("Tambah Dokumen Ekspor");
        $('#itemBtn').html('Simpan');
        $('#itemModal').modal('show');
        $("#barjas").show();
        $("#detailBarjas").hide();
    });

    $('body').on('click', '.editItem', function () {
        var item_id = $(this).data('id');
        $.get('/faktur/other/keluaran/' + item_id +'/edit', function (result) {
            $('#itemHeading').html("Edit Dokumen Ekspor");
            $('#itemBtn').html('Update');
            $('#itemBtn').val("edit-item");
            $('#itemModal').modal('show');
            $('#item_id').val(result.id);
            $('#other_no').val(result.other_no);
            $('#other_date').val(result.other_date);
            $('#other_year').val(result.other_year).change();
            $('#other_period').val(result.other_period).change();
            $('#transaction_detail').val(result.transaction_detail).change();
            $('#transaction_doc').val(result.transaction_doc).change();
            number.setVal('#dpp', result.dpp);
            number.setVal('#ppn', result.ppn);
            number.setVal('#ppnbm', result.ppnbm);
        })
    });

    $('#itemBtn').click(function (e) {
        e.preventDefault();
        if($("#itemForm").valid()){
            $("#itemForm").submit()
        }
    });

//    $('#dpp').change(function() {
//        var dpp = number.getVal('#dpp');
//        number.setVal('#ppn', dpp*0.11);
//    });


    $('#other_date').flatpickr();
    $('#other_date').change(function() {
        date = new Date($(this).val());
        var year = date.getFullYear();
        var month = date.getMonth()+1;
        var inv_period = $('#other_period').val();
        var inv_year = $('#other_year').val();
        if(inv_period == '' && inv_year==''){
            if(month < 10){
                month = '0'+month;
            }
            $('#other_year').val(year).change();
            $('#other_period').val(month).change();
        }

    });

    $(".uang").autoNumeric('init', {aSep: '.', aDec: ',', mDec: '0', vMin: '0'});
    
    $("#itemForm").validate({
        errorElement: 'div', //default input error message container
        errorClass: 'fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback', // default input error message class
        rules: {
            other_no : {
                required: true,
            },
            transaction_detail : {
                required: true,
            },
            transaction_doc : {
                required: true,
            },
            other_date : {
                required: true,
            },
            other_period : {
                required: true,
            },
            other_year : {
                required: true,
            },
            dpp : {
                required: true,
            },
            ppn : {
                required: true,
            },
            ppnbm : {
                required: true,
            },
        },
    });
    
    
});
