$( document ).ready(function() {
    $('#tambahItem').click(function () {
        $('#itemBtn').val("create");
        $('#item_id').val('');
        $('#itemForm').trigger("reset");
        $('#itemHeading').html("Tambah Faktur Pajak Masukan");
        $('#itemBtn').html('Simpan');
        $('#itemModal').modal('show');
        $("#barjas").show();
        $("#detailBarjas").hide();
    });

    $('body').on('click', '.editItem', function () {
        var item_id = $(this).data('id');
        $.get('/faktur/pajak/masukan/' + item_id +'/edit', function (data) {
            $('#itemHeading').html("Edit Faktur Pajak Masukan");
            $('#itemBtn').html('Update');
            $('#itemBtn').val("edit-item");
            $('#itemModal').modal('show');
            $('#item_id').val(data.id);
            $('#invoice_no').val(data.transaction_code+'.'+data.invoice_no);
            $('#customer_id').val(data.collector_id);
            $('#customer_name').val(data.collector_name);
            $('#customer_address').val(data.collector_address);
            $('#invoice_date').val(data.invoice_date);
            $('#invoice_year').val(data.invoice_year).change();
            $('#invoice_period').val(data.invoice_period).change();
            if(data.credit=='ya'){
                $('input[type=radio][name=credit][value=ya]').prop("checked", true);
            }else{
                $('input[type=radio][name=credit][value=tidak]').prop("checked", true);
            }
            number.setVal('#dpp', data.dpp);
            number.setVal('#ppn', data.ppn);
            number.setVal('#ppnbm', data.ppnbm);
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

    $('#invoice_date').flatpickr();
    $('#invoice_date').change(function() {
        date = new Date($(this).val());
        var year = date.getFullYear();
        var month = date.getMonth()+1;
        var inv_period = $('#invoice_period').val();
        var inv_year = $('#invoice_year').val();
//        if(inv_period == '' && inv_year==''){
            if(month < 10){
                month = '0'+month;
            }
            $('#invoice_year').val(year).change();
            $('#invoice_period').val(month).change();
//        }

    });

    $(".uang").autoNumeric('init', {aSep: '.', aDec: ',', mDec: '0', vMin: '0'});

    $(".invoice_no").inputmask({
        mask: "99.99.99.999-99999999"
    });

    jQuery.validator.addMethod("noSpace", function (value, element) {
        return value.indexOf("_") < 0 && value !== "";
    }, "Harap periksa kembali Kode & No Seri Faktur Pajak");
    
    $("#itemForm").validate({
        errorElement: 'div', //default input error message container
        errorClass: 'fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback', // default input error message class
        rules: {
            invoice_no : {
                required: true,
                noSpace: true,
            },
            customer_id : {
                required: true,
            },
            invoice_date : {
                required: true,
            },
            invoice_period : {
                required: true,
            },
            invoice_year : {
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
