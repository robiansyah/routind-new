$( document ).ready(function() {
    $("#tbl_gaji").DataTable();
    $('body').on('click', '.editItem', function () {
        var item_id = $(this).data('id');
        $.get('/pph21/gaji/' + item_id +'/edit', function (result) {
            $('#itemHeading').html("Edit Gaji");
            $('#itemBtn').html('Update');
            $('#itemBtn').val("edit-item");
            $('#itemModal').modal('show');
            $('#item_id').val(result.id);
            number.setVal('#salary', result.salary);
            number.setVal('#pph', result.pph);
            number.setVal('#other', result.other);
            number.setVal('#honorarium', result.honorarium);
            number.setVal('#premi', result.premi);
            number.setVal('#natura', result.natura);
            number.setVal('#thr', result.thr);
            number.setVal('#pension', result.pension);
            number.setVal('#zakat', result.zakat);
            hitung();
        })
    });

    $('#itemBtn').click(function (e) {
        e.preventDefault();
        if($("#itemForm").valid()){
            $("#itemForm").submit();
        }
    });

    $('#penghasilan').change(function() {
        hitung();
    });

    function hitung(){
        var salary = number.getVal('#salary');
        var pph = number.getVal('#pph');
        var other = number.getVal('#other');
        var honorarium = number.getVal('#honorarium');
        var premi = number.getVal('#premi');
        var natura = number.getVal('#natura');
        var thr = number.getVal('#thr');
        number.setVal('#bruto', salary+pph+other+honorarium+premi+natura+thr);
        var bruto = number.getVal('#bruto');
        var position = (bruto*12>=6000000) ? 6000000 : bruto*12;
        number.setVal('#position', position/12);
    }

    $(".uang").autoNumeric('init', {aSep: '.', aDec: ',', mDec: '0', vMin: '0'});    
    
    $("#itemForm").validate({
        errorElement: 'div', //default input error message container
        errorClass: 'fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback', // default input error message class
        rules: {
            salary : {
                required: true,
            },
            pph : {
                required: true,
            },
            other : {
                required: true,
            },
            honorarium : {
                required: true,
            },
            premi : {
                required: true,
            },
            natura : {
                required: true,
            },
            thr : {
                required: true,
            },
            bruto : {
                required: true,
            },
            pension : {
                required: true,
            },
            zakat : {
                required: true,
            },
        },
    });
    
    
});
