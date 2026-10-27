$( document ).ready(function() {
    $('#tambahItem').click(function () {
        $('#itemBtn').val("create");
        $('#item_id').val('');
        $('#itemForm').trigger("reset");
        $('#itemHeading').html("Tambah Retur Pajak Keluaran");
        $('#itemBtn').html('Simpan');
        $('#itemModal').modal('show');
        $("#barjas").show();
        $("#detailBarjas").hide();
    });

    $('body').on('click', '.editItem', function () {
        var item_id = $(this).data('id');
        $.get('/faktur/retur/keluaran/' + item_id +'/edit', function (result) {
            $('#itemHeading').html("Edit Retur Pajak Keluaran");
            $('#itemBtn').html('Update');
            $('#itemBtn').val("edit-item");
            $('#itemModal').modal('show');
            $('#item_id').val(result.id);
            $('#retur_no').val(result.retur_no);
            $('#retur_date').val(result.retur_date);
            $('#retur_year').val(result.retur_year).change();
            $('#retur_period').val(result.retur_period).change();
            $('#invoice_id').val(result.invoice_id).change();
            number.setVal('#dpp', result.dpp);
            number.setVal('#ppn', result.ppn);
            number.setVal('#ppnbm', result.ppnbm);
        })
    });

    $('#itemBtn').click(function (e) {
        e.preventDefault();
        if($("#itemForm").valid()){
            $("#itemForm").submit();
        }
    });

    $('#dpp').change(function() {
        var dpp = number.getVal('#dpp');
        number.setVal('#ppn', dpp*0.12);
    });

    $('#invoice_id').change(function() {
        var item_id = $(this).val();
        $.get('/faktur/pajak/keluaran/' + item_id +'/detail', function (result) {
            number.setVal('#dpp-temp', result.dpp);
            number.setVal('#ppn-temp', result.ppn);
            number.setVal('#ppnbm-temp', result.ppnbm);
            $('#dpp-text').text("Maksimal : "+$('#dpp-temp').val());
            $('#ppn-text').text("Maksimal : "+$('#ppn-temp').val());
            $('#ppnbm-text').text("Maksimal : "+$('#ppnbm-temp').val());
        })
    });

    $('#retur_date').flatpickr();
    $('#retur_date').change(function() {
        date = new Date($(this).val());
        var year = date.getFullYear();
        var month = date.getMonth()+1;
        var inv_period = $('#retur_period').val();
        var inv_year = $('#retur_year').val();
        if(inv_period == '' && inv_year==''){
            if(month < 10){
                month = '0'+month;
            }
            $('#retur_year').val(year).change();
            $('#retur_period').val(month).change();
        }

    });

    $(".uang").autoNumeric('init', {aSep: '.', aDec: ',', mDec: '0', vMin: '0'});    
    
    $("#itemForm").validate({
        errorElement: 'div', //default input error message container
        errorClass: 'fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback', // default input error message class
        rules: {
            retur_no : {
                required: true,
            },
            invoice_id : {
                required: true,
            },
            retur_date : {
                required: true,
            },
            retur_period : {
                required: true,
            },
            retur_year : {
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
