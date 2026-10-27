$( document ).ready(function() {
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

    $(document).on('submit', 'form', function() {
        $('button').attr('disabled', 'disabled');
    });
});